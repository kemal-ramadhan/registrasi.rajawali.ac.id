<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Faculty extends Model
{
    protected $fillable = [
        'program_level_id',
        'code',
        'name',
        'description',
        'image',
        'status',
    ];

    public function programLevel()
    {
        return $this->belongsTo(ProgramLevel::class);
    }

}
