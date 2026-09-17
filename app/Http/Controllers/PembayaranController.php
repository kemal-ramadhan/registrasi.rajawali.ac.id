<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

use App\Models\Biaya;
use App\Models\Mahasiswa;
use App\Models\Mahasiswa_paymant;
use App\Models\PaymantMethod;
use App\Models\ProgramOption;

class PembayaranController extends Controller
{
    public function index()
    {
        $biayas = Biaya::where('status', 'Publish')->get();
        $mahasiswa = Mahasiswa::where('user_id', Auth::user()->id)->first();
        $mahasiswa_paymants = Mahasiswa_paymant::where('user_id', Auth::user()->id)->get();

        return view('customer.pembayaran.index', compact('biayas', 'mahasiswa', 'mahasiswa_paymants'));
    }

    public function paymant($id)
    {
        $mahasiswa = Mahasiswa_paymant::where('id', $id)->first();
        $biaya = Biaya::where('id', $mahasiswa->biaya_id)->first();
        $paymentMethods = PaymantMethod::with('paymantKategori')->get();

        return view('customer.pembayaran.retry', compact('mahasiswa', 'paymentMethods', 'biaya'));
    }

    public function invoice($id)
    {
        $invoice = Mahasiswa_paymant::find($id);
        $mahasiswa = Mahasiswa::where('id', $invoice->mahasiswa_id)->with('user')->first();
        $customer = Auth::user();
        $biaya = Biaya::where('id', $invoice->biaya_id)->first();
        $paymentMethod = PaymantMethod::where('methode_initial', $invoice->payment_method)->first();

        return view('customer.pembayaran.invoice', compact('invoice', 'mahasiswa', 'biaya', 'paymentMethod', 'customer'));
    }

    public function create() {}

    public function store(Request $request) {}

    public function storePaymant(Request $request)
    {
        $biaya = Biaya::find($request->biaya_id);

        if (!$biaya) {
            return redirect()->back()->with('error', 'Data biaya tidak ditemukan.');
        }

        try {
            $merchantCode = config('services.duitku.merchant_code', 'D20322');
            $apiKey       = config('services.duitku.api_key', '9b468d49ff1b8b86d9368b92dd85cd51');
            $useSandbox   = config('services.duitku.sandbox', false);

            $paymentAmount = $biaya->nominal;
            $paymentMethod = $request->payment_method;

            // FIX 1: UUID agar tidak collision
            $merchantOrderId = (string) Str::uuid();

            // FIX 2: EXPIRED-kan semua pending lama untuk user + biaya yang sama
            Mahasiswa_paymant::where('user_id', Auth::user()->id)
                ->where('biaya_id', $request->biaya_id)
                ->where('status', 'pending')
                ->update(['status' => 'EXPIRED']);

            $productDetails = $biaya->biaya;
            $email          = Auth::user()->email;
            $phoneNumber    = Auth::user()->phone;
            $customerVaName = Auth::user()->name;
            $callbackUrl    = config('services.duitku.callback_url', env('DUITKU_CALLBACK_URL'));
            $returnUrl      = $returnUrl = route('paymant.status', ['merchantOrderId' => $merchantOrderId,]);
            $expiryPeriod   = 10;
            $signature      = md5($merchantCode . $merchantOrderId . $paymentAmount . $apiKey);

            $customerDetail = [
                'firstName' => Auth::user()->name,
                'lastName'  => '',
                'email'     => $email,
                'phoneNumber' => $phoneNumber,
                'billingAddress' => [
                    'firstName'   => Auth::user()->name,
                    'lastName'    => '',
                    'address'     => '',
                    'city'        => '',
                    'postalCode'  => '',
                    'phone'       => $phoneNumber,
                    'countryCode' => 'ID',
                ],
                'shippingAddress' => [
                    'firstName'   => Auth::user()->name,
                    'lastName'    => '',
                    'address'     => '',
                    'city'        => '',
                    'postalCode'  => '',
                    'phone'       => $phoneNumber,
                    'countryCode' => 'ID',
                ],
            ];

            $itemDetails = [
                ['name' => $biaya->biaya, 'price' => $paymentAmount, 'quantity' => 1],
            ];

            $params = [
                'merchantCode'   => $merchantCode,
                'paymentAmount'  => $paymentAmount,
                'paymentMethod'  => $paymentMethod,
                'merchantOrderId' => $merchantOrderId,
                'productDetails' => $productDetails,
                'customerVaName' => $customerVaName,
                'email'          => $email,
                'phoneNumber'    => $phoneNumber,
                'customerDetail' => $customerDetail,
                'itemDetails'    => $itemDetails,
                'callbackUrl'    => $callbackUrl,
                'returnUrl'      => $returnUrl,
                'signature'      => $signature,
                'expiryPeriod'   => $expiryPeriod,
            ];

            // FIX 3: Create record BARU (bukan updateOrCreate) setelah expired pending lama
            $paymant = Mahasiswa_paymant::create([
                'user_id'          => Auth::user()->id,
                'biaya_id'         => $request->biaya_id,
                'transaction_id'   => null,
                'merchant_order_id' => $merchantOrderId,
                'payment_method'   => $paymentMethod,
                'amount'           => $paymentAmount,
                'status'           => 'pending',
            ]);

            $url = $useSandbox
                ? 'https://sandbox.duitku.com/webapi/api/merchant/v2/inquiry'
                : 'https://passport.duitku.com/webapi/api/merchant/v2/inquiry';

            $response = Http::withHeaders(['Content-Type' => 'application/json'])
                ->post($url, $params);

            Log::info('Duitku API Request:', $params);
            Log::info('Duitku API Response:', ['status' => $response->status(), 'body' => $response->body()]);

            if ($response->successful()) {
                $result = $response->json();
                return redirect()->away($result['paymentUrl']);
            } else {
                // Kalau Duitku gagal, hapus record yang baru dibuat
                $paymant->delete();
                return redirect()->back()->with('error', 'Gagal menghubungi payment gateway. Silakan coba lagi.');
            }
        } catch (\Exception $e) {
            Log::error('Duitku API Error:', ['error' => $e->getMessage()]);
            return redirect()->back()->with('error', 'Terjadi kesalahan sistem. Silakan coba lagi.');
        }
    }

