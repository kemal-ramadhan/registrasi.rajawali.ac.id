<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    protected $fillable = [
        'exam_participants_id',
        'score',
        'description',
        'status',
    ];

    public function examParticipant()
    {
        return $this->belongsTo(Exam_participants::class, 'exam_participants_id');
    }
}
