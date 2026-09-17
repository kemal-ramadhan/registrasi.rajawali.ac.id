<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProgramLevel extends Model
{
    protected $fillable = [
        'code',
        'title',
        'description',
        'image',
        'status',
    ];
}
