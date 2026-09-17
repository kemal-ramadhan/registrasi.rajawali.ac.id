<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $fillable = [
        'exam_participants_id',
        'questions_id',
        'answer',
        'is_correct',
        'point',
    ];
    
    public function question()
    {
        return $this->belongsTo(Questions::class, 'questions_id');
    }

    public function choice()
    {
        return $this->belongsTo(Choices_question::class, 'answer');
    }

}
