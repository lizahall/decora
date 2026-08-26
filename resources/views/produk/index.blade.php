<x-shop-layout title="Katalog Produk">
    <div class="max-w-6xl mx-auto py-8 px-4">
        <h1 class="text-2xl font-bold mb-6">Katalog Produk DECORA</h1>

        <div class="grid grid-cols-1 sm:grid-cols-3 lg:grid-cols-4 gap-6">
            @forelse ($produk as $item)
                <a href="{{ route('produk.show', $item->id) }}" class="border rounded-md p-3 hover:shadow-md transition">
                    <img src="{{ $item->foto ? asset('storage/'.$item->foto) : 'https://placehold.co/300x200' }}"
                         class="w-full h-40 object-cover rounded mb-2">
                    <p class="font-semibold">{{ $item->nama }}</p>
                    <p class="text-sm text-gray-600">Rp {{ number_format($item->harga, 0, ',', '.') }}</p>
                </a>
            @empty
                <p>Belum ada produk.</p>
            @endforelse
        </div>

        <div class="mt-6">{{ $produk->links() }}</div>
    </div>
</x-shop-layout>