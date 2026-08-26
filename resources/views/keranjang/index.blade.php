<x-shop-layout title="Keranjang">
    <div class="max-w-3xl mx-auto py-8 px-4">
        <h1 class="text-2xl font-bold mb-6">Keranjang Belanja</h1>

        @if (session('error'))
            <p class="text-red-600 mb-4">{{ session('error') }}</p>
        @endif
        @if (session('success'))
            <p class="text-green-600 mb-4">{{ session('success') }}</p>
        @endif

        @forelse ($items as $item)
            <div class="flex items-center justify-between border-b border-gray-300 py-4">
                <div class="flex items-center gap-4">
                    <img src="{{ $item->produk->foto ? asset('storage/'.$item->produk->foto) : 'https://placehold.co/60x60' }}"
                         class="w-16 h-16 object-cover rounded">
                    <div>
                        <p class="font-semibold">{{ $item->produk->nama }}</p>
                        <p class="text-sm text-gray-600">Rp {{ number_format($item->produk->harga, 0, ',', '.') }}</p>
                    </div>
                </div>

                <div class="flex items-center gap-3">
                    <form action="{{ route('keranjang.update', $item->id) }}" method="POST" class="flex items-center gap-2">
                        @csrf
                        @method('PATCH')
                        <input type="number" name="jumlah" value="{{ $item->jumlah }}" min="1" max="{{ $item->produk->stok }}"
                               class="w-16 border border-gray-400 rounded-sm px-2 py-1">
                        <button type="submit" class="text-sm text-blue-600">Update</button>
                    </form>

                    <form action="{{ route('keranjang.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Hapus produk ini dari keranjang?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-sm text-red-600">Hapus</button>
                    </form>
                </div>
            </div>
        @empty
            <p class="text-gray-500">Keranjang kamu masih kosong.</p>
        @endforelse

        @if ($items->isNotEmpty())
            <div class="mt-6 flex items-center justify-between">
                <p class="text-lg font-bold">Total: Rp {{ number_format($total, 0, ',', '.') }}</p>
                <a href="{{ route('checkout.create') }}" class="px-6 py-2 bg-green-200 border border-gray-400 rounded-sm font-semibold">
                    Checkout
                </a>
            </div>
        @endif
    </div>
</x-shop-layout>