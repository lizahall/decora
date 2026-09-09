<x-admin-layout title="Edit Status Pesanan">

    <div class="flex items-center justify-between mb-5">
        <h1 class="text-xl font-bold text-decora-text">Edit Status Pesanan #{{ $pesanan->id }}</h1>
        <a href="{{ route('admin.pesanan.show', $pesanan->id) }}" class="text-sm text-decora-brown font-medium hover:underline">← Lihat Detail</a>
    </div>

    {{-- Ringkasan singkat buat konteks --}}
    <div class="bg-white border border-decora-cream-dark rounded-xl p-5 mb-5 text-sm space-y-1">
        <p><span class="text-decora-text/50">User:</span> {{ $pesanan->user->nama }}</p>
        <p><span class="text-decora-text/50">Total:</span> Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}</p>
        <p><span class="text-decora-text/50">Status saat ini:</span> <x-status-badge :status="$pesanan->status_pesanan" /></p>
    </div>

    <div class="bg-white border border-decora-cream-dark rounded-xl p-5">
        <form method="POST" action="{{ route('admin.pesanan.updateStatus', $pesanan->id) }}" class="flex items-end gap-3">
            @csrf
            @method('PATCH')
            <div class="flex-1 max-w-xs">
                <x-input-label value="Status Pesanan Baru" />
                <select name="status_pesanan" class="w-full border-decora-cream-dark rounded-lg focus:border-decora-sage focus:ring-decora-sage">
                    @foreach (['menunggu', 'diproses', 'dikemas', 'dikirim', 'selesai', 'dibatalkan'] as $status)
                        <option value="{{ $status }}" {{ $pesanan->status_pesanan === $status ? 'selected' : '' }}>{{ ucfirst($status) }}</option>
                    @endforeach
                </select>
            </div>
            <x-button type="submit" variant="primary">Simpan Perubahan</x-button>
        </form>
    </div>

</x-admin-layout>