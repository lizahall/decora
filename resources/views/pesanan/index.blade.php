@extends('layouts.shop')

@section('title', 'Riwayat Pesanan')

@section('content')

    <div class="max-w-4xl mx-auto px-4 py-10">

        <h1 class="text-2xl font-bold text-decora-text mb-6">Riwayat Pesanan</h1>

        {{-- Tab Filter Status --}}
        <div class="flex flex-wrap gap-2 mb-6">
            @foreach ([
                '' => 'Semua',
                'menunggu' => 'Menunggu',
                'diproses' => 'Diproses',
                'dikirim' => 'Dikirim',
                'selesai' => 'Selesai',
                'dibatalkan' => 'Dibatalkan',
            ] as $value => $label)
                <a href="{{ route('pesanan.index', $value ? ['status' => $value] : []) }}"
                   class="px-4 py-1.5 rounded-full text-sm font-medium {{ request('status', '') === $value ? 'bg-decora-brown text-white' : 'bg-white border border-decora-cream-dark text-decora-text/70 hover:bg-decora-cream-dark' }}">
                    {{ $label }}
                </a>
            @endforeach
        </div>

        {{-- Daftar Pesanan --}}
        <div class="space-y-3">
            @forelse ($pesanan as $item)
                <a href="{{ route('pesanan.show', $item->id) }}"
                   class="flex items-center justify-between bg-white rounded-xl border border-decora-cream-dark p-4 hover:shadow-md transition">
                    <div>
                        <p class="font-semibold text-decora-text">Pesanan #{{ $item->id }}</p>
                        <p class="text-sm text-decora-text/50">{{ $item->created_at->translatedFormat('d F Y, H:i') }}</p>
                    </div>
                    <div class="text-right">
                        <p class="font-semibold text-decora-brown mb-1">Rp {{ number_format($item->total_harga, 0, ',', '.') }}</p>
                        <x-status-badge :status="$item->status_pesanan" />
                    </div>
                </a>
            @empty
                <div class="text-center py-16">
                    <p class="text-decora-text/60 mb-4">Belum ada pesanan{{ request('status') ? ' dengan status ini' : '' }}.</p>
                    <x-button variant="primary" onclick="window.location='{{ route('produk.index') }}'">Mulai Belanja</x-button>
                </div>
            @endforelse
        </div>

        <div class="mt-6">{{ $pesanan->links() }}</div>
    </div>

@endsection