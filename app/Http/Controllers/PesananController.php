<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use Illuminate\Support\Facades\Auth;

class PesananController extends Controller
{
    // Riwayat semua pesanan milik user yang login (skenario "Melihat Riwayat Pesanan")
    public function index()
    {
        $pesanan = Pesanan::where('user_id', Auth::id())
            ->latest()
            ->paginate(10);

        return view('pesanan.index', compact('pesanan'));
    }

    // Detail satu pesanan (juga berfungsi sebagai halaman invoice setelah checkout)
    public function show(Pesanan $pesanan)
    {
        if ($pesanan->user_id !== Auth::id()) {
            abort(403);
        }

        $pesanan->load('detailPesanan.produk');

        return view('pesanan.show', compact('pesanan'));
    }
}