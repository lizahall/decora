<x-guest-layout>
    <div class="max-w-3xl mx-auto py-8 px-4">
        @if (session('error'))
            <p class="text-red-600 mb-4">{{ session('error') }}</p>
        @endif

        <img src="{{ $produk->foto ? asset('storage/'.$produk->foto) : 'https://placehold.co/400x300' }}"
             class="w-full max-w-md rounded mb-4">
        <h1 class="text-2xl font-bold">{{ $produk->nama }}</h1>
        <p class="text-lg text-gray-700 mb-2">Rp {{ number_format($produk->harga, 0, ',', '.') }}</p>
        <p class="text-sm mb-2">Kategori: {{ $produk->kategori }}</p>
        <p class="text-sm mb-4">Stok: {{ $produk->stok }}</p>
        <p class="mb-6">{{ $produk->deskripsi }}</p>

        {{-- Tombol Tambah ke Keranjang & Checkout Langsung kita isi di Fase 5 --}}
        <button class="px-6 py-2 bg-green-200 rounded" disabled>Tambah ke Keranjang (Fase 5)</button>
    </div>
</x-guest-layout>