<?php

namespace App\Http\Controllers;

use App\Jobs\SendWhatsappMessage;

use App\Models\DocumentRequirement;
use App\Models\DokumenFirst;
use App\Models\Paymant;
use App\Models\Departement;
use App\Models\ProgramOption;
use App\Models\RegistrationDokumen;
use App\Models\PaymantMethod;
use App\Models\PembayaranBK;
use App\Models\PersonalData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\View;

use App\Models\RegistrationPath;
use App\Models\AkunSistem;
use App\Models\Referal;

class RegistrationProgram extends Controller
{
    public function index($id)
    {
        // FIX IDOR: tambah ownership check
        $programOption = ProgramOption::select(
            'departements.name as departement_name',
            'registration_paths.name as registration_name',
            'registration_paths.title',
            'registration_paths.start_date',
            'registration_paths.end_date',
            'program_options.status',
            'program_options.program_option',
            'program_options.id'
        )
            ->join('departements', 'program_options.departement_id', '=', 'departements.id')
            ->join('registration_paths', 'program_options.registration_path_id', '=', 'registration_paths.id')
            ->where('program_options.id', $id)
            ->where('program_options.user_id', Auth::id())
            ->firstOrFail();

        return view('customer.option.index', compact('programOption'));
    }

    public function indexFinal($id)
    {
        // FIX IDOR: tambah ownership check
        $programOption = ProgramOption::select(
            'departements.name as departement_name',
            'registration_paths.name as registration_name',
            'registration_paths.id as registration_path_id',
            'registration_paths.title',
            'registration_paths.start_date',
            'registration_paths.end_date',
            'registration_paths.link_grup',
            'program_options.status',
            'program_options.program_option',
            'program_options.id'
        )
            ->join('departements', 'program_options.departement_id', '=', 'departements.id')
            ->join('registration_paths', 'program_options.registration_path_id', '=', 'registration_paths.id')
            ->where('program_options.id', $id)
            ->where('program_options.user_id', Auth::id())
            ->firstOrFail();

        $akunSistem = AkunSistem::where('user_id', Auth::id())->first();

        if ($programOption->status == "Menunggu Pengumuman" || $programOption->status == "Lulus" || $programOption->status == "Daftar Ulang" || $programOption->status == "Proses Seleksi" || $programOption->status == "Upload Dokumen" || $programOption->status == "Verifikasi Dokumen" || $programOption->status == "Revisi Dokumen") {
            return view('customer.option.final', compact('programOption', 'akunSistem'));
        } else {
            return back()->with('error', 'Silahkan Lakukan Pembayaran Terlebih Dahulu');
        }
    }

    public function indexDocument($id)
    {
        // FIX IDOR: tambah ownership check
        $programOption = ProgramOption::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

	$registrationPath = \App\Models\RegistrationPath::find($programOption->registration_path_id);

$sudahBayar = \App\Models\Paymant::where('program_option_id', $programOption->id)
    ->where('status', 'SUCCESS')
    ->exists();

if ($registrationPath && $registrationPath->status == 'close' && !$sudahBayar) {
    $jalurAltErnatif = \App\Models\RegistrationPath::whereIn('id', [58, 59])
        ->where('status', 'open')
        ->get();

    $title = 'Jalur Pendaftaran Ditutup';

    return view(
        'customer.option.jalur-ditutup',
        compact('registrationPath', 'jalurAltErnatif', 'title')
    );
}
        $dokumenAwal = DokumenFirst::where('user_id', Auth::id())->first();
        $dokumenSyarats = RegistrationDokumen::where('registration_path_id', $programOption->registration_path_id)->get();

        // FIX kasus Fitri: tambahkan "Daftar Ulang" ke whitelist
        if ($programOption->status == "Menunggu Pengumuman" || $programOption->status == "Lulus" || $programOption->status == "Proses Seleksi" || $programOption->status == "Upload Dokumen" || $programOption->status == "Verifikasi Dokumen" || $programOption->status == "Revisi Dokumen" || $programOption->status == "Daftar Ulang") {
            return view('customer.option.dokumen', compact('dokumenAwal', 'dokumenSyarats', 'programOption'));
        } else {
            return back()->with('error', 'Silahkan Lakukan Pembayaran Terlebih Dahulu');
        }
    }

