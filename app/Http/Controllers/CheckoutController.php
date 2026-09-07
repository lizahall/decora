<?php

namespace App\Http\Controllers;

use App\Models\DetailPesanan;
use App\Models\Keranjang;
use App\Models\Pesanan;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    // Menampilkan form checkout. Mode ditentukan dari query string:
    // - ?produk_id=X&jumlah=Y     -> checkout langsung dari detail produk
    // - ?keranjang_ids[]=1&...    -> checkout item terpilih dari keranjang
    public function create(Request $request)
    {
        if ($request->filled('produk_id')) {
            $produk = Produk::findOrFail($request->produk_id);
            $jumlah = max(1, (int) $request->input('jumlah', 1));

            if ($produk->stok < $jumlah) {
                return redirect()->route('produk.show', $produk->id)
                    ->with('error', 'Stok tidak cukup untuk melakukan checkout.');
            }

            $items = collect([
                (object) [
                    'produk' => $produk,
                    'jumlah' => $jumlah,
                    'subtotal' => $produk->harga * $jumlah,
                ],
            ]);

            $total = $items->sum('subtotal');
            $mode = 'langsung';
            $keranjangIds = [];
        } else {
            $keranjangIds = $request->input('keranjang_ids', []);

            if (empty($keranjangIds)) {
                return redirect()->route('keranjang.index')
                    ->with('error', 'Pilih produk yang ingin di-checkout terlebih dahulu.');
            }

            $keranjang = Keranjang::with('produk')
                ->where('user_id', Auth::id())
                ->whereIn('id', $keranjangIds)
                ->get();

            if ($keranjang->isEmpty()) {
                return redirect()->route('keranjang.index')
                    ->with('error', 'Produk yang dipilih tidak ditemukan di keranjang.');
            }

            $items = $keranjang->map(fn ($k) => (object) [
                'produk' => $k->produk,
                'jumlah' => $k->jumlah,
                'subtotal' => $k->produk->harga * $k->jumlah,
            ]);

            $total = $items->sum('subtotal');
            $mode = 'keranjang';
        }

        return view('checkout.create', compact('items', 'total', 'mode', 'keranjangIds'));
    }

    // Proses submit pesanan
    public function store(Request $request)
    {
        $validated = $request->validate([
            'alamat_pengiriman' => 'required|string',
            'no_telepon' => 'required|string|max:20',
            'metode_pembayaran' => 'required|string',
            'mode' => 'required|in:keranjang,langsung',
            'produk_id' => 'nullable|exists:produk,id',
            'jumlah' => 'nullable|integer|min:1',
            'keranjang_ids' => 'nullable|array',
        ]);

        try {
            $pesanan = DB::transaction(function () use ($validated, $request) {

                if ($validated['mode'] === 'langsung') {
                    $produk = Produk::findOrFail($validated['produk_id']);
                    $jumlah = $validated['jumlah'];

                    if ($produk->stok < $jumlah) {
                        throw new \Exception('Stok tidak cukup untuk produk ' . $produk->nama);
                    }

                    $items = collect([['produk' => $produk, 'jumlah' => $jumlah]]);
                } else {
                    $keranjangIds = $request->input('keranjang_ids', []);

                    $keranjang = Keranjang::with('produk')
                        ->where('user_id', Auth::id())
                        ->whereIn('id', $keranjangIds)
                        ->get();

                    if ($keranjang->isEmpty()) {
                        throw new \Exception('Produk yang dipilih tidak ditemukan di keranjang.');
                    }

                    foreach ($keranjang as $k) {
                        if ($k->produk->stok < $k->jumlah) {
                            throw new \Exception('Stok tidak cukup untuk produk ' . $k->produk->nama);
                        }
                    }

                    $items = $keranjang->map(fn ($k) => ['produk' => $k->produk, 'jumlah' => $k->jumlah]);
                }

                $total = $items->sum(fn ($i) => $i['produk']->harga * $i['jumlah']);

                $pesanan = Pesanan::create([
                    'user_id' => Auth::id(),
                    'alamat_pengiriman' => $validated['alamat_pengiriman'],
                    'no_telepon' => $validated['no_telepon'],
                    'metode_pembayaran' => $validated['metode_pembayaran'],
                    'total_harga' => $total,
                    'status_pesanan' => 'menunggu',
                ]);

                foreach ($items as $i) {
                    DetailPesanan::create([
                        'pesanan_id' => $pesanan->id,
                        'produk_id' => $i['produk']->id,
                        'jumlah' => $i['jumlah'],
                        'harga_satuan' => $i['produk']->harga,
                        'subtotal' => $i['produk']->harga * $i['jumlah'],
                    ]);

                    $i['produk']->decrement('stok', $i['jumlah']);
                }

                if ($validated['mode'] === 'keranjang') {
                    // Hapus HANYA item yang dipilih & di-checkout, bukan semua isi keranjang
                    Keranjang::where('user_id', Auth::id())
                        ->whereIn('id', $request->input('keranjang_ids', []))
                        ->delete();
                }

                return $pesanan;
            });

            return redirect()->route('pesanan.show', $pesanan->id)
                ->with('success', 'Pesanan berhasil dibuat.');

        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage())->withInput();
        }
    }
}