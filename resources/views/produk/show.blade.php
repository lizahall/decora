<x-shop-layout title="Detail Produk">
    <div class="max-w-6xl mx-auto px-4 py-10">

        {{-- Breadcrumb --}}
        <div class="text-sm text-decora-text/60 mb-6">
            <a href="{{ route('home') }}" class="hover:text-decora-brown">Beranda</a>
            <span class="mx-1">›</span>
            <a href="{{ route('produk.index', ['kategori' => $produk->kategori]) }}" class="hover:text-decora-brown">{{ $produk->kategori }}</a>
            <span class="mx-1">›</span>
            <span class="text-decora-text">{{ $produk->nama }}</span>
        </div>

        @if (session('error'))
            <div class="mb-6 text-sm text-red-600 bg-red-50 border border-red-200 rounded-lg p-3">{{ session('error') }}</div>
        @endif
        @if (session('success'))
            <div class="mb-6 text-sm text-green-700 bg-green-50 border border-green-200 rounded-lg p-3">{{ session('success') }}</div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 gap-10">

            {{-- Galeri Foto --}}
            <div>
                <div class="aspect-square rounded-xl overflow-hidden bg-decora-cream border border-decora-cream-dark">
                    <img src="{{ $produk->foto ? asset('storage/'.$produk->foto) : 'https://placehold.co/500x500' }}"
                         class="w-full h-full object-cover">
                </div>
            </div>

            {{-- Info Produk --}}
            <div>
                <h1 class="text-2xl font-bold text-decora-text mb-2">{{ $produk->nama }}</h1>

                <p class="text-2xl font-bold text-decora-brown mb-3">
                    Rp {{ number_format($produk->harga, 0, ',', '.') }}
                </p>

                <p class="text-sm text-decora-text/60 mb-6">
                    Stok tersedia: <span class="font-semibold text-decora-text">{{ $produk->stok }}</span>
                </p>

                <p class="text-decora-text/80 leading-relaxed mb-8">
                    {{ $produk->deskripsi }}
                </p>

                @auth
                    @if ($produk->stok > 0)
                        <form action="{{ route('keranjang.store') }}" method="POST" class="mb-3">
                            @csrf
                            <input type="hidden" name="produk_id" value="{{ $produk->id }}">

                            <label class="block text-sm font-medium text-decora-text/70 mb-2">Jumlah</label>
                            <div class="flex items-center gap-3 mb-6">
                                <input type="number" id="jumlah-input" name="jumlah" value="1" min="1" max="{{ $produk->stok }}"
                                       class="w-24 border-decora-cream-dark rounded-lg focus:border-decora-sage focus:ring-decora-sage">
                            </div>

                            <div class="flex flex-col sm:flex-row gap-3">
                                <x-button type="submit" variant="secondary" class="flex-1">
                                    Tambah ke Keranjang
                                </x-button>
                                <x-button variant="primary" class="flex-1"
                                          onclick="event.preventDefault(); document.getElementById('jumlah-beli-langsung').value = document.getElementById('jumlah-input').value; document.getElementById('beli-langsung-form').submit();">
                                    Beli Sekarang
                                </x-button>
                            </div>
                        </form>

                        <form id="beli-langsung-form" action="{{ route('checkout.create') }}" method="GET" class="hidden">
                            <input type="hidden" name="produk_id" value="{{ $produk->id }}">
                            <input type="hidden" id="jumlah-beli-langsung" name="jumlah" value="1">
                        </form>
                    @else
                        <p class="text-red-600 font-semibold">Stok habis.</p>
                    @endif
                @else
                    <p class="text-sm text-decora-text/60">
                        <a href="{{ route('login') }}" class="text-decora-brown underline">Login</a> terlebih dahulu untuk membeli produk ini.
                    </p>
                @endauth
            </div>
        </div>
    </div>
</x-shop-layout>