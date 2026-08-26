<x-admin-layout title="Detail Pesanan">

    <div class="flex items-center justify-between mb-4">
        <h1 class="text-xl font-bold">Detail Pesanan #{{ $pesanan->id }}</h1>
        <a href="{{ route('admin.pesanan.index') }}" class="text-sm text-blue-600">Kembali</a>
    </div>

    @if (session('success'))
        <div class="mb-4 text-sm text-green-700 bg-green-50 border border-green-200 rounded p-2">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white border border-gray-300 rounded p-4 mb-4 text-sm space-y-1">
        <p><span class="text-gray-500">User:</span> {{ $pesanan->user->nama }} ({{ $pesanan->user->email }})</p>
        <p><span class="text-gray-500">Alamat Pengiriman:</span> {{ $pesanan->alamat_pengiriman }}</p>
        <p><span class="text-gray-500">No. Telepon:</span> {{ $pesanan->no_telepon }}</p>
        <p><span class="text-gray-500">Metode Pembayaran:</span> {{ $pesanan->metode_pembayaran }}</p>
        <p><span class="text-gray-500">Tanggal:</span> {{ $pesanan->created_at->format('d/m/Y H:i') }}</p>
    </div>

    <div class="bg-white border border-gray-300 rounded mb-4">
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

    <div class="bg-white border border-gray-300 rounded p-4">
        <form method="POST" action="{{ route('admin.pesanan.updateStatus', $pesanan->id) }}" class="flex items-end gap-3">
            @csrf
            @method('PATCH')
            <div>
                <label class="block text-sm font-medium mb-1">Ubah Status Pesanan</label>
                <select name="status_pesanan" class="border border-gray-400 rounded-sm px-3 py-2">
                    @foreach (['menunggu', 'diproses', 'dikemas', 'dikirim', 'selesai', 'dibatalkan'] as $status)
                        <option value="{{ $status }}" {{ $pesanan->status_pesanan === $status ? 'selected' : '' }}>{{ ucfirst($status) }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="bg-green-200 border border-gray-400 px-6 py-2 rounded-sm font-semibold">
                Simpan
            </button>
        </form>
    </div>

</x-admin-layout>