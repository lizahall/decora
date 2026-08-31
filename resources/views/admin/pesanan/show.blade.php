<x-admin-layout title="Detail Pesanan">

    <div class="flex items-center justify-between mb-5">
        <h1 class="text-xl font-bold text-decora-text">Pesanan #{{ $pesanan->id }}</h1>
        <a href="{{ route('admin.pesanan.index') }}" class="text-sm text-decora-brown font-medium hover:underline">← Kembali</a>
    </div>

    <div class="bg-white border border-decora-cream-dark rounded-xl p-5 mb-5 text-sm space-y-1">
        <p><span class="text-decora-text/50">User:</span> {{ $pesanan->user->nama }} ({{ $pesanan->user->email }})</p>
        <p><span class="text-decora-text/50">Alamat Pengiriman:</span> {{ $pesanan->alamat_pengiriman }}</p>
        <p><span class="text-decora-text/50">No. Telepon:</span> {{ $pesanan->no_telepon }}</p>
        <p><span class="text-decora-text/50">Metode Pembayaran:</span> {{ $pesanan->metode_pembayaran }}</p>
        <p><span class="text-decora-text/50">Tanggal:</span> {{ $pesanan->created_at->format('d/m/Y H:i') }}</p>
    </div>

    <div class="bg-white border border-decora-cream-dark rounded-xl overflow-hidden mb-5">
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

    <div class="bg-white border border-decora-cream-dark rounded-xl p-5">
        <form method="POST" action="{{ route('admin.pesanan.updateStatus', $pesanan->id) }}" class="flex items-end gap-3">
            @csrf
            @method('PATCH')
            <div>
                <x-input-label value="Ubah Status Pesanan" />
                <select name="status_pesanan" class="border-decora-cream-dark rounded-lg focus:border-decora-sage focus:ring-decora-sage">
                    @foreach (['menunggu', 'diproses', 'dikemas', 'dikirim', 'selesai', 'dibatalkan'] as $status)
                        <option value="{{ $status }}" {{ $pesanan->status_pesanan === $status ? 'selected' : '' }}>{{ ucfirst($status) }}</option>
                    @endforeach
                </select>
            </div>
            <x-button type="submit" variant="primary">Simpan</x-button>
        </form>
    </div>

</x-admin-layout>