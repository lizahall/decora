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
                        <td class="px-4 py-3 space-x-3">
                            <a href="{{ route('admin.akun.show', $item->id) }}" class="text-decora-brown font-medium hover:underline">Detail</a>
                            <a href="{{ route('admin.akun.edit', $item->id) }}" class="text-blue-600 font-medium hover:underline">Edit</a>
                            <form id="hapus-akun-{{ $item->id }}" action="{{ route('admin.akun.destroy', $item->id) }}" method="POST" class="inline">
                                @csrf @method('DELETE')
                                <button type="button" onclick="konfirmasiHapus('hapus-akun-{{ $item->id }}', '{{ addslashes($item->nama) }}')" class="text-red-600 font-medium hover:underline">Hapus</button>
                            </form>
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