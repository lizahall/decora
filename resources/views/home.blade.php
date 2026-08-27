<x-shop-layout title="Beranda">

    {{-- Hero Section --}}
    <div class="bg-decora-cream-dark">
        <div class="max-w-6xl mx-auto px-4 py-20 text-center">
            <h1 class="text-3xl sm:text-4xl font-bold text-decora-text mb-4">
                Percantik Rumah, Ciptakan Kenyamanan
            </h1>
            <p class="text-decora-text/70 max-w-xl mx-auto mb-8">
                Temukan berbagai furniture dan dekorasi terbaik untuk hunian impianmu di DECORA.
            </p>
            <x-button variant="primary" class="!px-10 !py-3 !text-base" onclick="window.location='{{ route('produk.index') }}'">
                Belanja Sekarang
            </x-button>
        </div>
    </div>

    {{-- Produk Terbaru --}}
    <div class="max-w-6xl mx-auto px-4 py-14">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-xl font-bold text-decora-text">Produk Terbaru</h2>
            <a href="{{ route('produk.index') }}" class="text-sm text-decora-brown font-medium hover:underline">Lihat Semua →</a>
        </div>

        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-5">
            @forelse ($produkTerbaru as $item)
                <x-product-card :produk="$item" />
            @empty
                <p class="text-decora-text/60 col-span-full text-center py-10">Belum ada produk.</p>
            @endforelse
        </div>
    </div>

</x-shop-layout>