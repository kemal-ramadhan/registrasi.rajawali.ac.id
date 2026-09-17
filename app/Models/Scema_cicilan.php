<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Scema_cicilan extends Model
{
    protected $fillable = [
        'biaya_id',
        'description',
        'potongan',
        'jumlah_cicilan',
        'status',
    ];

    public function biaya()
    {
        return $this->belongsTo(Biaya::class);
    }
}
