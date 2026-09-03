<x-shop-layout title="Katalog Produk">
    <div class="max-w-6xl mx-auto px-4 py-10">

        <h1 class="text-2xl font-bold text-decora-text mb-6">Katalog Produk</h1>

        {{-- Kategori Horizontal --}}
        <div class="flex items-center gap-3 flex-wrap mb-8">
            <span class="text-sm font-semibold text-decora-text/60">Kategori:</span>

            <a href="{{ route('produk.index') }}"
               class="px-4 py-1.5 rounded-full text-sm border {{ !request('kategori') ? 'bg-decora-brown text-white border-decora-brown' : 'border-decora-cream-dark text-decora-text/70 hover:bg-decora-cream-dark' }}">
                Semua
            </a>
            @foreach ($kategori as $item)
                <a href="{{ route('produk.index', ['kategori' => $item] + (request('cari') ? ['cari' => request('cari')] : [])) }}"
                   class="px-4 py-1.5 rounded-full text-sm border {{ request('kategori') === $item ? 'bg-decora-brown text-white border-decora-brown' : 'border-decora-cream-dark text-decora-text/70 hover:bg-decora-cream-dark' }}">
                    {{ $item }}
                </a>
            @endforeach
        </div>

        @if (request('cari'))
            <p class="text-sm text-decora-text/60 mb-4">
                Hasil pencarian untuk "<span class="font-semibold">{{ request('cari') }}</span>"
            </p>
        @endif

        {{-- Grid Produk --}}
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-5">
            @forelse ($produk as $item)
                <x-product-card :produk="$item" />
            @empty
                <p class="text-decora-text/60 col-span-full text-center py-10">Belum ada produk.</p>
            @endforelse
        </div>

        <div class="mt-8">{{ $produk->links() }}</div>

    </div>
</x-shop-layout>