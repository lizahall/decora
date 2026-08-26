<x-admin-layout title="Data Admin">

    <div class="flex items-center justify-between mb-4">
        <h1 class="text-xl font-bold">Data Admin</h1>
        <a href="{{ route('admin.akun.create') }}" class="bg-green-200 border border-gray-400 px-4 py-2 rounded-sm text-sm font-semibold">
            + Tambah Admin
        </a>
    </div>

    @if (session('success'))
        <div class="mb-4 text-sm text-green-700 bg-green-50 border border-green-200 rounded p-2">{{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div class="mb-4 text-sm text-red-600 bg-red-50 border border-red-200 rounded p-2">{{ session('error') }}</div>
    @endif

    <table class="w-full border border-gray-400 bg-white text-sm">
        <thead>
            <tr class="border-b border-gray-400 bg-gray-50">
                <th class="border-r border-gray-300 px-3 py-2 text-left">Nama</th>
                <th class="border-r border-gray-300 px-3 py-2 text-left">Email</th>
                <th class="px-3 py-2 text-left">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($admins as $item)
                <tr class="border-b border-gray-300">
                    <td class="border-r border-gray-300 px-3 py-2">{{ $item->nama }}</td>
                    <td class="border-r border-gray-300 px-3 py-2">{{ $item->email }}</td>
                    <td class="px-3 py-2 space-x-2 whitespace-nowrap">
                        <a href="{{ route('admin.akun.edit', $item->id) }}" class="text-yellow-600">Edit</a>
                        <form action="{{ route('admin.akun.destroy', $item->id) }}" method="POST" class="inline" onsubmit="return confirm('Hapus akun admin ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="px-3 py-6 text-center text-gray-500">Belum ada akun admin.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-4">{{ $admins->links() }}</div>

</x-admin-layout>