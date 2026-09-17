<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Choices_question extends Model
{
    protected $fillable = [
        'questions_id',
        'choice',
        'is_correct',
    ];

    // Relasi banyak ke satu (many-to-one) ke Questions
    public function question()
    {
        return $this->belongsTo(Questions::class);
    }
    
}
