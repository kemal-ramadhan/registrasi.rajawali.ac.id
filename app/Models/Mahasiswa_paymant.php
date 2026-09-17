<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Mahasiswa_paymant extends Model
{
    use LogsActivity;

    protected $fillable = [
        'user_id',
        'mahasiswa_id',
        'biaya_id',
        'scema_cicilan_id',
        'detail_scema_cicilan_id',
        'transaction_id',
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

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class);
    }

    public function biaya()
    {
        return $this->belongsTo(Biaya::class);
    }

    public function scemaCicilan()
    {
        return $this->belongsTo(Scema_cicilan::class);
    }

    public function detailScemaCicilan()
    {
        return $this->belongsTo(Detail_scema_cicilan::class);
    }
}