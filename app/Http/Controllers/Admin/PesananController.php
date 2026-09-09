<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pesanan;
use Illuminate\Http\Request;

class PesananController extends Controller
{
    public function index(Request $request)
    {
        $query = Pesanan::with('user');

        if ($request->filled('status')) {
            $query->where('status_pesanan', $request->status);
        }

        $pesanan = $query->latest()->paginate(10);

        return view('admin.pesanan.index', compact('pesanan'));
    }

    // Detail read-only, TIDAK bisa ubah apapun
    public function show(Pesanan $pesanan)
    {
        $pesanan->load('detailPesanan.produk', 'user');

        return view('admin.pesanan.show', compact('pesanan'));
    }

    // Halaman khusus buat ubah status
    public function edit(Pesanan $pesanan)
    {
        $pesanan->load('detailPesanan.produk', 'user');

        return view('admin.pesanan.edit', compact('pesanan'));
    }

    public function updateStatus(Request $request, Pesanan $pesanan)
    {
        $validated = $request->validate([
            'status_pesanan' => 'required|in:menunggu,diproses,dikemas,dikirim,selesai,dibatalkan',
        ]);

        $pesanan->update($validated);

        return redirect()->route('admin.pesanan.show', $pesanan->id)
            ->with('success', 'Status pesanan berhasil diperbarui.');
    }
}