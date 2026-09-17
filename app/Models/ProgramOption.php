<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class ProgramOption extends Model
{
    use SoftDeletes;
    use LogsActivity;

    public $timestamps = true; 
    
    protected $fillable = [
        'registration_path_id',
        'departement_id',
        'user_id',
        'program_option',
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

    public function user() { return $this->belongsTo(User::class); }
    public function registrationPath() { return $this->belongsTo(RegistrationPath::class); }
    public function departement() { return $this->belongsTo(Departement::class); }
    public function mahasiswa() { return $this->hasOne(Mahasiswa::class, 'user_id', 'user_id'); }
}