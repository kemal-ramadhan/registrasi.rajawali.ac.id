<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Biaya extends Model
{
    protected $fillable = [
        'biaya',
        'description',
        'nominal',
        'type',
        'tengat_akhir',
        'status',
    ];

}
