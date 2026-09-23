@extends('layouts.admin')

@section('title', 'Data Admin')

@section('content')

    <div class="flex items-center justify-between mb-5">
        <h1 class="text-xl font-bold text-decora-text">Data Admin</h1>
        <x-button variant="primary" onclick="window.location='{{ route('admin.akun.create') }}'">+ Tambah Admin</x-button>
    </div>

    @if (session('error'))
        <div class="mb-4 text-sm text-red-600 bg-red-50 border border-red-200 rounded-lg p-3">{{ session('error') }}</div>
    @endif

    <div class="bg-white rounded-xl border border-decora-cream-dark overflow-hidden">
        <table class="w-full text-sm">
            <thead>
                <tr class="bg-decora-cream text-decora-text/70 text-left">
                    <th class="px-4 py-3 font-medium">Nama</th>
                    <th class="px-4 py-3 font-medium">Email</th>
                    <th class="px-4 py-3 font-medium">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-decora-cream-dark">
                @forelse ($admins as $item)
                    <tr class="hover:bg-decora-cream/40">
                        <td class="px-4 py-3 font-medium text-decora-text">{{ $item->nama }}</td>
                        <td class="px-4 py-3 text-decora-text/70">{{ $item->email }}</td>
                        <td class="px-4 py-3">
                            <div class="flex items-center gap-2">
                                <a href="{{ route('admin.akun.show', $item->id) }}" title="Detail"
                                   class="w-8 h-8 inline-flex items-center justify-center rounded-lg bg-decora-sage/30 text-decora-brown-dark hover:bg-decora-sage/50 transition">
                                    <i class="fas fa-search text-xs"></i>
                                </a>
                                <a href="{{ route('admin.akun.edit', $item->id) }}" title="Edit"
                                   class="w-8 h-8 inline-flex items-center justify-center rounded-lg bg-blue-100 text-blue-600 hover:bg-blue-200 transition">
                                    <i class="fas fa-edit text-xs"></i>
                                </a>
                                <form id="hapus-akun-{{ $item->id }}" action="{{ route('admin.akun.destroy', $item->id) }}" method="POST">
                                    @csrf @method('DELETE')
                                    <button type="button" onclick="konfirmasiHapus('hapus-akun-{{ $item->id }}', '{{ addslashes($item->nama) }}')" title="Hapus"
                                            class="w-8 h-8 inline-flex items-center justify-center rounded-lg bg-red-100 text-red-600 hover:bg-red-200 transition">
                                        <i class="fas fa-trash text-xs"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="3" class="px-4 py-10 text-center text-decora-text/50">Belum ada akun admin.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">{{ $admins->links() }}</div>

@endsection