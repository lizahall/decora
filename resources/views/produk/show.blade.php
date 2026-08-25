<x-guest-layout>
    <div class="max-w-3xl mx-auto py-8 px-4">

        @if (session('error'))
            <p class="text-red-600 mb-4">{{ session('error') }}</p>
        @endif
        @if (session('success'))
            <p class="text-green-600 mb-4">{{ session('success') }}</p>
        @endif

        <img src="{{ $produk->foto ? asset('storage/'.$produk->foto) : 'https://placehold.co/400x300' }}"
             class="w-full max-w-md rounded mb-4">
        <h1 class="text-2xl font-bold">{{ $produk->nama }}</h1>
        <p class="text-lg text-gray-700 mb-2">Rp {{ number_format($produk->harga, 0, ',', '.') }}</p>
        <p class="text-sm mb-2">Kategori: {{ $produk->kategori }}</p>
        <p class="text-sm mb-4">Stok: {{ $produk->stok }}</p>
        <p class="mb-6">{{ $produk->deskripsi }}</p>

        @auth
            @if ($produk->stok > 0)
                <div class="flex items-end gap-3">
                    <form action="{{ route('keranjang.store') }}" method="POST" class="flex items-end gap-3">
                        @csrf
                        <input type="hidden" name="produk_id" value="{{ $produk->id }}">
                        <div>
                            <label class="block text-xs text-gray-500 mb-1">Jumlah</label>
                            <input type="number" name="jumlah" value="1" min="1" max="{{ $produk->stok }}"
                                   class="w-20 border border-gray-400 rounded-sm px-2 py-2">
                        </div>
                        <button type="submit" class="px-6 py-2 border border-gray-400 rounded-sm bg-green-100 font-semibold">
                            Tambah ke Keranjang
                        </button>
                    </form>

                    <form action="{{ route('checkout.create') }}" method="GET">
                        <input type="hidden" name="produk_id" value="{{ $produk->id }}">
                        <input type="hidden" name="jumlah" value="1">
                        <button type="submit" class="px-6 py-2 border border-gray-400 rounded-sm bg-yellow-100 font-semibold">
                            Beli Langsung
                        </button>
                    </form>
                </div>
            @else
                <p class="text-red-600 font-semibold">Stok habis.</p>
            @endif
        @else
            <p class="text-sm text-gray-500">
                <a href="{{ route('login') }}" class="underline">Login</a> terlebih dahulu untuk membeli produk ini.
            </p>
        @endauth

    </div>
</x-guest-layout>