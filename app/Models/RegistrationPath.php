<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class RegistrationPath extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'code',
        'code_year',
        'name',
        'title',
        'description',
        'image',
        'start_date',
        'end_date',
        'amount',
        'link_grup',
        'status',
    ];

    // --- Konfigurasi Spatie Activity Log ---
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }

    public function departements()
    {
        return $this->belongsToMany(Departement::class, 'registration_departements')
                    ->withPivot('id') // Mengambil ID dari tabel pivot
                    ->withTimestamps();
    }

    public function programOptions()
    {
        return $this->hasMany(ProgramOption::class);
    }
}