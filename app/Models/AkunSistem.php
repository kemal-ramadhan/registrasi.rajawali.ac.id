<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AkunSistem extends Model
{
    protected $fillable = [
        'user_id',
        'username',
        'password',
        'status',
    ];
}
