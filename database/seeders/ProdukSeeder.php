<?php

namespace Database\Seeders;

use App\Models\Produk;
use Illuminate\Database\Seeder;

class ProdukSeeder extends Seeder
{
    public function run(): void
    {
        $produk = [
            [
                'nama' => 'Meja Kayu Jati Minimalis',
                'harga' => 1500000,
                'stok' => 12,
                'kategori' => 'Meja',
                'deskripsi' => 'Meja kayu jati solid dengan desain minimalis, cocok untuk ruang tamu atau ruang makan.',
            ],
            [
                'nama' => 'Meja Kerja Lipat',
                'harga' => 850000,
                'stok' => 20,
                'kategori' => 'Meja',
                'deskripsi' => 'Meja kerja praktis dengan sistem lipat, hemat ruang untuk apartemen kecil.',
            ],
            [
                'nama' => 'Kursi Rotan Anyaman',
                'harga' => 650000,
                'stok' => 15,
                'kategori' => 'Kursi',
                'deskripsi' => 'Kursi rotan dengan anyaman tangan, memberikan nuansa alami pada ruangan.',
            ],
            [
                'nama' => 'Kursi Makan Kayu',
                'harga' => 450000,
                'stok' => 25,
                'kategori' => 'Kursi',
                'deskripsi' => 'Kursi makan kayu solid dengan sandaran ergonomis.',
            ],
            [
                'nama' => 'Lampu Gantung Minimalis',
                'harga' => 320000,
                'stok' => 18,
                'kategori' => 'Pencahayaan',
                'deskripsi' => 'Lampu gantung dengan desain minimalis modern, cocok untuk ruang tamu, ruang makan, atau kamar tidur.',
            ],
            [
                'nama' => 'Lampu Meja Baca',
                'harga' => 175000,
                'stok' => 30,
                'kategori' => 'Pencahayaan',
                'deskripsi' => 'Lampu meja dengan pencahayaan hangat, ideal untuk area belajar atau kerja.',
            ],
            [
                'nama' => 'Rak Dinding Kayu',
                'harga' => 275000,
                'stok' => 22,
                'kategori' => 'Rak',
                'deskripsi' => 'Rak dinding kayu minimalis untuk menyimpan buku atau pajangan dekorasi.',
            ],
            [
                'nama' => 'Rak Sepatu Susun',
                'harga' => 390000,
                'stok' => 16,
                'kategori' => 'Rak',
                'deskripsi' => 'Rak sepatu bertingkat dengan kapasitas besar, hemat ruang untuk area pintu masuk.',
            ],
            [
                'nama' => 'Vas Keramik Bermotif',
                'harga' => 120000,
                'stok' => 40,
                'kategori' => 'Dekorasi',
                'deskripsi' => 'Vas keramik dengan motif etnik, mempercantik sudut ruangan.',
            ],
            [
                'nama' => 'Cermin Bulat Dekoratif',
                'harga' => 280000,
                'stok' => 14,
                'kategori' => 'Dekorasi',
                'deskripsi' => 'Cermin berbentuk bulat dengan bingkai kayu, menambah kesan luas pada ruangan.',
            ],
        ];

        foreach ($produk as $item) {
            Produk::create($item);
        }
    }
}