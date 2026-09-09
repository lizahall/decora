<x-admin-layout title="Detail Admin">

    <h1 class="text-xl font-bold text-decora-text mb-5">Detail Admin</h1>

    <div class="bg-white border border-decora-cream-dark rounded-xl overflow-hidden max-w-2xl">
        <table class="w-full text-sm">
            <tbody class="divide-y divide-decora-cream-dark">
                <tr class="odd:bg-decora-cream/30">
                    <th class="text-left px-5 py-3 w-40 text-decora-text/50 font-medium">ID</th>
                    <td class="px-5 py-3 text-decora-text">{{ $admin->id }}</td>
                </tr>
                <tr class="odd:bg-decora-cream/30">
                    <th class="text-left px-5 py-3 text-decora-text/50 font-medium">Nama</th>
                    <td class="px-5 py-3 text-decora-text">{{ $admin->nama }}</td>
                </tr>
                <tr class="odd:bg-decora-cream/30">
                    <th class="text-left px-5 py-3 text-decora-text/50 font-medium">Email</th>
                    <td class="px-5 py-3 text-decora-text">{{ $admin->email }}</td>
                </tr>
                <tr class="odd:bg-decora-cream/30">
                    <th class="text-left px-5 py-3 text-decora-text/50 font-medium">Dibuat Pada</th>
                    <td class="px-5 py-3 text-decora-text">{{ $admin->created_at->translatedFormat('d F Y, H:i') }}</td>
                </tr>
                <tr class="odd:bg-decora-cream/30">
                    <th class="text-left px-5 py-3 text-decora-text/50 font-medium">Diperbarui Pada</th>
                    <td class="px-5 py-3 text-decora-text">{{ $admin->updated_at->translatedFormat('d F Y, H:i') }}</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="flex items-center gap-3 mt-5">
        <a href="{{ route('admin.akun.index') }}" class="px-5 py-2 rounded-lg border border-decora-cream-dark text-decora-text/70 text-sm font-medium hover:bg-decora-cream-dark transition">
            ← Kembali
        </a>
        <a href="{{ route('admin.akun.edit', $admin->id) }}" class="px-5 py-2 rounded-lg bg-decora-brown text-white text-sm font-medium hover:bg-decora-brown-dark transition">
            Update
        </a>
    </div>

</x-admin-layout>