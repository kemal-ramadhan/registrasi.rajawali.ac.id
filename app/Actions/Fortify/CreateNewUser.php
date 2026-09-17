<?php

namespace App\Actions\Fortify;

use App\Jobs\SendWhatsappMessage;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Http;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Notifications\EmailOtpNotification;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class),
            ],
            'password' => $this->passwordRules(),
            'phone' => ['required', 'string', 'max:15'],
        ])->validate();

        $user = User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'phone' => $input['phone'],
            'role' => 'Customer',
            'password' => Hash::make($input['password']),
        ]);

        
        // generate OTP (6 digit)
        $otpPlain = random_int(100000, 999999);
        $otpHash = Hash::make($otpPlain);
        $expiresAt = Carbon::now()->addMinutes(10);

         // simpan ke user
        $user->update([
            'email_otp' => $otpHash,
            'email_otp_expires_at' => $expiresAt,
            'email_otp_attempts' => 0,
        ]);

        // kirim OTP via notification
        $user->notify(new EmailOtpNotification($otpPlain, 10));

        $phone = $this->normalizePhone($user->phone);
        $message = "Hai, {$user->name}!\n\n"
        . "Silakan masukkan kode OTP " . "*{$otpPlain}*" . " untuk menyelesaikan proses verifikasi akun.";

        // Panggil fungsi kirim pesan
        SendWhatsappMessage::dispatchAfterResponse($phone, $message);

        // Simpan ke Google Spreadsheet
        $this->saveToSheetDB($user);

        return $user;
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

    private function saveToSheetDB(User $user)
    {
        $webhook_url = 'https://script.google.com/macros/s/AKfycbwyK20aKpJHOKYLzZp8xxbnaPlzfXrVl0SnZm6ifHQBIDKNVF8_w5-bi7nK6eOBDyI8tA/exec';

        $data = [
            'nama' => $user->name,
            'email' => $user->email,
            'phone' => $user->phone,
            'tanggal' => now()->format('Y-m-d'),
        ];

        Log::info('Mengirim data ke Google Sheets:', $data);

        try {
            // $response = Http::withHeaders([
            //     'Content-Type' => 'application/json',
            // ])->post($webhook_url, $data);

            $response = Http::asJson()->post($webhook_url, $data);

            Log::info('Response dari Google Sheets:', [
                'status' => $response->status(),
                'body' => $response->body(),
            ]);
        } catch (\Exception $e) {
            Log::error('Gagal mengirim data ke Google Sheets:', [
                'message' => $e->getMessage(),
            ]);
        }
    }


}
