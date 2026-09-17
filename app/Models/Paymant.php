<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Paymant extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'user_id',
        'program_option_id',
        'merchant_order_id',
        'payment_method',
        'amount',
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

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke ProgramOption
    public function programOption()
    {
        return $this->belongsTo(ProgramOption::class);
    }
    
    // Relasi ke PaymantMethod
    public function paymantMethod()
    {
        return $this->belongsTo(PaymantMethod::class, 'paymant_method_id');
    }
}