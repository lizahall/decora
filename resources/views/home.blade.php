<x-shop-layout title="Beranda">

    {{-- Hero Section: 1 kartu besar, teks kiri (padded) + foto kanan (full-bleed) --}}
    <div class="max-w-6xl mx-auto px-4 py-10">
        <div class="bg-decora-cream-dark rounded-3xl overflow-hidden">
            <div class="grid grid-cols-1 md:grid-cols-2 items-stretch">

                <div class="p-8 sm:p-10 md:p-12 flex flex-col justify-center">
                    <p class="text-xs font-semibold tracking-widest text-decora-brown uppercase mb-3">
                        Furniture &amp; Dekorasi Rumah
                    </p>

                    <h1 class="text-3xl sm:text-4xl font-bold text-decora-text mb-4 leading-tight">
                        Percantik Rumah,<br>Ciptakan Kenyamanan
                    </h1>

                    <p class="text-decora-text/70 mb-8 max-w-sm">
                        Temukan berbagai furniture dan dekorasi terbaik untuk hunian impianmu di DECORA.
                    </p>

                    <x-button variant="primary" class="!px-7 !py-3 self-start" onclick="window.location='{{ route('produk.index') }}'">
                        Belanja Sekarang →
                    </x-button>

                    <div class="flex flex-wrap gap-x-6 gap-y-3 mt-8 text-xs text-decora-text/60">
                        <div class="flex items-center gap-2">
                            <span class="text-base">🚚</span>
                            <div>
                                <p class="font-semibold text-decora-text">Gratis Ongkir</p>
                                <p>Min. pembelian tertentu</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="text-base">↩️</span>
                            <div>
                                <p class="font-semibold text-decora-text">Retur Mudah</p>
                                <p>7 hari pengembalian</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="text-base">🔒</span>
                            <div>
                                <p class="font-semibold text-decora-text">Pembayaran Aman</p>
                                <p>100% terjamin</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="relative h-64 sm:h-72 md:h-full">
                    <img src="{{ asset('images/hero-living-room.jpg') }}"
                         alt="Ruang tamu dengan furniture DECORA"
                         class="absolute inset-0 w-full h-full object-cover">
                    {{-- Fade cuma di sisi kiri (deket teks), sisanya full nempel ke tepi card --}}
                    <div class="absolute inset-y-0 left-0 w-1/3 bg-gradient-to-r from-decora-cream-dark to-transparent pointer-events-none"></div>
                </div>

            </div>
        </div>
    </div>

    <div class="max-w-6xl mx-auto px-4 py-12">

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