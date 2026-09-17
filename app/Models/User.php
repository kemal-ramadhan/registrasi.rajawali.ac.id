<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable, LogsActivity;

    protected $fillable = [
        'name', 'email', 'phone', 'role', 'profile', 
        'email_verified_at', 'password', 'email_otp', 
        'email_otp_expires_at', 'email_otp_attempts'
    ];

    protected $casts = [
        'email_otp_expires_at' => 'datetime',
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    // --- Konfigurasi Spatie Activity Log ---
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll() // Melacak semua field di $fillable
            ->logOnlyDirty() // Hanya melacak jika ada perubahan data
            ->dontSubmitEmptyLogs(); // Jangan simpan log jika tidak ada perubahan
    }

    // Relasi
    public function personal() { return $this->hasOne(PersonalData::class); }
    public function education() { return $this->hasOne(Education::class); }
    public function address() { return $this->hasOne(Address::class); }
    public function income() { return $this->hasOne(Income::class); }
    public function family() { return $this->hasMany(Family::class); }
    public function examParticipant() { return $this->hasOne(Exam_participants::class, 'user_id'); }
}