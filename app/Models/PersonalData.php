<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PersonalData extends Model
{
    // Pada model PersonalData
    protected $fillable = [
        'user_id',
        'referal_id',
        'gander',
        'nik',
        'nisn',
        'place_of_birth',
        'date_of_birth',
        'religion',
        'media_information',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function referal()
    {
        return $this->belongsTo(Referal::class);
    }
}
