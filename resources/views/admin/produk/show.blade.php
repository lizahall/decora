<x-admin-layout title="Detail Produk">

    <div class="flex items-center justify-between mb-5">
        <h1 class="text-xl font-bold text-decora-text">Detail Produk</h1>
        <a href="{{ route('admin.produk.index') }}" class="text-sm text-decora-brown font-medium hover:underline">← Kembali</a>
    </div>

    <div class="bg-white border border-decora-cream-dark rounded-2xl p-6 sm:p-8 max-w-2xl">
        <div class="flex flex-col sm:flex-row gap-6 mb-6">
            <img src="{{ $produk->foto ? asset('storage/'.$produk->foto) : 'https://placehold.co/200x200' }}"
                 class="w-40 h-40 object-cover rounded-xl border border-decora-cream-dark shrink-0">

            <div class="flex-1">
                <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold bg-decora-sage/30 text-decora-brown-dark mb-2">
                    {{ $produk->kategori }}
                </span>
                <h2 class="text-xl font-bold text-decora-text mb-1">{{ $produk->nama }}</h2>
                <p class="text-2xl font-bold text-decora-brown">Rp {{ number_format($produk->harga, 0, ',', '.') }}</p>
            </div>
        </div>

        <dl class="divide-y divide-decora-cream-dark text-sm">
            <div class="flex justify-between py-3">
                <dt class="text-decora-text/50">Stok</dt>
                <dd class="text-decora-text font-medium">{{ $produk->stok }}</dd>
            </div>
            <div class="py-3">
                <dt class="text-decora-text/50 mb-1">Deskripsi</dt>
                <dd class="text-decora-text">{{ $produk->deskripsi ?: '-' }}</dd>
            </div>
            <div class="flex justify-between py-3">
                <dt class="text-decora-text/50">Dibuat Pada</dt>
                <dd class="text-decora-text">{{ $produk->created_at->translatedFormat('d F Y, H:i') }}</dd>
            </div>
            <div class="flex justify-between py-3">
                <dt class="text-decora-text/50">Terakhir Diupdate</dt>
                <dd class="text-decora-text">{{ $produk->updated_at->translatedFormat('d F Y, H:i') }}</dd>
            </div>
        </dl>

        <div class="flex gap-3 mt-6 pt-6 border-t border-decora-cream-dark">
            <a href="{{ route('admin.produk.edit', $produk->id) }}" class="px-5 py-2 rounded-lg bg-decora-sage/40 text-decora-brown-dark font-medium text-sm hover:bg-decora-sage/60 transition">
                Edit Produk
            </a>
        </div>
    </div>

</x-admin-layout>