<x-admin-layout title="Data Pesanan">

    <h1 class="text-xl font-bold mb-4">Data Pesanan</h1>

    <form method="GET" class="mb-4 flex gap-2">
        <select name="status" onchange="this.form.submit()" class="border border-gray-400 rounded-sm px-3 py-2 text-sm">
            <option value="">-- Semua Status --</option>
            @foreach (['menunggu', 'diproses', 'dikemas', 'dikirim', 'selesai', 'dibatalkan'] as $status)
                <option value="{{ $status }}" {{ request('status') === $status ? 'selected' : '' }}>{{ ucfirst($status) }}</option>
            @endforeach
        </select>
    </form>

    <table class="w-full border border-gray-400 bg-white text-sm">
        <thead>
            <tr class="border-b border-gray-400 bg-gray-50">
                <th class="border-r border-gray-300 px-3 py-2 text-left">ID</th>
                <th class="border-r border-gray-300 px-3 py-2 text-left">User</th>
                <th class="border-r border-gray-300 px-3 py-2 text-left">Tanggal</th>
                <th class="border-r border-gray-300 px-3 py-2 text-left">Total</th>
                <th class="border-r border-gray-300 px-3 py-2 text-left">Status</th>
                <th class="px-3 py-2 text-left">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($pesanan as $item)
                <tr class="border-b border-gray-300">
                    <td class="border-r border-gray-300 px-3 py-2">#{{ $item->id }}</td>
                    <td class="border-r border-gray-300 px-3 py-2">{{ $item->user->nama }}</td>
                    <td class="border-r border-gray-300 px-3 py-2">{{ $item->created_at->format('d/m/Y H:i') }}</td>
                    <td class="border-r border-gray-300 px-3 py-2">Rp {{ number_format($item->total_harga, 0, ',', '.') }}</td>
                    <td class="border-r border-gray-300 px-3 py-2 uppercase text-xs font-semibold">{{ $item->status_pesanan }}</td>
                    <td class="px-3 py-2">
                        <a href="{{ route('admin.pesanan.show', $item->id) }}" class="text-blue-600">Detail</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="px-3 py-6 text-center text-gray-500">Belum ada pesanan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-4">{{ $pesanan->links() }}</div>

</x-admin-layout>