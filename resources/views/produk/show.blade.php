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

        <div class="bg-white rounded-3xl border border-decora-cream-dark overflow-hidden mb-14">
            <div class="grid grid-cols-1 md:grid-cols-2 md:h-[540px]">

                {{-- Foto --}}
                <div class="bg-decora-cream h-72 md:h-full">
                    <img src="{{ $produk->foto ? asset('storage/'.$produk->foto) : 'https://placehold.co/600x600' }}"
                         class="w-full h-full object-cover">
                </div>

                {{-- Info Produk --}}
                <div class="p-6 sm:p-8 flex flex-col justify-center overflow-y-auto">

                    <span class="inline-block w-fit px-3 py-1 rounded-full text-xs font-semibold bg-decora-sage/30 text-decora-brown-dark mb-3">
                        {{ $produk->kategori }}
                    </span>

                    <h1 class="text-2xl sm:text-3xl font-bold text-decora-text mb-2">{{ $produk->nama }}</h1>

                    <p class="text-3xl font-bold text-decora-brown mb-3">
                        Rp {{ number_format($produk->harga, 0, ',', '.') }}
                    </p>

                    <div class="mb-4">
                        @if ($produk->stok > 0)
                            <span class="inline-flex items-center gap-1.5 text-sm text-green-700">
                                <span class="w-2 h-2 rounded-full bg-green-500"></span>
                                Stok tersedia ({{ $produk->stok }})
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1.5 text-sm text-red-600">
                                <span class="w-2 h-2 rounded-full bg-red-500"></span>
                                Stok habis
                            </span>
                        @endif
                    </div>

                    <div class="border-t border-decora-cream-dark pt-4 mb-4">
                        <p class="text-decora-text/70 leading-relaxed">{{ $produk->deskripsi }}</p>
                    </div>

                    @auth
                        @if ($produk->stok > 0)
                            <form action="{{ route('keranjang.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="produk_id" value="{{ $produk->id }}">

                                <label class="block text-sm font-medium text-decora-text/70 mb-2">Jumlah</label>
                                <div class="flex items-center gap-3 mb-4">
                                    <div class="flex items-center border border-decora-cream-dark rounded-lg overflow-hidden">
                                        <button type="button" onclick="ubahJumlah(-1)" class="w-9 h-9 text-decora-text/60 hover:bg-decora-cream">−</button>
                                        <input type="number" id="jumlah-input" name="jumlah" value="1" min="1" max="{{ $produk->stok }}"
                                               class="w-14 text-center border-0 border-x border-decora-cream-dark focus:ring-0">
                                        <button type="button" onclick="ubahJumlah(1)" class="w-9 h-9 text-decora-text/60 hover:bg-decora-cream">+</button>
                                    </div>
                                </div>

                                <div class="flex flex-col sm:flex-row gap-3 mb-5">
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
                            <p class="text-red-600 font-semibold mb-5">Stok produk ini sedang habis.</p>
                        @endif
                    @else
                        <div class="bg-decora-cream rounded-lg p-4 mb-5 text-sm text-decora-text/70">
                            <a href="{{ route('login') }}" class="text-decora-brown font-semibold underline">Login</a> terlebih dahulu untuk membeli produk ini.
                        </div>
                    @endauth

                    {{-- Badge kepercayaan --}}
                    <div class="flex flex-wrap gap-x-6 gap-y-2 pt-4 border-t border-decora-cream-dark text-xs text-decora-text/60">
                        <span>🚚 Gratis Ongkir*</span>
                        <span>↩️ Retur 7 Hari</span>
                        <span>🔒 Pembayaran Aman</span>
                    </div>

                </div>
            </div>
        </div>

    <script>
        function ubahJumlah(delta) {
            const input = document.getElementById('jumlah-input');
            let val = parseInt(input.value) + delta;
            const max = parseInt(input.max);
            if (val < 1) val = 1;
            if (val > max) val = max;
            input.value = val;
        }
    </script>
</x-shop-layout>
