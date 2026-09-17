<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Exams extends Model
{
    protected $fillable = [
        'registration_path_id',
        'name',
        'description',
        'start_date',
        'duration',
        'pengerjaan',
        'pengerjaan_waktu',
        'type',
        'status',
    ];

    public function registration_path()
    {
        return $this->belongsTo(RegistrationPath::class);
    }
    
}
