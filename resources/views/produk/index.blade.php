<x-shop-layout title="Katalog Produk">
    <div class="max-w-6xl mx-auto px-4 py-10">

        <h1 class="text-2xl font-bold text-decora-text mb-6">Katalog Produk</h1>

        <div class="flex flex-col md:flex-row gap-8">

            {{-- Sidebar Filter Kategori --}}
            <aside class="w-full md:w-48 shrink-0">
                <p class="font-semibold text-sm text-decora-text/60 uppercase mb-3">Kategori</p>
                <div class="flex flex-col gap-1">
                    <a href="{{ route('produk.index') }}"
                       class="px-3 py-2 rounded-lg text-sm {{ !request('kategori') ? 'bg-decora-brown text-white' : 'text-decora-text/70 hover:bg-decora-cream-dark' }}">
                        Semua Kategori
                    </a>
                    @foreach ($kategori as $item)
                        <a href="{{ route('produk.index', ['kategori' => $item]) }}"
                           class="px-3 py-2 rounded-lg text-sm {{ request('kategori') === $item ? 'bg-decora-brown text-white' : 'text-decora-text/70 hover:bg-decora-cream-dark' }}">
                            {{ $item }}
                        </a>
                    @endforeach
                </div>
            </aside>

            {{-- Grid Produk --}}
            <div class="flex-1">
                @if (request('cari'))
                    <p class="text-sm text-decora-text/60 mb-4">
                        Hasil pencarian untuk "<span class="font-semibold">{{ request('cari') }}</span>"
                    </p>
                @endif

                <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-5">
                    @forelse ($produk as $item)
                        <x-product-card :produk="$item" />
                    @empty
                        <p class="text-decora-text/60 col-span-full text-center py-10">Belum ada produk.</p>
                    @endforelse
                </div>

                <div class="mt-8">{{ $produk->links() }}</div>
            </div>

        </div>
    </div>
</x-shop-layout>