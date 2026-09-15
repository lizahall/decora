@extends('layouts.admin')

@section('title', 'Data Produk')

@section('content')

    <div class="flex items-center justify-between mb-5">
        <h1 class="text-xl font-bold text-decora-text">Data Produk</h1>
        <x-button variant="primary" onclick="window.location='{{ route('admin.produk.create') }}'">
            + Tambah Produk
        </x-button>
    </div>

    <div class="bg-white rounded-xl border border-decora-cream-dark overflow-hidden">
        <table class="w-full text-sm">
            <thead>
                <tr class="bg-decora-cream text-decora-text/70 text-left">
                    <th class="px-4 py-3 font-medium">Foto</th>
                    <th class="px-4 py-3 font-medium">Nama Produk</th>
                    <th class="px-4 py-3 font-medium">Kategori</th>
                    <th class="px-4 py-3 font-medium">Harga</th>
                    <th class="px-4 py-3 font-medium">Stok</th>
                    <th class="px-4 py-3 font-medium">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-decora-cream-dark">
                @forelse ($produk as $item)
                    <tr class="hover:bg-decora-cream/40">
                        <td class="px-4 py-3">
                            <img src="{{ $item->foto ? asset('storage/'.$item->foto) : 'https://placehold.co/48x48' }}" class="w-12 h-12 object-cover rounded-lg">
                        </td>
                        <td class="px-4 py-3 font-medium text-decora-text">{{ $item->nama }}</td>
                        <td class="px-4 py-3 text-decora-text/70">{{ $item->kategori }}</td>
                        <td class="px-4 py-3 text-decora-text/70">Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
                        <td class="px-4 py-3 text-decora-text/70">{{ $item->stok }}</td>
                        <td class="px-4 py-3">
                            <div class="flex items-center gap-2">
                                <a href="{{ route('admin.produk.show', $item->id) }}" title="Detail"
                                   class="w-8 h-8 inline-flex items-center justify-center rounded-lg bg-decora-sage/30 text-decora-brown-dark hover:bg-decora-sage/50 transition">
                                    <i class="fas fa-search text-xs"></i>
                                </a>
                                <a href="{{ route('admin.produk.edit', $item->id) }}" title="Edit"
                                   class="w-8 h-8 inline-flex items-center justify-center rounded-lg bg-blue-100 text-blue-600 hover:bg-blue-200 transition">
                                    <i class="fas fa-pen text-xs"></i>
                                </a>
                                <form id="hapus-produk-{{ $item->id }}" action="{{ route('admin.produk.destroy', $item->id) }}" method="POST">
                                    @csrf @method('DELETE')
                                    <button type="button" onclick="konfirmasiHapus('hapus-produk-{{ $item->id }}', '{{ addslashes($item->nama) }}')" title="Hapus"
                                            class="w-8 h-8 inline-flex items-center justify-center rounded-lg bg-red-100 text-red-600 hover:bg-red-200 transition">
                                        <i class="fas fa-trash text-xs"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="px-4 py-10 text-center text-decora-text/50">Belum ada data produk.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">{{ $produk->links() }}</div>

@endsection