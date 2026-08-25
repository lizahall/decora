<?php

namespace App\Http\Controllers;

use App\Models\Keranjang;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KeranjangController extends Controller
{
    // Menampilkan isi keranjang (skenario "Kelola Keranjang")
    public function index()
    {
        $items = Keranjang::with('produk')
            ->where('user_id', Auth::id())
            ->get();

        $total = $items->sum(fn ($item) => $item->produk->harga * $item->jumlah);

        return view('keranjang.index', compact('items', 'total'));
    }

    // Tambah ke keranjang (skenario "Tambah ke Keranjang")
    public function store(Request $request)
    {
        $validated = $request->validate([
            'produk_id' => 'required|exists:produk,id',
            'jumlah' => 'required|integer|min:1',
        ]);

        $produk = Produk::findOrFail($validated['produk_id']);

        // SEKENARIO GAGAL: stok tidak cukup
        if ($produk->stok < $validated['jumlah']) {
            return back()->with('error', 'Stok tidak cukup. Sisa stok: ' . $produk->stok);
        }

        $existing = Keranjang::where('user_id', Auth::id())
            ->where('produk_id', $produk->id)
            ->first();

        if ($existing) {
            $jumlahBaru = $existing->jumlah + $validated['jumlah'];

            if ($produk->stok < $jumlahBaru) {
                return back()->with('error', 'Stok tidak cukup untuk menambah jumlah ini. Sisa stok: ' . $produk->stok);
            }

            $existing->update(['jumlah' => $jumlahBaru]);
        } else {
            Keranjang::create([
                'user_id' => Auth::id(),
                'produk_id' => $produk->id,
                'jumlah' => $validated['jumlah'],
            ]);
        }

        // SEKENARIO BERHASIL
        return redirect()->route('keranjang.index')->with('success', 'Produk berhasil ditambahkan ke keranjang.');
    }

    // Ubah jumlah kuantitas (skenario "Kelola Keranjang")
    public function update(Request $request, Keranjang $keranjang)
    {
        if ($keranjang->user_id !== Auth::id()) {
            abort(403);
        }

        $validated = $request->validate([
            'jumlah' => 'required|integer|min:1',
        ]);

        // SEKENARIO GAGAL: kuantitas tidak valid / melebihi stok
        if ($keranjang->produk->stok < $validated['jumlah']) {
            return back()->with('error', 'Kuantitas tidak valid. Sisa stok: ' . $keranjang->produk->stok);
        }

        $keranjang->update(['jumlah' => $validated['jumlah']]);

        return back()->with('success', 'Keranjang berhasil diperbarui.');
    }

    // Hapus item dari keranjang
    public function destroy(Keranjang $keranjang)
    {
        if ($keranjang->user_id !== Auth::id()) {
            abort(403);
        }

        $keranjang->delete();

        return back()->with('success', 'Produk dihapus dari keranjang.');
    }
}