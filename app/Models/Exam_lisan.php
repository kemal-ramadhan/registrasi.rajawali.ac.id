<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Exam_lisan extends Model
{
    protected $fillable = [
        'exams_id',
        'media',
        'link',
        'description',
        'status',
    ];    
}
