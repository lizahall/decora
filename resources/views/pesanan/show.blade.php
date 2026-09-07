<x-shop-layout title="Detail Pesanan">
    <div class="max-w-2xl mx-auto px-4 py-10">

        <a href="{{ route('pesanan.index') }}" class="text-sm text-decora-brown font-medium hover:underline">← Kembali ke Riwayat Pesanan</a>

        <div class="bg-white rounded-2xl border border-decora-cream-dark p-6 sm:p-8 mt-4">

            <div class="flex items-center justify-between mb-1">
                <h1 class="text-xl font-bold text-decora-text">Pesanan #{{ $pesanan->id }}</h1>
                <x-status-badge :status="$pesanan->status_pesanan" />
            </div>
            <p class="text-sm text-decora-text/50 mb-6">{{ $pesanan->created_at->translatedFormat('d F Y, H:i') }}</p>

            {{-- Progress status --}}
            @if (!in_array($pesanan->status_pesanan, ['dibatalkan']))
                @php
                    $tahapan = ['menunggu' => 'Menunggu', 'diproses' => 'Diproses', 'dikemas' => 'Dikemas', 'dikirim' => 'Dikirim', 'selesai' => 'Selesai'];
                    $urutan = array_keys($tahapan);
                    $posisiSekarang = array_search($pesanan->status_pesanan, $urutan);
                @endphp
                <div class="flex items-center mb-8">
                    @foreach ($tahapan as $key => $label)
                        @php $tercapai = array_search($key, $urutan) <= $posisiSekarang; @endphp
                        <div class="flex-1 flex flex-col items-center">
                            <div class="w-6 h-6 rounded-full flex items-center justify-center text-[10px] font-bold
                                {{ $tercapai ? 'bg-decora-brown text-white' : 'bg-decora-cream-dark text-decora-text/40' }}">
                                {{ $loop->iteration }}
                            </div>
                            <p class="text-[11px] mt-1 text-center {{ $tercapai ? 'text-decora-text font-medium' : 'text-decora-text/40' }}">{{ $label }}</p>
                        </div>
                        @if (!$loop->last)
                            <div class="flex-1 h-0.5 -mt-4 {{ array_search($key, $urutan) < $posisiSekarang ? 'bg-decora-brown' : 'bg-decora-cream-dark' }}"></div>
                        @endif
                    @endforeach
                </div>
            @else
                <div class="mb-8 text-sm text-red-600 bg-red-50 border border-red-200 rounded-lg p-3">
                    Pesanan ini telah dibatalkan.
                </div>
            @endif

            {{-- Daftar Barang --}}
            <div class="border border-decora-cream-dark rounded-xl overflow-hidden mb-6">
                @foreach ($pesanan->detailPesanan as $detail)
                    <div class="flex items-center gap-4 p-4 border-b border-decora-cream-dark last:border-b-0">
                        <img src="{{ $detail->produk->foto ? asset('storage/'.$detail->produk->foto) : 'https://placehold.co/60x60' }}"
                             class="w-14 h-14 object-cover rounded-lg shrink-0">
                        <div class="flex-1 min-w-0">
                            <p class="font-medium text-decora-text truncate">{{ $detail->produk->nama }}</p>
                            <p class="text-sm text-decora-text/60">{{ $detail->jumlah }} x Rp {{ number_format($detail->harga_satuan, 0, ',', '.') }}</p>
                        </div>
                        <p class="font-semibold text-decora-text shrink-0">Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</p>
                    </div>
                @endforeach
                <div class="px-4 py-3 flex justify-between font-bold text-decora-text bg-decora-cream">
                    <span>Total</span>
                    <span>Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}</span>
                </div>
            </div>

            {{-- Informasi Pengiriman --}}
            <div class="bg-decora-cream/60 rounded-xl p-5 text-sm space-y-2">
                <p class="font-semibold text-decora-text mb-1">Informasi Pengiriman</p>
                <p><span class="text-decora-text/50">Alamat:</span> {{ $pesanan->alamat_pengiriman }}</p>
                <p><span class="text-decora-text/50">No. Telepon:</span> {{ $pesanan->no_telepon }}</p>
                <p><span class="text-decora-text/50">Metode Pembayaran:</span> {{ $pesanan->metode_pembayaran }}</p>
            </div>

        </div>
    </div>
</x-shop-layout>