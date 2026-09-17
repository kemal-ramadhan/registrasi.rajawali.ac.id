<?php

namespace App\Http\Controllers;

use App\Jobs\SendWhatsappMessage;

use App\Models\Paymant;
use Illuminate\Http\Request;

use App\Models\Referal;
use App\Models\PembayaranBK;
use App\Models\ProgramOption;
use App\Models\User;

class ReferalBkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() {}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, string $id)
    {
        $referal = Referal::with(['personalData.user', 'user', 'pembayaranBk.user'])
            ->findOrFail($id);

        $search = $request->input('search');

        $personalData = $referal->personalData()
            ->when($search, function ($query, $search) {
                $query->whereHas('user', function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
                });
            })
            ->paginate(10);

        $pembayaranBk = $referal->pembayaranBk;

        $totalTransaksiAll = PembayaranBK::where('status_approve', 'SUCCESS')->where('referal_id', $id)->sum('nominal');
        $tagihan = PembayaranBK::where('status_keuangan', 'Tagihan')->where('referal_id', $id)->sum('nominal');
        $lunas = PembayaranBK::where('status_keuangan', 'Success')->where('referal_id', $id)->sum('nominal');
        $pending = PembayaranBK::where('status_approve', 'panding')->where('referal_id', $id)->sum('nominal');

        return view('bk.referal.index', compact('referal', 'personalData', 'pembayaranBk', 'search', 'totalTransaksiAll', 'tagihan', 'lunas', 'pending'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $pembayaran = PembayaranBK::findOrFail($id);
        $paymant = Paymant::where('program_option_id', $pembayaran->program_option_id)->first();
        $programOption = ProgramOption::find($pembayaran->program_option_id);

        if ($request->action === 'approve') {

            $pembayaran->update([
                'status_approve' => 'SUCCESS',
                'status_keuangan' => 'Tagihan',
            ]);

            $paymant->update([
                'status' => 'Tagihan',
            ]);

            $programOption->update([
                'status' => 'Upload Dokumen',
            ]);

            $user = User::find($pembayaran->user_id);

            if ($user && $user->phone) {
                $phone = $this->normalizePhone($user->phone);

                $message = "Hai, {$user->name}! 🎉\n\n" .
                    "Pembayaran kamu telah berhasil diverifikasi oleh pihak sekolah. " .
                    "Sekarang kamu bisa melanjutkan ke tahap berikutnya untuk melengkapi proses pendaftaran ya! 💪";
            }


            // Panggil fungsi kirim pesan
            SendWhatsappMessage::dispatchAfterResponse($phone, $message);

            return back()->with('success', 'Status pembayaran berhasil diperbarui.');
        } elseif ($request->action === 'reject') {
            
            $paymant->update([
                'status' => 'Menunggu Pembayaran',
            ]);
            
            $programOption->update([
                'status' => 'Pembayaran',
            ]);

            $user = User::find($pembayaran->user_id);

            if ($user && $user->phone) {
                $phone = $this->normalizePhone($user->phone);

                $message = "Hai, {$user->name}. 🙏\n\n" .
                    "Maaf ya, setelah dilakukan pengecekan, pembayaran kamu belum bisa kami verifikasi. 😔\n\n" .
                    "Kamu bisa upload ulang atau hubungi pihak sekolah untuk bantuan lebih lanjut.\n\n" .
                    "Terima kasih atas pengertiannya.";
            }

            // Panggil fungsi kirim pesan
            SendWhatsappMessage::dispatchAfterResponse($phone, $message);

            $pembayaran->delete();
            return back()->with('success', 'Pembayaran Telah di Batalkan');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    private function normalizePhone($phone)
    {
        // Hilangkan spasi, tanda plus, strip, dan karakter aneh lainnya
        $phone = preg_replace('/[^0-9]/', '', $phone);

        // Jika dimulai dengan 0, ubah jadi 62
        if (substr($phone, 0, 1) === '0') {
            $phone = '62' . substr($phone, 1);
        }

        return $phone;
    }
}
