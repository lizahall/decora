<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use Illuminate\Support\Facades\Auth;

class PesananController extends Controller
{
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