    public function indexPayment($id)
    {
        $paymentUrl = session('paymentUrl');

        // FIX IDOR: tambah ownership check
        $programOption = ProgramOption::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $registrationPath = RegistrationPath::where('id', $programOption->registration_path_id)->first();
        $pembayaran = Paymant::where('program_option_id', $id)->first();

        $personalData = PersonalData::where('user_id', Auth::id())->first();

        // FIX null pointer: cegah crash jika personalData belum ada
        if (!$personalData) {
            return redirect()->route('personal.data.index')
                ->with('error', 'Silakan lengkapi data pribadi Anda terlebih dahulu.');
        }

        $referal = $personalData->referal_id
            ? Referal::where('id', $personalData->referal_id)->with('user')->first()
            : null;

        $pembayaranBK = PembayaranBK::where('program_option_id', $id)->first();

        return view('customer.option.paymant', compact('registrationPath', 'pembayaran', 'programOption', 'paymentUrl', 'referal', 'pembayaranBK'));
    }

    public function paymant($id)
    {
        // FIX IDOR: tambah ownership check
        $programOption = ProgramOption::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $pembayaran = Paymant::where('program_option_id', $id)->first();
        $paymentMethods = PaymantMethod::with('paymantKategori')->get();

        return view('customer.paymant.index', compact('pembayaran', 'programOption', 'paymentMethods'));
    }

    public function paymantBk($id)
    {
        // FIX IDOR: tambah ownership check
        $programOption = ProgramOption::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $pembayaran = Paymant::where('program_option_id', $id)->first();

        return view('customer.paymant.indexBk', compact('pembayaran', 'programOption'));
    }

    public function akun($id)
    {
        $data = [
            'judul'   => 'Akun Calon Mahasiswa Universitas Bakti Tunas Husada',
            'tanggal' => now()->format('d-m-Y'),
        ];

        $pdf = PDF::loadView('pdfs.akun', compact('data'));
        return $pdf->download('kartu peserta.pdf');
    }

    public function store($id, $idDepartement)
    {
        if (!is_numeric($id) || !is_numeric($idDepartement)) {
            return back()->with('error', 'ID tidak valid.');
        }

        $userId     = Auth::id();
        $lastOption = ProgramOption::where('user_id', $userId)->max('program_option');
        $nextOption = $lastOption ? $lastOption + 1 : 1;

        $registrationPath = RegistrationPath::where('id', $id)->first();
        $status = $registrationPath->amount == 0 ? 'Upload Dokumen' : 'Pembayaran';

        $programOption = ProgramOption::create([
            'registration_path_id' => $id,
            'departement_id'       => $idDepartement,
            'user_id'              => $userId,
            'program_option'       => $nextOption,
            'status'               => $status,
        ]);

        if (!$programOption) {
            return back()->with('error', 'Gagal menyimpan program.');
        }

        $registrationPath = RegistrationPath::where('id', $programOption->registration_path_id)->first();
        Paymant::create([
            'user_id'           => Auth::id(),
            'program_option_id' => $programOption->id,
            'amount'            => $registrationPath->amount,
            'status'            => 'Menunggu Pembayaran',
        ]);

        $departement = Departement::where('id', $programOption->departement_id)->first();
        $user        = Auth::user();
        $phone       = $this->normalizePhone($user->phone);
        $message     = "Hai, {$user->name}!\n\n"
            . "Selamat kamu sudah berhasil memilih *{$registrationPath->name}* *{$registrationPath->title}*"
            . " di Program Studi *{$departement->faculty->programLevel->title}* *{$departement->name}*"
            . " Segera lengkapi berkas persyaratan untuk melanjutkan ke tahap berikutnya.";

        SendWhatsappMessage::dispatchAfterResponse($phone, $message);

        return redirect()->route('registration.option', ['id' => $programOption->id])
            ->with('success', 'Program berhasil ditambahkan.');
    }

