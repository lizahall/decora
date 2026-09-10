<x-admin-layout title="Laporan Penjualan">

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <h1 class="text-xl font-bold text-decora-text mb-5">Laporan Penjualan</h1>

    <form method="GET" class="flex flex-wrap items-end gap-3 mb-6">
        <div>
            <x-input-label value="Dari Tanggal" />
            <input type="date" name="mulai" value="{{ $mulai }}" class="border-decora-cream-dark rounded-lg text-sm focus:border-decora-sage focus:ring-decora-sage">
        </div>
        <div>
            <x-input-label value="Sampai Tanggal" />
            <input type="date" name="selesai" value="{{ $selesai }}" class="border-decora-cream-dark rounded-lg text-sm focus:border-decora-sage focus:ring-decora-sage">
        </div>
        <x-button type="submit" variant="outline" class="!py-2">Terapkan</x-button>
    </form>

    {{-- 4 kartu ringkasan --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
        <div class="bg-white border border-decora-cream-dark rounded-xl p-5">
            <div class="w-10 h-10 rounded-full bg-decora-sage/30 flex items-center justify-center text-lg mb-3">💰</div>
            <p class="text-sm text-decora-text/50 mb-1">Total Pendapatan</p>
            <p class="text-xl font-bold text-decora-brown">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</p>
        </div>
        <div class="bg-white border border-decora-cream-dark rounded-xl p-5">
            <div class="w-10 h-10 rounded-full bg-decora-sage/30 flex items-center justify-center text-lg mb-3">🧾</div>
            <p class="text-sm text-decora-text/50 mb-1">Jumlah Transaksi</p>
            <p class="text-xl font-bold text-decora-text">{{ $jumlahPesanan }}</p>
        </div>
        <div class="bg-white border border-decora-cream-dark rounded-xl p-5">
            <div class="w-10 h-10 rounded-full bg-decora-sage/30 flex items-center justify-center text-lg mb-3">📊</div>
            <p class="text-sm text-decora-text/50 mb-1">Rata-rata per Transaksi</p>
            <p class="text-xl font-bold text-decora-text">Rp {{ number_format($rataRata, 0, ',', '.') }}</p>
        </div>
        <div class="bg-white border border-decora-cream-dark rounded-xl p-5">
            <div class="w-10 h-10 rounded-full bg-decora-sage/30 flex items-center justify-center text-lg mb-3">📦</div>
            <p class="text-sm text-decora-text/50 mb-1">Produk Terjual</p>
            <p class="text-xl font-bold text-decora-text">{{ $produkTerjual }}</p>
        </div>
    </div>

    {{-- Grafik --}}
    <div class="bg-white border border-decora-cream-dark rounded-xl p-5 mb-6">
        <p class="font-semibold text-decora-text mb-4">Tren Pendapatan Harian</p>
        @if (count($labelGrafik) > 0)
            <canvas id="chartLaporan" height="90"></canvas>
        @else
            <p class="text-sm text-decora-text/50 text-center py-10">Rentang tanggal terlalu panjang untuk ditampilkan sebagai grafik (maks. 60 hari).</p>
        @endif
    </div>

    {{-- Tabel Transaksi --}}
    <div class="bg-white rounded-xl border border-decora-cream-dark overflow-hidden">
        <table class="w-full text-sm">
            <thead>
                <tr class="bg-decora-cream text-decora-text/70 text-left">
                    <th class="px-4 py-3 font-medium">ID</th>
                    <th class="px-4 py-3 font-medium">User</th>
                    <th class="px-4 py-3 font-medium">Tanggal</th>
                    <th class="px-4 py-3 font-medium">Total</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-decora-cream-dark">
                @forelse ($transaksi as $item)
                    <tr class="hover:bg-decora-cream/40">
                        <td class="px-4 py-3 font-medium text-decora-text">#{{ $item->id }}</td>
                        <td class="px-4 py-3 text-decora-text/70">{{ $item->user->nama }}</td>
                        <td class="px-4 py-3 text-decora-text/70">{{ $item->created_at->format('d/m/Y H:i') }}</td>
                        <td class="px-4 py-3 font-medium text-decora-text">Rp {{ number_format($item->total_harga, 0, ',', '.') }}</td>
                    </tr>
                @empty
                    <tr><td colspan="4" class="px-4 py-10 text-center text-decora-text/50">Tidak ada transaksi selesai pada periode ini.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if (count($labelGrafik) > 0)
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                new Chart(document.getElementById('chartLaporan'), {
                    type: 'bar',
                    data: {
                        labels: @json($labelGrafik),
                        datasets: [{
                            label: 'Pendapatan (Rp)',
                            data: @json($dataGrafik),
                            backgroundColor: '#B4C7AE',
                            borderRadius: 4,
                        }]
                    },
                    options: {
                        plugins: { legend: { display: false } },
                        scales: { y: { beginAtZero: true } }
                    }
                });
            });
        </script>
    @endif

</x-admin-layout>