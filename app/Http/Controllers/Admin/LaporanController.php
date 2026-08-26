<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pesanan;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    // Laporan penjualan periode tertentu (skenario "Laporan Penjualan")
    public function index(Request $request)
    {
        $mulai = $request->input('mulai', now()->startOfMonth()->format('Y-m-d'));
        $selesai = $request->input('selesai', now()->format('Y-m-d'));

        $query = Pesanan::whereDate('created_at', '>=', $mulai)
            ->whereDate('created_at', '<=', $selesai)
            ->where('status_pesanan', 'selesai');

        $totalPendapatan = (clone $query)->sum('total_harga');
        $jumlahPesanan = (clone $query)->count();
        $transaksi = (clone $query)->with('user')->latest()->get();

        return view('admin.laporan.index', compact('mulai', 'selesai', 'totalPendapatan', 'jumlahPesanan', 'transaksi'));
    }
}