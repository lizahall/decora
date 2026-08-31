<x-admin-layout title="Laporan Penjualan">

    <h1 class="text-xl font-bold text-decora-text mb-5">Laporan Penjualan</h1>

    <form method="GET" class="flex items-end gap-3 mb-6">
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

    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-6">
        <div class="bg-white border border-decora-cream-dark rounded-xl p-5">
            <p class="text-sm text-decora-text/50 mb-1">Total Pendapatan (status selesai)</p>
            <p class="text-2xl font-bold text-decora-brown">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</p>
        </div>
        <div class="bg-white border border-decora-cream-dark rounded-xl p-5">
            <p class="text-sm text-decora-text/50 mb-1">Jumlah Transaksi Selesai</p>
            <p class="text-2xl font-bold text-decora-text">{{ $jumlahPesanan }}</p>
        </div>
    </div>

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
                        <td class="px-4 py-3 text-decora-text/70">Rp {{ number_format($item->total_harga, 0, ',', '.') }}</td>
                    </tr>
                @empty
                    <tr><td colspan="4" class="px-4 py-10 text-center text-decora-text/50">Tidak ada transaksi selesai pada periode ini.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

</x-admin-layout>