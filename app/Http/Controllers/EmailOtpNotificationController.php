<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\User;
use App\Notifications\EmailOtpNotification;
use App\Jobs\SendWhatsappMessage;

class EmailOtpNotificationController extends Controller
{
    public function verify(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'otp' => 'required|digits:6',
        ]);

        $user = User::where('email', $request->email)->first();

        if(!$user){
            return back()->withErrors(['email'=>'Email tidak ditemukan.']);
        }

        // cek expiry
        if(!$user->email_otp_expires_at || Carbon::now()->greaterThan($user->email_otp_expires_at)){
            return back()->withErrors(['otp'=>'Kode OTP sudah kadaluarsa. Silakan minta pengiriman ulang.']);
        }

        // rate-limit sederhana berdasarkan attempts
        if($user->email_otp_attempts >= 5){
            return back()->withErrors(['otp'=>'Terlalu banyak percobaan. Silakan minta OTP baru.']);
        }

        if(Hash::check($request->otp, $user->email_otp)){
            // verifikasi sukses
            $user->update([
                'email_verified_at' => Carbon::now(),
                'email_otp' => null,
                'email_otp_expires_at' => null,
                'email_otp_attempts' => 0,
            ]);

            // opsional: login user
            Auth::login($user);

            $phone = $this->normalizePhone($user->phone);
            $message = "Hai, {$user->name}!\n\n"
            . "Terima kasih telah mendaftar, akun kamu sudah terverifikasi. Silakan segera isi biodata untuk melanjutkan proses pendaftaran.";

            // Panggil fungsi kirim pesan
            SendWhatsappMessage::dispatchAfterResponse($phone, $message);

            return redirect()->route('beranda')->with('success','Email berhasil diverifikasi.');
        } else {
            $user->increment('email_otp_attempts');
            return back()->withErrors(['otp'=>'Kode tidak cocok.']);
        }
    }

    public function resend(Request $request)
    {
        $request->validate(['email'=>'required|email']);

        $user = User::where('email', $request->email)->first();
        if(!$user) return back()->withErrors(['email'=>'Email tidak ditemukan.']);

        // batasi resend misal 3 kali per 15 menit (implementasi sederhana: cek attempts atau gunakan cache)
        // generate baru
        $otpPlain = random_int(100000, 999999);
        $otpHash = Hash::make($otpPlain);
        $expiresAt = Carbon::now()->addMinutes(10);

        $user->update([
            'email_otp' => $otpHash,
            'email_otp_expires_at' => $expiresAt,
            'email_otp_attempts' => 0,
        ]);

        $user->notify(new EmailOtpNotification($otpPlain, 10));

        $phone = $this->normalizePhone($user->phone);
        $message = "Hai, {$user->name}!\n\n"
        . "Silakan masukkan kode OTP " . "*{$otpPlain}*" . " untuk menyelesaikan proses verifikasi akun.";

        // Panggil fungsi kirim pesan
        SendWhatsappMessage::dispatchAfterResponse($phone, $message);

        return back()->with('status','OTP baru sudah dikirim.');
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
