<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymantMethod extends Model
{
    protected $fillable = [
        'paymant_method_kategori_id',
        'methode',
        'methode_initial',
        'image',
        'biaya_admin',
        'status'
    ];

    public function paymantKategori()
    {
        return $this->belongsTo(PaymantMethodKategori::class, 'paymant_method_kategori_id');
    }

}
