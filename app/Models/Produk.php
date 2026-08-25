<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $table = 'produk';

    protected $fillable = [
        'foto',
        'nama',
        'harga',
        'stok',
        'kategori',
        'deskripsi',
    ];

    public function detailPesanan()
    {
        return $this->hasMany(DetailPesanan::class);
    }

    public function keranjang()
    {
        return $this->hasMany(Keranjang::class);
    }
}
