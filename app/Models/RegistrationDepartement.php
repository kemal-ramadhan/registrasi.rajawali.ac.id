<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RegistrationDepartement extends Model
{
    use HasFactory;

    protected $fillable = [
        'registration_path_id',
        'departement_id',
    ];
}
