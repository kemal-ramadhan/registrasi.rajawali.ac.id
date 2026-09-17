<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RegistrationDokumen extends Model
{
    protected $table = 'registration_dokumens';

    protected $fillable = [
        'registration_path_id',
        'dokumen_name',
        'slug_name',
        'description',
    ];
}
