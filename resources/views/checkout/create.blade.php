<x-shop-layout title="Checkout">
    <div class="max-w-6xl mx-auto px-4 py-10">

        <h1 class="text-2xl font-bold text-decora-text mb-6">Checkout</h1>

        @if (session('error'))
            <div class="mb-6 text-sm text-red-600 bg-red-50 border border-red-200 rounded-lg p-3">{{ session('error') }}</div>
        @endif
        @if ($errors->any())
            <div class="mb-6 text-sm text-red-600 bg-red-50 border border-red-200 rounded-lg p-3">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form action="{{ route('checkout.store') }}" method="POST">
            @csrf
            <input type="hidden" name="mode" value="{{ $mode }}">
            @if ($mode === 'langsung')
                <input type="hidden" name="produk_id" value="{{ $items->first()->produk->id }}">
                <input type="hidden" name="jumlah" value="{{ $items->first()->jumlah }}">
            @else
                @foreach ($keranjangIds as $id)
                    <input type="hidden" name="keranjang_ids[]" value="{{ $id }}">
                @endforeach
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">

                {{-- Form Kiri (2/3 lebar) --}}
                <div class="lg:col-span-2 space-y-6">

                    <div class="bg-white rounded-xl border border-decora-cream-dark p-5">
                        <p class="font-semibold text-decora-text mb-4">Alamat Pengiriman</p>

                        <div class="mb-4">
                            <x-input-label value="Alamat Lengkap" />
                            <textarea name="alamat_pengiriman" rows="3"
                                      class="w-full border-decora-cream-dark bg-decora-cream/40 rounded-lg focus:border-decora-sage focus:ring-decora-sage">{{ old('alamat_pengiriman') }}</textarea>
                        </div>

                        <div>
                            <x-input-label value="Nomor Telepon" />
                            <x-text-input type="text" name="no_telepon" value="{{ old('no_telepon') }}" />
                        </div>
                    </div>

                    <div class="bg-white rounded-xl border border-decora-cream-dark p-5">
                        <p class="font-semibold text-decora-text mb-4">Metode Pembayaran</p>

                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                            @foreach (['Transfer Bank' => '🏦', 'E-Wallet' => '📱', 'COD' => '💵'] as $metode => $icon)
                                <label class="cursor-pointer">
                                    <input type="radio" name="metode_pembayaran" value="{{ $metode }}" class="peer hidden" required
                                           {{ old('metode_pembayaran') === $metode ? 'checked' : '' }}>
                                    <div class="border-2 border-decora-cream-dark rounded-lg p-4 text-center peer-checked:border-decora-brown peer-checked:bg-decora-cream transition">
                                        <div class="text-2xl mb-1">{{ $icon }}</div>
                                        <p class="text-sm font-medium">{{ $metode }}</p>
                                    </div>
                                </label>
                            @endforeach
                        </div>
                    </div>
                </div>

                {{-- Ringkasan Kanan (1/3 lebar) --}}
                <div class="bg-white rounded-xl border border-decora-cream-dark p-5 sticky top-20">
                    <p class="font-semibold text-decora-text mb-4">Ringkasan Pesanan</p>

                    <div class="space-y-3 mb-4 max-h-64 overflow-y-auto">
                        @foreach ($items as $item)
                            <div class="flex justify-between text-sm">
                                <span class="text-decora-text/70">{{ $item->produk->nama }} <span class="text-decora-text/40">x{{ $item->jumlah }}</span></span>
                                <span class="font-medium">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</span>
                            </div>
                        @endforeach
                    </div>

                    <div class="border-t border-decora-cream-dark my-3"></div>

                    <div class="flex justify-between font-bold text-decora-text mb-5">
                        <span>Total Pembayaran</span>
                        <span>Rp {{ number_format($total, 0, ',', '.') }}</span>
                    </div>

                    <x-button type="submit" variant="primary" class="w-full">
                        Bayar Sekarang
                    </x-button>
                </div>
            </div>
        </form>
    </div>
</x-shop-layout>