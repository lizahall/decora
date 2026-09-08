<x-admin-layout title="Data User">

    <div class="flex items-center justify-between mb-5">
        <h1 class="text-xl font-bold text-decora-text">Data User</h1>
        <form method="GET" class="flex gap-2">
            <input type="text" name="cari" value="{{ request('cari') }}" placeholder="Cari nama/email..."
                   class="border-decora-cream-dark rounded-lg text-sm focus:border-decora-sage focus:ring-decora-sage">
            <x-button type="submit" variant="outline" class="!py-2">Cari</x-button>
        </form>
    </div>

    <div class="bg-white rounded-xl border border-decora-cream-dark overflow-hidden">
        <table class="w-full text-sm">
            <thead>
                <tr class="bg-decora-cream text-decora-text/70 text-left">
                    <th class="px-4 py-3 font-medium">Nama</th>
                    <th class="px-4 py-3 font-medium">Email</th>
                    <th class="px-4 py-3 font-medium">No. Telepon</th>
                    <th class="px-4 py-3 font-medium">Terdaftar</th>
                    <th class="px-4 py-3 font-medium">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-decora-cream-dark">
                @forelse ($users as $user)
                    <tr class="hover:bg-decora-cream/40">
                        <td class="px-4 py-3 font-medium text-decora-text">{{ $user->nama }}</td>
                        <td class="px-4 py-3 text-decora-text/70">{{ $user->email }}</td>
                        <td class="px-4 py-3 text-decora-text/70">{{ $user->no_telepon ?? '-' }}</td>
                        <td class="px-4 py-3 text-decora-text/70">{{ $user->created_at->format('d/m/Y') }}</td>
                        <td class="px-4 py-3 space-x-3 whitespace-nowrap">
                            <a href="{{ route('admin.user.show', $user->id) }}" class="text-decora-brown font-medium hover:underline">Detail</a>
                            <form action="{{ route('admin.user.destroy', $user->id) }}" method="POST" class="inline" onsubmit="return confirm('Hapus user ini beserta pesanan & keranjangnya?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-red-600 font-medium hover:underline">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="px-4 py-10 text-center text-decora-text/50">Belum ada user terdaftar.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">{{ $users->links() }}</div>

</x-admin-layout>