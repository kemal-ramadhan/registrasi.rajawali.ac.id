<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nim_mahasiswa extends Model
{
    protected $fillable = [
        'user_id',
        'departement_id',
        'nim',
        'angkatan',
        'status',
    ];    
}