    public function callback(Request $request)
    {
        try {
            $apiKey = config('services.duitku.api_key', '9b468d49ff1b8b86d9368b92dd85cd51');

            $merchantCode   = $request->input('merchantCode');
            $amount         = $request->input('amount');
            $merchantOrderId = $request->input('merchantOrderId');
            $signature      = $request->input('signature');
            $paymentMethod  = $request->input('paymentCode');
            $resultCode     = $request->input('resultCode');

            Log::info('Duitku Callback Data:', $request->all());

            $calcSignature = md5($merchantCode . $amount . $merchantOrderId . $apiKey);

            if (!hash_equals($signature, $calcSignature)) {
                Log::error('Duitku Callback: Invalid Signature');
                return response()->json(['error' => 'Invalid signature'], 400);
            }

            $paymant = Mahasiswa_paymant::where('merchant_order_id', $merchantOrderId)->first();

            if (!$paymant) {
                Log::error("Duitku Callback: Payment Not Found for Order ID: {$merchantOrderId}");
                return response()->json(['error' => 'Payment not found'], 404);
            }

            $status = ($resultCode == '00') ? 'SUCCESS' : 'FAILED';

            $paymant->update([
                'status'         => $status,
                'payment_method' => $paymentMethod,
            ]);

            // FIX 4: Update Generate NIM HANYA untuk program option yang statusnya Daftar Ulang
            if ($status === 'SUCCESS') {
                ProgramOption::where('user_id', $paymant->user_id)
                    ->where('status', 'Daftar Ulang')
                    ->update(['status' => 'Generate NIM']);
            }

            Log::info("Duitku Callback: Payment Updated for Order ID: {$merchantOrderId}");

            return response()->json(['message' => 'Payment status updated'], 200);
        } catch (\Exception $e) {
            Log::error('Duitku Callback Error:', ['error' => $e->getMessage()]);
            return response()->json(['error' => 'Internal Server Error', 'message' => $e->getMessage()], 500);
        }
    }

    public function checkTransactionStatus($merchantOrderId)
    {
        try {
            $merchantCode = config('services.duitku.merchant_code', 'D20322');
            $apiKey       = config('services.duitku.api_key', '9b468d49ff1b8b86d9368b92dd85cd51');
            $useSandbox   = config('services.duitku.sandbox', false);

            $signature = md5($merchantCode . $merchantOrderId . $apiKey);

            $params = [
                'merchantCode'   => $merchantCode,
                'merchantOrderId' => $merchantOrderId,
                'signature'      => $signature,
            ];

            $url = $useSandbox
                ? 'https://sandbox.duitku.com/webapi/api/merchant/transactionStatus'
                : 'https://passport.duitku.com/webapi/api/merchant/transactionStatus';

            $response = Http::withHeaders(['Content-Type' => 'application/json'])
                ->post($url, $params);

            $statusCode = $response->status();
            $paymant = Mahasiswa_paymant::where('merchant_order_id', $merchantOrderId)->first();

            if ($statusCode == 200) {
                $result = $response->json();
                Log::info('Duitku Transaction Status:', $result);

                if ($paymant) {
                    if ($result['statusCode'] == '01') {
                        $paymant->update(['status' => 'EXPIRED']);
                        Log::info("Payment expired for Order ID: {$merchantOrderId}");
                    } elseif ($result['statusCode'] == '00') {
                        $paymant->update(['status' => 'SUCCESS']);
                        ProgramOption::where('user_id', $paymant->user_id)
                            ->where('status', 'Daftar Ulang')
                            ->update(['status' => 'Generate NIM']);
                    } else {
                        $paymant->update(['status' => 'FAILED']);
                    }
                }

                return view('customer.pembayaran.cek', compact('result'));
            } else {
                Log::error('Duitku API Error:', ['status' => $statusCode, 'response' => $response->body()]);
                return redirect()->back()->with('error', 'Terjadi kesalahan ' . $statusCode);
            }
        } catch (\Exception $e) {
            Log::error('Duitku Transaction Status Error:', ['error' => $e->getMessage()]);
            return response()->json(['error' => 'Internal Server Error', 'message' => $e->getMessage()], 500);
        }
    }

