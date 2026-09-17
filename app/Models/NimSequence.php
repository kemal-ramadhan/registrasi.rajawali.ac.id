<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NimSequence extends Model
{
    protected $fillable = [
        'departement_id',
        'year',
        'registration_path_code',
        'last_number'
    ];
}
