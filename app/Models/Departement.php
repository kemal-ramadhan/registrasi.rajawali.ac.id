<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departement extends Model
{
    use HasFactory;

    protected $fillable = [
        'faculty_id',
        'code',
        'name',
        'description',
        'image',
        'status',
    ];

    public function faculty()
    {
        return $this->belongsTo(Faculty::class);
    }

    public function registrationPaths()
    {
        return $this->belongsToMany(RegistrationPath::class, 'registration_departements')
                    ->withPivot('id') // Mengambil ID dari tabel pivot
                    ->withTimestamps();
    }

    public function programOptions()
    {
        return $this->hasMany(ProgramOption::class);
    }

}