    public function storeDokumen(Request $request)
    {
        $request->validate([
            'personal_foto' => 'nullable|mimes:jpg,jpeg,png,pdf|max:2048',
            'personal_card' => 'nullable|mimes:jpg,jpeg,png,pdf|max:2048',
            'family_foto'   => 'nullable|mimes:jpg,jpeg,png,pdf|max:2048',
            'family_card'   => 'nullable|mimes:jpg,jpeg,png,pdf|max:2048',
            'files'         => 'nullable|array',
            'files.*'       => 'file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        $dokumenFirst = DokumenFirst::where('user_id', Auth::id())->first();
        if (!$dokumenFirst) {
            $dokumenFirst          = new DokumenFirst();
            $dokumenFirst->user_id = Auth::id();
        }

        if ($request->hasFile('personal_foto')) {
            if ($dokumenFirst->personal_foto) Storage::delete('public/' . $dokumenFirst->personal_foto);
            $dokumenFirst->personal_foto = $request->file('personal_foto')->store('uploads/personal_foto', 'public');
        }
        if ($request->hasFile('personal_card')) {
            if ($dokumenFirst->personal_card) Storage::delete('public/' . $dokumenFirst->personal_card);
            $dokumenFirst->personal_card = $request->file('personal_card')->store('uploads/personal_card', 'public');
        }
        if ($request->hasFile('family_foto')) {
            if ($dokumenFirst->family_foto) Storage::delete('public/' . $dokumenFirst->family_foto);
            $dokumenFirst->family_foto = $request->file('family_foto')->store('uploads/family_foto', 'public');
        }
        if ($request->hasFile('family_card')) {
            if ($dokumenFirst->family_card) Storage::delete('public/' . $dokumenFirst->family_card);
            $dokumenFirst->family_card = $request->file('family_card')->store('uploads/family_card', 'public');
        }

        $dokumenFirst->save();

        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $slug_name => $file) {
                $filename = time() . '_' . $file->getClientOriginalName();
                $filePath = $file->storeAs('uploads/dokumen-syarat', $filename, 'public');

                $documentRequirement = DocumentRequirement::where([
                    'program_option_id'       => $request->program_option_id,
                    'registration_dokumen_id' => $request->input('dokumen_ids')[$slug_name],
                ])->first();

                if ($documentRequirement) {
                    Storage::delete('public/' . $documentRequirement->file);
                    $documentRequirement->file   = $filePath;
                    $documentRequirement->status = 'Verifikasi Dokumen';
                    $documentRequirement->save();
                } else {
                    DocumentRequirement::create([
                        'program_option_id'       => $request->program_option_id,
                        'registration_dokumen_id' => $request->input('dokumen_ids')[$slug_name],
                        'file'                    => $filePath,
                        'description'             => null,
                        'status'                  => 'Verifikasi Dokumen',
                    ]);
                }
            }
        }

        $programOption    = ProgramOption::find($request->program_option_id);
        $registrationPath = RegistrationPath::where('id', $programOption->registration_path_id)->first();
        $paymantActive    = Paymant::where('program_option_id', $request->program_option_id)->first();

        if (!$paymantActive) {
            Paymant::create([
                'user_id'           => Auth::id(),
                'program_option_id' => $request->program_option_id,
                'amount'            => $registrationPath->amount,
                'status'            => 'Menunggu Pembayaran',
            ]);
            $programOption->update(['status' => 'Pembayaran']);
        }

        if ($programOption->status == 'Upload Dokumen') {
            $programOption->update(['status' => 'Verifikasi Dokumen']);
        }
        if ($programOption->status == 'Revisi Dokumen') {
            $programOption->update(['status' => 'Verifikasi Dokumen']);
        }

        return redirect()->route('registration.option.test', $request->program_option_id)
            ->with('success', 'Dokumen berhasil diunggah!');
    }

    public function getPaymant(Request $request)
    {
        try {
            $merchantCode  = config('services.duitku.merchant_code');
            $apiKey        = config('services.duitku.api_key');
            $datetime      = date('Y-m-d H:i:s');
            $paymentAmount = $request->amount;
            $signature     = hash('sha256', $merchantCode . $paymentAmount . $datetime . $apiKey);

            $params        = ['merchantcode' => $merchantCode, 'amount' => $paymentAmount, 'datetime' => $datetime, 'signature' => $signature];
            $params_string = json_encode($params);

            $url = config('services.duitku.sandbox')
                ? 'https://sandbox.duitku.com/webapi/api/merchant/paymentmethod/getpaymentmethod'
                : 'https://passport.duitku.com/webapi/api/merchant/paymentmethod/getpaymentmethod';

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_POSTFIELDS, $params_string);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json', 'Content-Length: ' . strlen($params_string)]);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

            $result   = curl_exec($ch);
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);

