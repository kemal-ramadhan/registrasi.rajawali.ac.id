<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DokumenFirst extends Model
{
    protected $fillable = [
        'user_id',
        'personal_foto',
        'personal_card',
        'family_foto',
        'family_card',
        'description',
        'status',
    ];
}
