<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentRequirement extends Model
{
    use HasFactory;

    protected $table = 'document_requirements';

    protected $fillable = [
        'program_option_id',
        'registration_dokumen_id',
        'file',
        'description',
        'status',
    ];
}
