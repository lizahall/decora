<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pesanan;
use App\Models\Produk;
use App\Models\User;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProduk = Produk::count();
        $totalUser = User::count();
        $totalPesanan = Pesanan::count();

        // Data grafik: total penjualan 7 hari terakhir (status selesai)
        $labelPenjualan = [];
        $dataPenjualan = [];

        for ($i = 6; $i >= 0; $i--) {
            $tanggal = Carbon::today()->subDays($i);

            $total = Pesanan::whereDate('created_at', $tanggal)
                ->where('status_pesanan', 'selesai')
                ->sum('total_harga');

            $labelPenjualan[] = $tanggal->translatedFormat('d M');
            $dataPenjualan[] = (float) $total;
        }

        // Data grafik: jumlah produk per kategori
        $produkPerKategori = Produk::selectRaw('kategori, count(*) as jumlah')
            ->groupBy('kategori')
            ->pluck('jumlah', 'kategori');

        return view('admin.dashboard', [
            'totalProduk' => $totalProduk,
            'totalUser' => $totalUser,
            'totalPesanan' => $totalPesanan,
            'labelPenjualan' => $labelPenjualan,
            'dataPenjualan' => $dataPenjualan,
            'labelKategori' => $produkPerKategori->keys(),
            'dataKategori' => $produkPerKategori->values(),
        ]);
    }
}