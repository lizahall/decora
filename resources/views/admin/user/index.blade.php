<x-admin-layout title="Data User">

    <div class="flex items-center justify-between mb-4">
        <h1 class="text-xl font-bold">Data User</h1>
        <form method="GET" class="flex gap-2">
            <input type="text" name="cari" value="{{ request('cari') }}" placeholder="Cari nama/email..."
                   class="border border-gray-400 rounded-sm px-3 py-2 text-sm">
            <button type="submit" class="px-4 py-2 border border-gray-400 rounded-sm text-sm bg-gray-50">Cari</button>
        </form>
    </div>

    @if (session('success'))
        <div class="mb-4 text-sm text-green-700 bg-green-50 border border-green-200 rounded p-2">{{ session('success') }}</div>
    @endif

    <table class="w-full border border-gray-400 bg-white text-sm">
        <thead>
            <tr class="border-b border-gray-400 bg-gray-50">
                <th class="border-r border-gray-300 px-3 py-2 text-left">Nama</th>
                <th class="border-r border-gray-300 px-3 py-2 text-left">Email</th>
                <th class="border-r border-gray-300 px-3 py-2 text-left">No. Telepon</th>
                <th class="border-r border-gray-300 px-3 py-2 text-left">Terdaftar</th>
                <th class="px-3 py-2 text-left">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($users as $user)
                <tr class="border-b border-gray-300">
                    <td class="border-r border-gray-300 px-3 py-2">{{ $user->nama }}</td>
                    <td class="border-r border-gray-300 px-3 py-2">{{ $user->email }}</td>
                    <td class="border-r border-gray-300 px-3 py-2">{{ $user->no_telepon ?? '-' }}</td>
                    <td class="border-r border-gray-300 px-3 py-2">{{ $user->created_at->format('d/m/Y') }}</td>
                    <td class="px-3 py-2">
                        <form action="{{ route('admin.user.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Hapus user ini? Semua data pesanan & keranjangnya ikut terhapus.')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="px-3 py-6 text-center text-gray-500">Belum ada user terdaftar.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-4">{{ $users->links() }}</div>

</x-admin-layout>