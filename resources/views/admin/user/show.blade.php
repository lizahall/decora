<x-admin-layout title="Detail User">

    <h1 class="text-xl font-bold text-decora-text mb-5">Detail User</h1>

    <div class="bg-white border border-decora-cream-dark rounded-xl overflow-hidden max-w-2xl">
        <table class="w-full text-sm">
            <tbody class="divide-y divide-decora-cream-dark">
                <tr class="odd:bg-decora-cream/30">
                    <th class="text-left px-5 py-3 w-40 text-decora-text/50 font-medium">ID</th>
                    <td class="px-5 py-3 text-decora-text">{{ $user->id }}</td>
                </tr>
                <tr class="odd:bg-decora-cream/30">
                    <th class="text-left px-5 py-3 text-decora-text/50 font-medium">Nama</th>
                    <td class="px-5 py-3 text-decora-text">{{ $user->nama }}</td>
                </tr>
                <tr class="odd:bg-decora-cream/30">
                    <th class="text-left px-5 py-3 text-decora-text/50 font-medium">Email</th>
                    <td class="px-5 py-3 text-decora-text">{{ $user->email }}</td>
                </tr>
                <tr class="odd:bg-decora-cream/30">
                    <th class="text-left px-5 py-3 text-decora-text/50 font-medium">No. Telepon</th>
                    <td class="px-5 py-3 text-decora-text">{{ $user->no_telepon ?: '-' }}</td>
                </tr>
                <tr class="odd:bg-decora-cream/30">
                    <th class="text-left px-5 py-3 text-decora-text/50 font-medium">Alamat</th>
                    <td class="px-5 py-3 text-decora-text">{{ $user->alamat ?: '-' }}</td>
                </tr>
                <tr class="odd:bg-decora-cream/30">
                    <th class="text-left px-5 py-3 text-decora-text/50 font-medium">Terdaftar Pada</th>
                    <td class="px-5 py-3 text-decora-text">{{ $user->created_at->translatedFormat('d F Y, H:i') }}</td>
                </tr>
                <tr class="odd:bg-decora-cream/30">
                    <th class="text-left px-5 py-3 text-decora-text/50 font-medium">Diperbarui Pada</th>
                    <td class="px-5 py-3 text-decora-text">{{ $user->updated_at->translatedFormat('d F Y, H:i') }}</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="flex items-center gap-3 mt-5">
        <a href="{{ route('admin.user.index') }}" class="px-5 py-2 rounded-lg border border-decora-cream-dark text-decora-text/70 text-sm font-medium hover:bg-decora-cream-dark transition">
            ← Kembali
        </a>

        <form id="hapus-user-{{ $user->id }}" action="{{ route('admin.user.destroy', $user->id) }}" method="POST">
            @csrf @method('DELETE')
            <button type="button" onclick="konfirmasiHapus('hapus-user-{{ $user->id }}', '{{ addslashes($user->nama) }}', '{{ addslashes($user->nama) }} beserta pesanan & keranjangnya akan dihapus permanen.')"
                    class="px-5 py-2 rounded-lg bg-red-500 text-white text-sm font-medium hover:bg-red-600 transition">
                Hapus
            </button>
        </form>
    </div>

</x-admin-layout>