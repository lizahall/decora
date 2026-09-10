<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DetailPesanan;
use App\Models\Pesanan;
use Illuminate\Http\Request;
use Carbon\Carbon;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $mulai = $request->input('mulai', now()->startOfMonth()->format('Y-m-d'));
        $selesai = $request->input('selesai', now()->format('Y-m-d'));

        $query = Pesanan::whereDate('created_at', '>=', $mulai)
            ->whereDate('created_at', '<=', $selesai)
            ->where('status_pesanan', 'selesai');

        $totalPendapatan = (clone $query)->sum('total_harga');
        $jumlahPesanan = (clone $query)->count();
        $rataRata = $jumlahPesanan > 0 ? $totalPendapatan / $jumlahPesanan : 0;

        $produkTerjual = DetailPesanan::whereHas('pesanan', function ($q) use ($mulai, $selesai) {
            $q->whereDate('created_at', '>=', $mulai)
              ->whereDate('created_at', '<=', $selesai)
              ->where('status_pesanan', 'selesai');
        })->sum('jumlah');

        $transaksi = (clone $query)->with('user')->latest()->get();

        // Data grafik: pendapatan harian dalam rentang (dibatasi maksimal 60 hari)
        $labelGrafik = [];
        $dataGrafik = [];
        $tanggalMulai = Carbon::parse($mulai);
        $tanggalSelesai = Carbon::parse($selesai);

        if ($tanggalMulai->diffInDays($tanggalSelesai) <= 60) {
            for ($tanggal = $tanggalMulai->copy(); $tanggal->lte($tanggalSelesai); $tanggal->addDay()) {
                $totalHari = Pesanan::whereDate('created_at', $tanggal)
                    ->where('status_pesanan', 'selesai')
                    ->sum('total_harga');

                $labelGrafik[] = $tanggal->translatedFormat('d M');
                $dataGrafik[] = (float) $totalHari;
            }
        }

        return view('admin.laporan.index', compact(
            'mulai', 'selesai', 'totalPendapatan', 'jumlahPesanan', 'rataRata',
            'produkTerjual', 'transaksi', 'labelGrafik', 'dataGrafik'
        ));
    }
}