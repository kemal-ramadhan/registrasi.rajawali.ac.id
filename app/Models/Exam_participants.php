<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Exam_participants extends Model
{
    protected $fillable = [
        'exams_id',
        'user_id',
        'start_date',
        'end_date',
        'point',
        'token',
        'status',
    ];
    
    public function answers()
    {
        return $this->hasMany(Answer::class, 'exam_participants_id');
    }

    public function exam()
    {
        return $this->belongsTo(Exams::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }


}
