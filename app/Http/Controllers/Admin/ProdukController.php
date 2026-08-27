<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    // Katalog produk
    public function index(Request $request)
    {
        $query = Produk::query();

        if ($request->filled('kategori')) {
            $query->where('kategori', $request->kategori);
        }

        if ($request->filled('cari')) {
            $query->where('nama', 'like', '%' . $request->cari . '%');
        }

        $produk = $query->latest()->paginate(12)->withQueryString();
        $kategori = Produk::select('kategori')->distinct()->pluck('kategori');

        return view('produk.index', compact('produk', 'kategori'));
    }

    // Detail produk (skenario "Melihat Detail Produk")
    public function show($id)
    {
        $produk = Produk::find($id);

        if (!$produk) {
            return redirect()->route('produk.index')
                ->with('error', 'Produk tidak ditemukan.');
        }

        return view('produk.show', compact('produk'));
    }
}