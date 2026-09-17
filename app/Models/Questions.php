<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Questions extends Model
{
    protected $fillable = [
        'exams_id',
        'type',
        'question',
        'point',
    ];    

    // Relasi one-to-many dengan Choice
    public function choices()
    {
        return $this->hasMany(Choices_question::class);  // Pastikan nama model Choice sesuai dengan nama file model
    }
}
