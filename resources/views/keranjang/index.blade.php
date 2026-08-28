<x-shop-layout title="Keranjang">
    <div class="max-w-6xl mx-auto px-4 py-10">

        <h1 class="text-2xl font-bold text-decora-text mb-6">Keranjang Belanja</h1>

        @if (session('error'))
            <div class="mb-6 text-sm text-red-600 bg-red-50 border border-red-200 rounded-lg p-3">{{ session('error') }}</div>
        @endif
        @if (session('success'))
            <div class="mb-6 text-sm text-green-700 bg-green-50 border border-green-200 rounded-lg p-3">{{ session('success') }}</div>
        @endif

        @if ($items->isEmpty())
            <div class="text-center py-20">
                <p class="text-decora-text/60 mb-4">Keranjang kamu masih kosong.</p>
                <x-button variant="primary" onclick="window.location='{{ route('produk.index') }}'">Mulai Belanja</x-button>
            </div>
        @else
            <div class="flex flex-col lg:flex-row gap-8 items-start">

                {{-- Daftar Item --}}
                <div class="flex-1 w-full bg-white rounded-xl border border-decora-cream-dark divide-y divide-decora-cream-dark">
                    @foreach ($items as $item)
                        <div class="flex items-center gap-4 p-4">
                            <img src="{{ $item->produk->foto ? asset('storage/'.$item->produk->foto) : 'https://placehold.co/80x80' }}"
                                 class="w-16 h-16 object-cover rounded-lg shrink-0">

                            <div class="flex-1 min-w-0">
                                <p class="font-semibold text-decora-text truncate">{{ $item->produk->nama }}</p>
                                <p class="text-sm text-decora-text/60">Rp {{ number_format($item->produk->harga, 0, ',', '.') }}</p>
                            </div>

                            <form action="{{ route('keranjang.update', $item->id) }}" method="POST" class="flex items-center gap-2">
                                @csrf
                                @method('PATCH')
                                <input type="number" name="jumlah" value="{{ $item->jumlah }}" min="1" max="{{ $item->produk->stok }}"
                                       class="w-16 text-sm border-decora-cream-dark rounded-lg focus:border-decora-sage focus:ring-decora-sage">
                                <button type="submit" class="text-xs text-decora-brown font-medium hover:underline">Update</button>
                            </form>

                            <p class="font-semibold text-decora-text w-28 text-right shrink-0">
                                Rp {{ number_format($item->produk->harga * $item->jumlah, 0, ',', '.') }}
                            </p>

                            <form action="{{ route('keranjang.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Hapus produk ini dari keranjang?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-decora-text/40 hover:text-red-600 text-lg leading-none">&times;</button>
                            </form>
                        </div>
                    @endforeach
                </div>

                {{-- Ringkasan Belanja --}}
                <div class="w-full lg:w-80 shrink-0 bg-white rounded-xl border border-decora-cream-dark p-5 sticky top-20">
                    <p class="font-semibold text-decora-text mb-4">Ringkasan Belanja</p>

                    <div class="flex justify-between text-sm text-decora-text/70 mb-2">
                        <span>Subtotal ({{ $items->sum('jumlah') }} produk)</span>
                        <span>Rp {{ number_format($total, 0, ',', '.') }}</span>
                    </div>

                    <div class="border-t border-decora-cream-dark my-3"></div>

                    <div class="flex justify-between font-bold text-decora-text mb-5">
                        <span>Total</span>
                        <span>Rp {{ number_format($total, 0, ',', '.') }}</span>
                    </div>

                    <x-button variant="primary" class="w-full" onclick="window.location='{{ route('checkout.create') }}'">
                        Checkout
                    </x-button>
                </div>
            </div>
        @endif
    </div>
</x-shop-layout>