    public function retryPayment($id)
    {
        try {
            $paymant = Mahasiswa_paymant::where('id', $id)
                ->where('user_id', Auth::user()->id)
                ->whereIn('status', ['FAILED', 'EXPIRED'])
                ->first();

            if (!$paymant) {
                return redirect()->back()->with('error', 'Pembayaran tidak ditemukan atau tidak bisa diulang.');
            }

            $biaya = Biaya::find($paymant->biaya_id);
            if (!$biaya) {
                return redirect()->back()->with('error', 'Data biaya tidak ditemukan.');
            }

            $merchantCode = config('services.duitku.merchant_code', 'D20322');
            $apiKey       = config('services.duitku.api_key', '9b468d49ff1b8b86d9368b92dd85cd51');
            $useSandbox   = config('services.duitku.sandbox', false);

            $amount          = $paymant->amount;
            $callbackUrl     = config('services.duitku.callback_url', env('DUITKU_CALLBACK_URL'));
            $returnUrl       = route('paymant.index');
            $expiryPeriod    = 10;

            // Generate merchant order ID baru
            $newMerchantOrderId = (string) Str::uuid();
            $signature = md5($merchantCode . $newMerchantOrderId . $amount . $apiKey);

            if (!$paymant->payment_method) {
                return redirect()->back()->with('error', 'Metode pembayaran tidak ditemukan.');
            }

            // EXPIRED-kan pending lama untuk biaya yang sama
            Mahasiswa_paymant::where('user_id', Auth::user()->id)
                ->where('biaya_id', $paymant->biaya_id)
                ->where('status', 'pending')
                ->update(['status' => 'EXPIRED']);

            $customerDetail = [
                'firstName'   => Auth::user()->name,
                'lastName'    => '',
                'email'       => Auth::user()->email,
                'phoneNumber' => Auth::user()->phone,
                'billingAddress' => [
                    'firstName'   => Auth::user()->name,
                    'lastName'    => '',
                    'address'     => '',
                    'city'        => '',
                    'postalCode'  => '',
                    'phone'       => Auth::user()->phone,
                    'countryCode' => 'ID',
                ],
                'shippingAddress' => [
                    'firstName'   => Auth::user()->name,
                    'lastName'    => '',
                    'address'     => '',
                    'city'        => '',
                    'postalCode'  => '',
                    'phone'       => Auth::user()->phone,
                    'countryCode' => 'ID',
                ],
            ];

            $params = [
                'merchantCode'    => $merchantCode,
                'paymentAmount'   => $amount,
                'paymentMethod'   => $paymant->payment_method,
                'merchantOrderId' => $newMerchantOrderId,
                'productDetails'  => $biaya->biaya,
                'customerVaName'  => Auth::user()->name,
                'email'           => Auth::user()->email,
                'phoneNumber'     => Auth::user()->phone,
                'customerDetail'  => $customerDetail,
                'itemDetails'     => [['name' => $biaya->biaya, 'price' => $amount, 'quantity' => 1]],
                'callbackUrl'     => $callbackUrl,
                'returnUrl'       => $returnUrl,
                'signature'       => $signature,
                'expiryPeriod'    => $expiryPeriod,
            ];

            Log::info('Duitku Retry Request Parameters:', $params);

            $url = $useSandbox
                ? 'https://sandbox.duitku.com/webapi/api/merchant/v2/inquiry'
                : 'https://passport.duitku.com/webapi/api/merchant/v2/inquiry';

            $response = Http::withHeaders(['Content-Type' => 'application/json'])
                ->post($url, $params);

            Log::info('Duitku Retry API Response:', ['status' => $response->status(), 'body' => $response->body()]);

            if ($response->successful()) {
                $result = $response->json();

                // Update merchant order ID baru di record lama
                $paymant->update([
                    'merchant_order_id' => $newMerchantOrderId,
                    'status'            => 'pending',
                ]);

                return redirect()->away($result['paymentUrl']);
            } else {
                return redirect()->back()->with('error', 'Gagal menghubungi payment gateway. Silakan coba lagi.');
            }
        } catch (\Exception $e) {
            Log::error('Duitku Retry Payment Error:', ['error' => $e->getMessage()]);
            return redirect()->back()->with('error', 'Terjadi kesalahan sistem.');
        }
    }

    public function show(string $id)
    {
        $biaya = Biaya::find($id);
        $paymentMethods = PaymantMethod::with('paymantKategori')->get();

        if ($biaya && $biaya->type == 'Tunai') {
            return view('customer.pembayaran.show', compact('biaya', 'paymentMethods'));
        }

        return redirect()->back()->with('error', 'Data tidak ditemukan.');
    }

    public function edit(string $id) {}

    public function update(Request $request, string $id) {}

    public function destroy(string $id) {}
}