<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Http;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendWhatsappMessage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $phone;
    protected $message;


    public function __construct($phone, $message)
    {
        $this->phone = $phone;
        $this->message = $message;
    }

    public function handle()
    {
        Http::withHeaders([
            'Content-Type' => 'application/json',
        ])->post('https://api.watzap.id/v1/send_message', [
            'api_key' => 'UHIFCQ508DDXFLZH',
            // 'number_key' => 'I9FlsickUas6xUGq', // Nomor Uji COba
            'number_key' => 'rjn5OoVC5qU0ihFx', // Nomor UBTH rjn5OoVC5qU0ihFx
            'phone_no' => $this->phone,
            'message' => $this->message,
            'wait_until_send' => 1,
        ]);
    }
}