            Log::info('Duitku getPaymant:', ['status' => $httpCode]);

            if ($httpCode == 200) {
                return response()->json(json_decode($result, true));
            } else {
                return response()->json(['error' => "Server Error $httpCode"], $httpCode);
            }
        } catch (\Exception $e) {
            Log::error('Duitku getPaymant Error:', ['error' => $e->getMessage()]);
            return response()->json(['message' => 'Terjadi kesalahan', 'error' => $e->getMessage()], 500);
        }
    }

    public function storePaymantBk(Request $request)
    {
        $request->validate([
            'program_option_id' => 'required',
            'code_pembayaran'   => 'required',
        ]);

        $cekCode = Referal::where('code_pembayaran', $request->code_pembayaran)->first();

        if ($cekCode) {
            PembayaranBK::create([
                'user_id'           => Auth::id(),
                'program_option_id' => $request->program_option_id,
                'referal_id'        => $cekCode->id,
                'nominal'           => $request->amount,
                'type'              => 'Pendaftaran',
                'status_approve'    => 'pending', // FIX TYPO: was 'panding'
                'status_keuangan'   => 'pending',
            ]);

            $personalData = PersonalData::where('user_id', Auth::id())->first();
            // FIX null pointer
            if ($personalData) {
                $personalData->update(['referal_id' => $cekCode->id]);
            }

            $payment = Paymant::where('program_option_id', $request->program_option_id)->first();
            // FIX null pointer
            if ($payment) {
                $payment->update(['status' => 'pending']);
            } else {
                Paymant::create([
                    'user_id'           => Auth::id(),
                    'program_option_id' => $request->program_option_id,
                    'amount'            => $request->amount ?? 0,
                    'status'            => 'pending',
                ]);
            }

            $programOption = ProgramOption::findOrFail($request->program_option_id);
            $programOption->update(['status' => 'Verifikasi Guru BK']);

            return redirect()->route('registration.option.paymant', $request->program_option_id)
                ->with('success', 'Code Berhasil Digunakan, Silahkan Hubungi Guru BK Untuk men-verifikasi Pembayaran');
        } else {
            return back()->with('error', 'Code Pembayaran Salah');
        }
    }

    public function storePaymant(Request $request)
    {
        $programOption    = ProgramOption::findOrFail($request->program_option_id);
        $registrationPath = RegistrationPath::findOrFail($programOption->registration_path_id);

        try {
            $merchantCode = config('services.duitku.merchant_code');
            $apiKey       = config('services.duitku.api_key');

            // FIX BUSINESS LOGIC: ambil amount dari DB, BUKAN dari request
            // Mencegah user manipulasi nominal pembayaran
            $paymentAmount = $registrationPath->amount;

            $paymentMethod = $request->payment_method;

            // FIX RACE CONDITION: UUID bukan time()
            $merchantOrderId = (string) \Illuminate\Support\Str::uuid();

            $productDetails = $registrationPath->name;
            $email          = Auth::user()->email;
            $phoneNumber    = Auth::user()->phone;
            $customerVaName = Auth::user()->name;
            $callbackUrl    = env('DUITKU_CALLBACK_URL');
            $returnUrl      = route('transaction.status', ['merchantOrderId' => $merchantOrderId ]); // route('registration.option.paymant', ['id' => $programOption->id]);
            $expiryPeriod   = 1;
            $signature      = md5($merchantCode . $merchantOrderId . $paymentAmount . $apiKey);

            $customerDetail = [
                'firstName'   => Auth::user()->name,
                'lastName'    => "",
                'email'       => $email,
                'phoneNumber' => $phoneNumber,
                'billingAddress' => [
                    'firstName' => Auth::user()->name, 'lastName' => "",
                    'address' => "", 'city' => "", 'postalCode' => "",
                    'phone' => $phoneNumber, 'countryCode' => "ID",
                ],
                'shippingAddress' => [
                    'firstName' => Auth::user()->name, 'lastName' => "",
                    'address' => "", 'city' => "", 'postalCode' => "",
                    'phone' => $phoneNumber, 'countryCode' => "ID",
                ],
            ];

            $itemDetails = [['name' => $registrationPath->name, 'price' => $paymentAmount, 'quantity' => 1]];

            $params = [
                'merchantCode'    => $merchantCode,
                'paymentAmount'   => $paymentAmount,
                'paymentMethod'   => $paymentMethod,
                'merchantOrderId' => $merchantOrderId,
                'productDetails'  => $productDetails,
                'customerVaName'  => $customerVaName,
                'email'           => $email,
                'phoneNumber'     => $phoneNumber,
                'customerDetail'  => $customerDetail,
                'itemDetails'     => $itemDetails,
                'callbackUrl'     => $callbackUrl,
                'returnUrl'       => $returnUrl,
                'signature'       => $signature,
                'expiryPeriod'    => $expiryPeriod,
            ];

            $payment = Paymant::where('program_option_id', $request->program_option_id)->first();
            // FIX null pointer
            if (!$payment) {
                $payment = Paymant::create([
                    'user_id'           => Auth::id(),
                    'program_option_id' => $request->program_option_id,
                    'amount'            => $paymentAmount,
                    'status'            => 'pending',
                ]);
            }

            $payment->update([
                'merchant_order_id' => $merchantOrderId,
                'payment_method'    => $paymentMethod,
                'status'            => 'pending',
            ]);

            $duitkuUrl = config('services.duitku.sandbox')
                ? 'https://sandbox.duitku.com/webapi/api/merchant/v2/inquiry'
                : 'https://passport.duitku.com/webapi/api/merchant/v2/inquiry';

            $response = Http::withHeaders(['Content-Type' => 'application/json'])->post($duitkuUrl, $params);

            Log::info('Duitku API Request:', $params);
            Log::info('Duitku API Response:', ['status' => $response->status(), 'body' => $response->body()]);

            if ($response->successful()) {
                $result = $response->json();
                return redirect()->away($result['paymentUrl']);
            } else {
                return response()->json(['error' => "Server Error " . $response->status()], $response->status());
            }
        } catch (\Exception $e) {
            Log::error('Duitku API Error:', ['error' => $e->getMessage()]);
            return response()->json(['message' => 'Terjadi kesalahan', 'error' => $e->getMessage()], 500);
        }
    }

    public function callback(Request $request)
    {
        try {
            $apiKey          = config('services.duitku.api_key');
            $merchantCode    = $request->input('merchantCode');
            $amount          = $request->input('amount');
            $merchantOrderId = $request->input('merchantOrderId');
            $signature       = $request->input('signature');
            $paymentMethod   = $request->input('paymentCode');
            $resultCode      = $request->input('resultCode');

            Log::info('Duitku Callback Data:', $request->all());

            $calcSignature = md5($merchantCode . $amount . $merchantOrderId . $apiKey);

            if (!hash_equals($signature, $calcSignature)) {
                Log::error('Duitku Callback: Invalid Signature');
                return response()->json(['error' => 'Invalid signature'], 400);
            }

            $payment = Paymant::where('merchant_order_id', $merchantOrderId)->first();

            if (!$payment) {
                Log::error("Duitku Callback: Payment Not Found for Order ID: {$merchantOrderId}");
                return response()->json(['error' => 'Payment not found'], 404);
            }

            $status = ($resultCode == "00") ? "SUCCESS" : "FAILED";

            $payment->update(['status' => $status, 'payment_method' => $paymentMethod]);

            $programOption = ProgramOption::findOrFail($payment->program_option_id);

            if ($status == "SUCCESS") $programOption->update(['status' => 'Lakukan Test']);
            if ($status == "FAILED")  $programOption->update(['status' => 'Pembayaran Gagal']);

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
            $merchantCode = config('services.duitku.merchant_code');
            $apiKey       = config('services.duitku.api_key');
            $signature    = md5($merchantCode . $merchantOrderId . $apiKey);

            $params = ['merchantCode' => $merchantCode, 'merchantOrderId' => $merchantOrderId, 'signature' => $signature];

            $duitkuUrl = config('services.duitku.sandbox')
                ? 'https://sandbox.duitku.com/webapi/api/merchant/transactionStatus'
                : 'https://passport.duitku.com/webapi/api/merchant/transactionStatus';

            $response   = Http::withHeaders(['Content-Type' => 'application/json'])->post($duitkuUrl, $params);
            $statusCode = $response->status();

            $paymant = Paymant::where('merchant_order_id', $merchantOrderId)->first();

            if (!$paymant) {
                return redirect()->route('beranda')->with('error', 'Data pembayaran tidak ditemukan.');
            }

            $programOption = ProgramOption::find($paymant->program_option_id);

            if ($statusCode == 200) {
                $result  = $response->json();
                $payment = Paymant::where('merchant_order_id', $merchantOrderId)->first();

                Log::info('Duitku Transaction Status:', $result);

                if ($payment) {
                    $user  = Auth::user();
                    $phone = $this->normalizePhone($user->phone);

                    if ($result['statusCode'] == "01") {
                        $payment->update(['status' => 'EXPIRED']);
                        $message = "Hai, {$user->name}!\n\nWaktu pembayaran Anda sudah berakhir. Silakan lakukan pendaftaran ulang atau pilih metode pembayaran lain.";
                    } elseif ($result['statusCode'] == "00") {
                        $payment->update(['status' => 'SUCCESS']);
                        $programOption->update(['status' => 'Upload Dokumen']);
                        $message = "Hai, {$user->name}!\n\nTerima kasih sudah melakukan pembayaran formulir pendaftaran. Pendaftaran Anda akan segera diverifikasi.";
                    } else {
                        $payment->update(['status' => 'FAILED']);
                        $message = "Hai, {$user->name}!\n\nTransaksi pembayaran Anda gagal diproses. Mohon periksa kembali metode pembayaran yang digunakan.";
                    }

                    SendWhatsappMessage::dispatchAfterResponse($phone, $message);
                }

                // dd($result);

                return view('customer.paymant.status', compact('result', 'programOption'));
            } else {
                // FIX: redirect eksplisit bukan redirect()->back() yang bisa crash
                Log::error('Duitku API Error:', ['status' => $statusCode, 'response' => $response->body()]);

                $errorMessage = match($statusCode) {
                    404     => 'Transaksi tidak ditemukan. Kemungkinan sudah kedaluwarsa atau belum diproses.',
                    401     => 'Autentikasi gagal. Silakan hubungi admin.',
                    500     => 'Server pembayaran sedang gangguan. Coba beberapa saat lagi.',
                    default => 'Gagal mengecek status pembayaran (kode: ' . $statusCode . '). Coba lagi nanti.',
                };

                return redirect()->route('registration.option.paymant', $programOption->id)
                    ->with('error', $errorMessage);
            }
        } catch (\Exception $e) {
            Log::error('Duitku Transaction Status Error:', ['error' => $e->getMessage()]);
            return response()->json(['error' => 'Internal Server Error', 'message' => $e->getMessage()], 500);
        }
    }

    public function retryPayment($merchantOrderId)
    {
        try {
            $payment = Paymant::where('merchant_order_id', $merchantOrderId)
                ->whereIn('status', ['FAILED', 'EXPIRED'])
                ->first();

            if (!$payment) return response()->json(['error' => 'Payment not found or cannot be retried'], 404);

            $programOption = ProgramOption::find($payment->program_option_id);
            if (!$programOption) return response()->json(['error' => 'Program option not found'], 404);

            $registrationPath = RegistrationPath::find($programOption->registration_path_id);
            if (!$registrationPath) return response()->json(['error' => 'Registration path not found'], 404);

            $merchantCode = config('services.duitku.merchant_code');
            $apiKey       = config('services.duitku.api_key');
            $amount       = $payment->amount;
            $callbackUrl  = env('DUITKU_CALLBACK_URL');
            $returnUrl    = env('DUITKU_RETURN_URL');
            $expiryPeriod = 10;
            $signature    = md5($merchantCode . $merchantOrderId . $amount . $apiKey);

            if (!$payment->payment_method) return response()->json(['error' => 'Payment method is missing'], 400);

            $customerDetail = [
                'firstName' => Auth::user()->name, 'lastName' => "",
                'email' => Auth::user()->email, 'phoneNumber' => Auth::user()->phone,
                'billingAddress'  => ['firstName' => Auth::user()->name, 'lastName' => "", 'address' => "", 'city' => "", 'postalCode' => "", 'phone' => Auth::user()->phone, 'countryCode' => "ID"],
                'shippingAddress' => ['firstName' => Auth::user()->name, 'lastName' => "", 'address' => "", 'city' => "", 'postalCode' => "", 'phone' => Auth::user()->phone, 'countryCode' => "ID"],
            ];

            $params = [
                'merchantCode' => $merchantCode, 'paymentAmount' => $amount,
                'paymentMethod' => $payment->payment_method, 'merchantOrderId' => $merchantOrderId,
                'productDetails' => $registrationPath->name, 'customerVaName' => Auth::user()->name,
                'email' => Auth::user()->email, 'phoneNumber' => Auth::user()->phone,
                'customerDetail' => $customerDetail,
                'itemDetails' => [['name' => $registrationPath->name, 'price' => $amount, 'quantity' => 1]],
                'callbackUrl' => $callbackUrl, 'returnUrl' => $returnUrl,
                'signature' => $signature, 'expiryPeriod' => $expiryPeriod,
            ];

            Log::info('Duitku Retry Request:', $params);

            $duitkuUrl = config('services.duitku.sandbox')
                ? 'https://sandbox.duitku.com/webapi/api/merchant/v2/inquiry'
                : 'https://passport.duitku.com/webapi/api/merchant/v2/inquiry';

            $response   = Http::withHeaders(['Content-Type' => 'application/json'])->post($duitkuUrl, $params);
            $statusCode = $response->status();
            $body       = $response->body();

            Log::info('Duitku Retry Response:', ['status' => $statusCode]);

            if ($statusCode == 200) {
                $result = $response->json();
                return response()->json(['message' => 'Payment retried successfully', 'paymentUrl' => $result['paymentUrl']]);
            } else {
                return response()->json(['error' => 'Server Error ' . $statusCode, 'message' => json_decode($body, true)], $statusCode);
            }
        } catch (\Exception $e) {
            Log::error('Duitku Retry Error:', ['error' => $e->getMessage()]);
            return response()->json(['error' => 'Internal Server Error', 'message' => $e->getMessage()], 500);
        }
    }

    public function destroyOption($id)
    {
        // FIX IDOR: pastikan hanya pemilik yang bisa hapus
        $deleted = ProgramOption::where('id', $id)->where('user_id', Auth::id())->delete();

        if (!$deleted) {
            return redirect()->route('registration.program')
                ->with('error', 'Data tidak ditemukan atau Anda tidak memiliki akses.');
        }

        return redirect()->route('registration.program')
            ->with('success', 'Program berhasil dihapus, Silahkan Pilih Program Lainnya.');
    }

    public function deleteDokumen($field)
    {
        $dokumenAwal = DokumenFirst::where('user_id', Auth::id())->first();

        if (!$dokumenAwal || empty($dokumenAwal->$field)) {
            return redirect()->back()->with('error', 'Dokumen tidak ditemukan!');
        }

        Storage::disk('public')->delete($dokumenAwal->$field);
        $dokumenAwal->update([$field => null]);

        return redirect()->back()->with('success', 'Dokumen berhasil dihapus.');
    }

    public function deleteDokumenSyarat($id)
    {
        $dokumenRequirement = \App\Models\DocumentRequirement::find($id);

        if (!$dokumenRequirement || empty($dokumenRequirement->file)) {
            return redirect()->back()->with('error', 'Dokumen tidak ditemukan!');
        }

        Storage::disk('public')->delete($dokumenRequirement->file);
        DocumentRequirement::where('id', $id)->delete();

        return redirect()->back()->with('success', 'Dokumen berhasil dihapus.');
    }

    private function normalizePhone($phone)
    {
        $phone = preg_replace('/[^0-9]/', '', $phone);
        if (substr($phone, 0, 1) === '0') {
            $phone = '62' . substr($phone, 1);
        }
        return $phone;
    }
}