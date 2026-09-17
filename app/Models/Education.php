<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    protected $fillable = [
        'user_id',
        'last_education',
        'country',
        'province',
        'city',
        'type',
        'name_of_institution',
        'departement',
        'year_of_graduation',
        'grade',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
