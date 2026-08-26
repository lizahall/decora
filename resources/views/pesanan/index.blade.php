<x-shop-layout title="Riwayat Pesanan">
    <div class="max-w-3xl mx-auto py-8 px-4">
        <h1 class="text-2xl font-bold mb-6">Riwayat Pesanan</h1>

        @forelse ($pesanan as $item)
            <a href="{{ route('pesanan.show', $item->id) }}" class="block border border-gray-300 rounded p-4 mb-3 hover:shadow-md transition">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="font-semibold">Pesanan #{{ $item->id }}</p>
                        <p class="text-sm text-gray-500">{{ $item->created_at->translatedFormat('d F Y, H:i') }}</p>
                    </div>
                    <div class="text-right">
                        <p class="font-semibold">Rp {{ number_format($item->total_harga, 0, ',', '.') }}</p>
                        <span class="text-xs px-2 py-1 rounded uppercase font-semibold
                            @class([
                                'bg-yellow-100 text-yellow-700' => $item->status_pesanan === 'menunggu',
                                'bg-blue-100 text-blue-700' => in_array($item->status_pesanan, ['diproses', 'dikemas', 'dikirim']),
                                'bg-green-100 text-green-700' => $item->status_pesanan === 'selesai',
                                'bg-red-100 text-red-700' => $item->status_pesanan === 'dibatalkan',
                            ])">
                            {{ $item->status_pesanan }}
                        </span>
                    </div>
                </div>
            </a>
        @empty
            <p class="text-gray-500">Belum ada pesanan.</p>
        @endforelse

        <div class="mt-4">{{ $pesanan->links() }}</div>
    </div>
</x-shop-layout>