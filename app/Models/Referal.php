<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Referal extends Model
{
    protected $fillable = [
        'user_id',
        'institution',
        'code',
        'code_pembayaran',
        'description',
        'status',
    ];

    // Relasi ke PersonalData (satu referal bisa dipakai oleh banyak personal data)
    public function personalData()
    {
        return $this->hasMany(PersonalData::class, 'referal_id');
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // App\Models\Referal.php
    public function pembayaranBk()
    {
        return $this->hasMany(PembayaranBK::class, 'referal_id');
    }

}
