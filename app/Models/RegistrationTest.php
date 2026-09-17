<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RegistrationTest extends Model
{
    protected $fillable = [
        'registration_path_id',
        'name',
        'description',
        'start_date',
        'end_date',
        'image',
        'link_grup',
        'status',
    ];
}
