<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PesananController extends Controller
{
    // Riwayat semua pesanan milik user yang login (skenario "Melihat Riwayat Pesanan")
    public function index(Request $request)
    {
        $query = Pesanan::where('user_id', Auth::id());

        if ($request->filled('status')) {
            $query->where('status_pesanan', $request->status);
        }

        $pesanan = $query->latest()->paginate(10)->withQueryString();

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