@props(['produk'])

<a href="{{ route('produk.show', $produk->id) }}"
   class="block bg-white rounded-xl border border-decora-cream-dark overflow-hidden hover:shadow-xl hover:-translate-y-1 hover:border-decora-sage-dark transition-all duration-300 group">

    <div class="relative aspect-square overflow-hidden bg-decora-cream">
        <img src="{{ $produk->foto ? asset('storage/'.$produk->foto) : 'https://placehold.co/300x300' }}"
             class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
        {{-- Vignette halus biar foto gak keliatan flat --}}
        <div class="absolute inset-0 bg-gradient-to-t from-decora-text/10 via-transparent to-transparent"></div>
        <div class="absolute inset-0 ring-1 ring-inset ring-black/5"></div>
    </div>

    <div class="p-3">
        <p class="font-semibold text-decora-text text-sm truncate">{{ $produk->nama }}</p>
        <p class="text-decora-brown font-bold mt-1">Rp {{ number_format($produk->harga, 0, ',', '.') }}</p>
    </div>
</a>