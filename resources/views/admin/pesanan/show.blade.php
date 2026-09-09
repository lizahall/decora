<x-admin-layout title="Detail Pesanan">

    <div class="flex items-center justify-between mb-5">
        <h1 class="text-xl font-bold text-decora-text">Pesanan #{{ $pesanan->id }}</h1>
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.pesanan.edit', $pesanan->id) }}" class="text-sm bg-decora-sage/40 text-decora-brown-dark px-4 py-2 rounded-lg font-medium hover:bg-decora-sage/60 transition">
                Edit Status
            </a>
            <a href="{{ route('admin.pesanan.index') }}" class="text-sm text-decora-brown font-medium hover:underline">← Kembali</a>
        </div>
    </div>

    <div class="bg-white border border-decora-cream-dark rounded-xl p-5 mb-5">
        <div class="flex items-center justify-between mb-4">
            <p class="text-sm text-decora-text/50">Status Pesanan</p>
            <x-status-badge :status="$pesanan->status_pesanan" />
        </div>
        <dl class="text-sm space-y-2">
            <div class="flex justify-between"><dt class="text-decora-text/50">User</dt><dd class="text-decora-text">{{ $pesanan->user->nama }} ({{ $pesanan->user->email }})</dd></div>
            <div class="flex justify-between"><dt class="text-decora-text/50">Alamat Pengiriman</dt><dd class="text-decora-text text-right max-w-xs">{{ $pesanan->alamat_pengiriman }}</dd></div>
            <div class="flex justify-between"><dt class="text-decora-text/50">No. Telepon</dt><dd class="text-decora-text">{{ $pesanan->no_telepon }}</dd></div>
            <div class="flex justify-between"><dt class="text-decora-text/50">Metode Pembayaran</dt><dd class="text-decora-text">{{ $pesanan->metode_pembayaran }}</dd></div>
            <div class="flex justify-between"><dt class="text-decora-text/50">Tanggal Pesanan</dt><dd class="text-decora-text">{{ $pesanan->created_at->translatedFormat('d F Y, H:i') }}</dd></div>
        </dl>
    </div>

    <div class="bg-white border border-decora-cream-dark rounded-xl overflow-hidden">
        @foreach ($pesanan->detailPesanan as $detail)
            <div class="flex items-center justify-between px-4 py-3 border-b border-decora-cream-dark last:border-b-0">
                <div>
                    <p class="font-medium text-decora-text">{{ $detail->produk->nama }}</p>
                    <p class="text-sm text-decora-text/60">{{ $detail->jumlah }} x Rp {{ number_format($detail->harga_satuan, 0, ',', '.') }}</p>
                </div>
                <p class="font-medium text-decora-text">Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</p>
            </div>
        @endforeach
        <div class="px-4 py-3 flex justify-between font-bold text-decora-text bg-decora-cream/50">
            <span>Total</span>
            <span>Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}</span>
        </div>
    </div>

</x-admin-layout>