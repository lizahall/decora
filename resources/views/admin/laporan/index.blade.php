<x-admin-layout title="Laporan Penjualan">

    <h1 class="text-xl font-bold mb-4">Laporan Penjualan</h1>

    <form method="GET" class="flex items-end gap-3 mb-6">
        <div>
            <label class="block text-xs text-gray-500 mb-1">Dari Tanggal</label>
            <input type="date" name="mulai" value="{{ $mulai }}" class="border border-gray-400 rounded-sm px-3 py-2 text-sm">
        </div>
        <div>
            <label class="block text-xs text-gray-500 mb-1">Sampai Tanggal</label>
            <input type="date" name="selesai" value="{{ $selesai }}" class="border border-gray-400 rounded-sm px-3 py-2 text-sm">
        </div>
        <button type="submit" class="px-4 py-2 border border-gray-400 rounded-sm text-sm bg-gray-50">Terapkan</button>
    </form>

    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-6">
        <div class="bg-white border border-gray-300 rounded p-4">
            <p class="text-sm text-gray-500">Total Pendapatan (status selesai)</p>
            <p class="text-2xl font-bold">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</p>
        </div>
        <div class="bg-white border border-gray-300 rounded p-4">
            <p class="text-sm text-gray-500">Jumlah Transaksi Selesai</p>
            <p class="text-2xl font-bold">{{ $jumlahPesanan }}</p>
        </div>
    </div>

    <table class="w-full border border-gray-400 bg-white text-sm">
        <thead>
            <tr class="border-b border-gray-400 bg-gray-50">
                <th class="border-r border-gray-300 px-3 py-2 text-left">ID</th>
                <th class="border-r border-gray-300 px-3 py-2 text-left">User</th>
                <th class="border-r border-gray-300 px-3 py-2 text-left">Tanggal</th>
                <th class="px-3 py-2 text-left">Total</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($transaksi as $item)
                <tr class="border-b border-gray-300">
                    <td class="border-r border-gray-300 px-3 py-2">#{{ $item->id }}</td>
                    <td class="border-r border-gray-300 px-3 py-2">{{ $item->user->nama }}</td>
                    <td class="border-r border-gray-300 px-3 py-2">{{ $item->created_at->format('d/m/Y H:i') }}</td>
                    <td class="px-3 py-2">Rp {{ number_format($item->total_harga, 0, ',', '.') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="px-3 py-6 text-center text-gray-500">Tidak ada transaksi selesai pada periode ini.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

</x-admin-layout>