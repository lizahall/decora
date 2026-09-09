<x-admin-layout title="Data Pesanan">

    <h1 class="text-xl font-bold text-decora-text mb-5">Data Pesanan</h1>

    <form method="GET" class="mb-4">
        <select name="status" onchange="this.form.submit()" class="border-decora-cream-dark rounded-lg text-sm focus:border-decora-sage focus:ring-decora-sage">
            <option value="">-- Semua Status --</option>
            @foreach (['menunggu', 'diproses', 'dikemas', 'dikirim', 'selesai', 'dibatalkan'] as $status)
                <option value="{{ $status }}" {{ request('status') === $status ? 'selected' : '' }}>{{ ucfirst($status) }}</option>
            @endforeach
        </select>
    </form>

    <div class="bg-white rounded-xl border border-decora-cream-dark overflow-hidden">
        <table class="w-full text-sm">
            <thead>
                <tr class="bg-decora-cream text-decora-text/70 text-left">
                    <th class="px-4 py-3 font-medium">ID</th>
                    <th class="px-4 py-3 font-medium">User</th>
                    <th class="px-4 py-3 font-medium">Tanggal</th>
                    <th class="px-4 py-3 font-medium">Total</th>
                    <th class="px-4 py-3 font-medium">Status</th>
                    <th class="px-4 py-3 font-medium">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-decora-cream-dark">
                @forelse ($pesanan as $item)
                    <tr class="hover:bg-decora-cream/40">
                        <td class="px-4 py-3 font-medium text-decora-text">#{{ $item->id }}</td>
                        <td class="px-4 py-3 text-decora-text/70">{{ $item->user->nama }}</td>
                        <td class="px-4 py-3 text-decora-text/70">{{ $item->created_at->format('d/m/Y H:i') }}</td>
                        <td class="px-4 py-3 text-decora-text/70">Rp {{ number_format($item->total_harga, 0, ',', '.') }}</td>
                        <td class="px-4 py-3"><x-status-badge :status="$item->status_pesanan" /></td>
                        <td class="px-4 py-3 space-x-3 whitespace-nowrap">
                            <a href="{{ route('admin.pesanan.show', $item->id) }}" class="text-decora-brown font-medium hover:underline">Detail</a>
                            <a href="{{ route('admin.pesanan.edit', $item->id) }}" class="text-blue-600 font-medium hover:underline">Edit</a>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="px-4 py-10 text-center text-decora-text/50">Belum ada pesanan.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">{{ $pesanan->links() }}</div>

</x-admin-layout>