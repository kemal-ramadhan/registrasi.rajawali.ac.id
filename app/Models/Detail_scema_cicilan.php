<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Detail_scema_cicilan extends Model
{
    protected $fillable = [
        'scema_cicilan_id',
        'cicilan_ke',
        'nominal',
        'tengat',
    ];

    public function scema_cicilan()
    {
        return $this->belongsTo(Scema_cicilan::class);
    }
}
