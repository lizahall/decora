<x-shop-layout title="Detail Pesanan">
    <div class="max-w-3xl mx-auto py-8 px-4">

        @if (session('success'))
            <p class="text-green-600 font-semibold mb-4">{{ session('success') }}</p>
        @endif

        <h1 class="text-2xl font-bold mb-2">Invoice Pesanan #{{ $pesanan->id }}</h1>
        <p class="text-sm text-gray-500 mb-6">Status: <span class="font-semibold uppercase">{{ $pesanan->status_pesanan }}</span></p>

        <div class="border border-gray-300 rounded mb-6">
            @foreach ($pesanan->detailPesanan as $detail)
                <div class="flex items-center justify-between px-4 py-3 border-b border-gray-200 last:border-b-0">
                    <div>
                        <p class="font-semibold">{{ $detail->produk->nama }}</p>
                        <p class="text-sm text-gray-600">{{ $detail->jumlah }} x Rp {{ number_format($detail->harga_satuan, 0, ',', '.') }}</p>
                    </div>
                    <p class="font-semibold">Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</p>
                </div>
            @endforeach
            <div class="px-4 py-3 flex justify-between font-bold bg-gray-50">
                <span>Total</span>
                <span>Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}</span>
            </div>
        </div>

        <div class="text-sm space-y-1 mb-6">
            <p><span class="text-gray-500">Alamat Pengiriman:</span> {{ $pesanan->alamat_pengiriman }}</p>
            <p><span class="text-gray-500">No. Telepon:</span> {{ $pesanan->no_telepon }}</p>
            <p><span class="text-gray-500">Metode Pembayaran:</span> {{ $pesanan->metode_pembayaran }}</p>
        </div>

        <a href="{{ route('produk.index') }}" class="text-blue-600 text-sm underline">Kembali ke Katalog</a>
    </div>
</x-shop-layout>