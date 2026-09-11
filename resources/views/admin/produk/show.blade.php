@extends('layouts.admin')

@section('title', 'Detail Produk')

@section('content')

    <h1 class="text-xl font-bold text-decora-text mb-5">Detail Produk</h1>

    <div class="bg-white border border-decora-cream-dark rounded-xl overflow-hidden max-w-2xl">
        <table class="w-full text-sm">
            <tbody class="divide-y divide-decora-cream-dark">
                <tr class="odd:bg-decora-cream/30">
                    <th class="text-left px-5 py-3 w-40 text-decora-text/50 font-medium">ID</th>
                    <td class="px-5 py-3 text-decora-text">{{ $produk->id }}</td>
                </tr>
                <tr class="odd:bg-decora-cream/30">
                    <th class="text-left px-5 py-3 text-decora-text/50 font-medium">Foto</th>
                    <td class="px-5 py-3">
                        <img src="{{ $produk->foto ? asset('storage/'.$produk->foto) : 'https://placehold.co/80x80' }}"
                             class="w-16 h-16 object-cover rounded-lg">
                    </td>
                </tr>
                <tr class="odd:bg-decora-cream/30">
                    <th class="text-left px-5 py-3 text-decora-text/50 font-medium">Nama Produk</th>
                    <td class="px-5 py-3 text-decora-text">{{ $produk->nama }}</td>
                </tr>
                <tr class="odd:bg-decora-cream/30">
                    <th class="text-left px-5 py-3 text-decora-text/50 font-medium">Kategori</th>
                    <td class="px-5 py-3 text-decora-text">{{ $produk->kategori }}</td>
                </tr>
                <tr class="odd:bg-decora-cream/30">
                    <th class="text-left px-5 py-3 text-decora-text/50 font-medium">Harga</th>
                    <td class="px-5 py-3 text-decora-text">Rp {{ number_format($produk->harga, 0, ',', '.') }}</td>
                </tr>
                <tr class="odd:bg-decora-cream/30">
                    <th class="text-left px-5 py-3 text-decora-text/50 font-medium">Stok</th>
                    <td class="px-5 py-3 text-decora-text">{{ $produk->stok }}</td>
                </tr>
                <tr class="odd:bg-decora-cream/30">
                    <th class="text-left px-5 py-3 text-decora-text/50 font-medium">Deskripsi</th>
                    <td class="px-5 py-3 text-decora-text">{{ $produk->deskripsi ?: '-' }}</td>
                </tr>
                <tr class="odd:bg-decora-cream/30">
                    <th class="text-left px-5 py-3 text-decora-text/50 font-medium">Dibuat Pada</th>
                    <td class="px-5 py-3 text-decora-text">{{ $produk->created_at->translatedFormat('d F Y, H:i') }}</td>
                </tr>
                <tr class="odd:bg-decora-cream/30">
                    <th class="text-left px-5 py-3 text-decora-text/50 font-medium">Diperbarui Pada</th>
                    <td class="px-5 py-3 text-decora-text">{{ $produk->updated_at->translatedFormat('d F Y, H:i') }}</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="flex items-center gap-3 mt-5">
        <a href="{{ route('admin.produk.index') }}" class="px-5 py-2 rounded-lg border border-decora-cream-dark text-decora-text/70 text-sm font-medium hover:bg-decora-cream-dark transition">
            ← Kembali
        </a>
        <a href="{{ route('admin.produk.edit', $produk->id) }}" class="px-5 py-2 rounded-lg bg-decora-brown text-white text-sm font-medium hover:bg-decora-brown-dark transition">
            Update
        </a>
    </div>

@endsection