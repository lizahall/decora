<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    protected $table = 'pesanan';
    protected $fillable = 
    [
        'user_id', 
        'alamat_pengiriman', 
        'no_telepon', 
        'metode_pembayaran', 
        'total_harga', 
        'status_pesanan'
    ];

    public function user() { return $this->belongsTo(User::class); }
    public function detailPesanan() { return $this->hasMany(DetailPesanan::class); }
}
