<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa_cicilan extends Model
{
    protected $fillable = [
        'mahasiswa_id',
        'biaya_id',
        'scema_cicilan_id',
    ];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class);
    }

    public function biaya()
    {
        return $this->belongsTo(Biaya::class);
    }

    public function scemaCicilan()
    {
        return $this->belongsTo(Scema_cicilan::class);
    }

}
