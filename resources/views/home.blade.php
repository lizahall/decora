<x-shop-layout title="Beranda">

    <div class="bg-white border-b border-gray-200">
        <div class="max-w-6xl mx-auto px-4 py-16 text-center">
            <h1 class="text-3xl font-bold mb-3">Furniture & Dekorasi Rumah Impianmu</h1>
            <p class="text-gray-600 mb-6">Temukan berbagai perabot dan dekorasi berkualitas untuk rumahmu di DECORA.</p>
            <a href="{{ route('produk.index') }}" class="inline-block bg-green-200 border border-gray-400 px-8 py-3 rounded-sm font-semibold">
                Lihat Katalog
            </a>
        </div>
    </div>

    <div class="max-w-6xl mx-auto px-4 py-10">
        <h2 class="text-xl font-bold mb-6">Produk Terbaru</h2>

        <div class="grid grid-cols-1 sm:grid-cols-3 lg:grid-cols-4 gap-6">
            @forelse ($produkTerbaru as $item)
                <a href="{{ route('produk.show', $item->id) }}" class="border border-gray-300 rounded-md p-3 bg-white hover:shadow-md transition">
                    <img src="{{ $item->foto ? asset('storage/'.$item->foto) : 'https://placehold.co/300x200' }}"
                         class="w-full h-40 object-cover rounded mb-2">
                    <p class="font-semibold">{{ $item->nama }}</p>
                    <p class="text-sm text-gray-600">Rp {{ number_format($item->harga, 0, ',', '.') }}</p>
                </a>
            @empty
                <p class="text-gray-500">Belum ada produk.</p>
            @endforelse
        </div>
    </div>

</x-shop-layout>