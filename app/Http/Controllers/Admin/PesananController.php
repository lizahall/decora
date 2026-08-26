<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pesanan;
use Illuminate\Http\Request;

class PesananController extends Controller
{
    // Menampilkan semua pesanan dari seluruh user (skenario "Kelola Data Pesanan")
    public function index(Request $request)
    {
        $query = Pesanan::with('user');

        if ($request->filled('status')) {
            $query->where('status_pesanan', $request->status);
        }

        $pesanan = $query->latest()->paginate(10);

        return view('admin.pesanan.index', compact('pesanan'));
    }

    // Detail satu pesanan beserta rincian barangnya
    public function show(Pesanan $pesanan)
    {
        $pesanan->load('detailPesanan.produk', 'user');

        return view('admin.pesanan.show', compact('pesanan'));
    }

    // Ubah status pesanan (menunggu -> diproses -> dikemas -> dikirim -> selesai / dibatalkan)
    public function updateStatus(Request $request, Pesanan $pesanan)
    {
        $validated = $request->validate([
            'status_pesanan' => 'required|in:menunggu,diproses,dikemas,dikirim,selesai,dibatalkan',
        ]);

        $pesanan->update($validated);

        return back()->with('success', 'Status pesanan berhasil diperbarui.');
    }
}