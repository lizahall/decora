@extends('layouts.shop')

@section('title', 'Checkout')

@section('content')

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

                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 mb-4">
                            @foreach (['Transfer Bank' => '🏦', 'E-Wallet' => '📱', 'COD' => '💵'] as $metode => $icon)
                                <label class="cursor-pointer">
                                    <input type="radio" name="metode_pembayaran" value="{{ $metode }}"
                                           class="peer hidden metode-radio" required
                                           onchange="tampilkanInfoPembayaran('{{ $metode }}')"
                                           {{ old('metode_pembayaran') === $metode ? 'checked' : '' }}>
                                    <div class="border-2 border-decora-cream-dark rounded-lg p-4 text-center peer-checked:border-decora-brown peer-checked:bg-decora-cream transition">
                                        <div class="text-2xl mb-1">{{ $icon }}</div>
                                        <p class="text-sm font-medium">{{ $metode }}</p>
                                    </div>
                                </label>
                            @endforeach
                        </div>

                        {{-- Info tujuan transfer, muncul sesuai metode yang dipilih --}}
                        <div id="info-transfer-bank" class="info-pembayaran hidden bg-decora-cream/60 rounded-lg p-4 text-sm space-y-2">
                            <p class="font-semibold text-decora-text mb-1">Transfer ke salah satu rekening berikut:</p>
                            <p>🏦 <strong>BCA</strong> — 1234567890 a.n. DECORA Indonesia</p>
                            <p>🏦 <strong>Mandiri</strong> — 0987654321 a.n. DECORA Indonesia</p>
                            <p>🏦 <strong>BNI</strong> — 1122334455 a.n. DECORA Indonesia</p>
                            <p class="text-xs text-decora-text/60 pt-1">Setelah transfer, upload bukti pembayaran di halaman Detail Pesanan.</p>
                        </div>

                        <div id="info-e-wallet" class="info-pembayaran hidden bg-decora-cream/60 rounded-lg p-4 text-sm space-y-2">
                            <p class="font-semibold text-decora-text mb-1">Kirim ke salah satu e-wallet berikut:</p>
                            <p>📱 <strong>OVO / GoPay / DANA</strong> — 0812-3456-7890 a.n. DECORA Indonesia</p>
                            <p class="text-xs text-decora-text/60 pt-1">Setelah transfer, upload bukti pembayaran di halaman Detail Pesanan.</p>
                        </div>

                        <div id="info-cod" class="info-pembayaran hidden bg-decora-cream/60 rounded-lg p-4 text-sm">
                            <p class="text-decora-text">💵 Siapkan uang pas sesuai total pembayaran saat kurir tiba.</p>
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

    <script>
        function tampilkanInfoPembayaran(metode) {
            document.querySelectorAll('.info-pembayaran').forEach(el => el.classList.add('hidden'));

            const mapId = {
                'Transfer Bank': 'info-transfer-bank',
                'E-Wallet': 'info-e-wallet',
                'COD': 'info-cod',
            };

            const target = document.getElementById(mapId[metode]);
            if (target) target.classList.remove('hidden');
        }

        // Kalau ada metode yang udah kepilih sebelumnya (misal habis error validasi), tampilkan info-nya lagi
        document.addEventListener('DOMContentLoaded', function () {
            const terpilih = document.querySelector('.metode-radio:checked');
            if (terpilih) tampilkanInfoPembayaran(terpilih.value);
        });
    </script>

@endsection