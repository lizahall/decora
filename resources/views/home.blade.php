<x-shop-layout title="Beranda">

    {{-- Hero Section: full-bleed foto dominan, teks rata kiri --}}
    <div class="relative h-[420px] sm:h-[520px] overflow-hidden">
        <img src="{{ asset('images/hero-living-room.jpg') }}"
             alt="Ruang tamu dengan furniture DECORA"
             class="absolute inset-0 w-full h-full object-cover">

        {{-- Gradient gelap dari kiri biar teks kebaca --}}
        <div class="absolute inset-0 bg-gradient-to-r from-decora-text/80 via-decora-text/40 to-transparent"></div>

        {{-- Fade halus ke background cream di bawah, biar transisi ke section berikutnya smooth --}}
        <div class="absolute inset-x-0 bottom-0 h-24 bg-gradient-to-b from-transparent to-decora-cream pointer-events-none"></div>

        <div class="relative h-full max-w-6xl mx-auto px-4 flex items-center">
            <div class="max-w-md">
                <p class="text-xs font-semibold tracking-widest text-white/80 uppercase mb-3 animate-fade-up">
                    Furniture &amp; Dekorasi Rumah
                </p>

                <h1 class="text-3xl sm:text-5xl font-bold text-white mb-4 leading-tight animate-fade-up" style="animation-delay: 0.1s">
                    Percantik Rumah,<br>Ciptakan Kenyamanan
                </h1>

                <p class="text-white/80 mb-8 max-w-sm animate-fade-up" style="animation-delay: 0.2s">
                    Temukan berbagai furniture dan dekorasi terbaik untuk hunian impianmu di DECORA.
                </p>

                <div class="flex flex-wrap gap-3 animate-fade-up" style="animation-delay: 0.3s">
                    <a href="{{ route('produk.index') }}"
                       class="px-7 py-3 rounded-lg bg-decora-brown text-white font-semibold hover:bg-decora-brown-dark transition">
                        Belanja Sekarang
                    </a>
                    <a href="{{ route('produk.index') }}"
                       class="px-7 py-3 rounded-lg border-2 border-white/70 text-white font-semibold hover:bg-white/10 transition">
                        Lihat Koleksi
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-6xl mx-auto px-4 py-10">

        {{-- Kategori Cepat --}}
        <div class="flex items-center gap-3 flex-wrap mb-8">
            <span class="text-sm font-semibold text-decora-text/60">Kategori:</span>

            <a href="{{ route('produk.index') }}"
               class="px-4 py-1.5 rounded-full text-sm border {{ !request('kategori') ? 'bg-decora-brown text-white border-decora-brown' : 'border-decora-cream-dark text-decora-text/70 hover:bg-decora-cream-dark' }}">
                Semua
            </a>
            @foreach ($kategori as $item)
                <a href="{{ route('produk.index', ['kategori' => $item]) }}"
                   class="px-4 py-1.5 rounded-full text-sm border border-decora-cream-dark text-decora-text/70 hover:bg-decora-cream-dark">
                    {{ $item }}
                </a>
            @endforeach
        </div>

        {{-- Produk Terbaru --}}
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-xl font-bold text-decora-text">Katalog Produk</h2>
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