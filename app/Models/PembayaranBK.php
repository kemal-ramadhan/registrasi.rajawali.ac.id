<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PembayaranBK extends Model
{
    protected $fillable = [
        'user_id',
        'program_option_id',
        'referal_id',
        'nominal',
        'type',
        'status_approve',
        'status_keuangan',
    ];

    // App\Models\PembayaranBK.php
    public function referal()
    {
        return $this->belongsTo(Referal::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }


}
