<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PesananController extends Controller
{
    public function index(Request $request)
    {
        $query = Pesanan::where('user_id', Auth::id());

        if ($request->filled('status')) {
            $query->where('status_pesanan', $request->status);
        }

        $pesanan = $query->latest()->paginate(10)->withQueryString();

        return view('pesanan.index', compact('pesanan'));
    }

    public function show(Pesanan $pesanan)
    {
        if ($pesanan->user_id !== Auth::id()) {
            abort(403);
        }

        $pesanan->load('detailPesanan.produk');

        return view('pesanan.show', compact('pesanan'));
    }

    // Upload bukti pembayaran (Transfer Bank / E-Wallet)
    public function uploadBukti(Request $request, Pesanan $pesanan)
    {
        if ($pesanan->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'bukti_pembayaran' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($pesanan->bukti_pembayaran) {
            Storage::disk('public')->delete($pesanan->bukti_pembayaran);
        }

        $path = $request->file('bukti_pembayaran')->store('bukti-pembayaran', 'public');
        $pesanan->update(['bukti_pembayaran' => $path]);

        return back()->with('success', 'Bukti pembayaran berhasil diunggah. Menunggu verifikasi admin.');
    }
}