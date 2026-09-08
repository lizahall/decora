<x-admin-layout title="Detail Admin">

    <div class="flex items-center justify-between mb-5">
        <h1 class="text-xl font-bold text-decora-text">Detail Admin</h1>
        <a href="{{ route('admin.akun.index') }}" class="text-sm text-decora-brown font-medium hover:underline">← Kembali</a>
    </div>

    <div class="bg-white border border-decora-cream-dark rounded-2xl p-6 sm:p-8 max-w-xl">
        <div class="flex items-center gap-4 mb-6">
            <div class="w-16 h-16 rounded-full bg-decora-sage/40 flex items-center justify-center text-xl font-bold text-decora-brown-dark shrink-0">
                {{ strtoupper(substr($admin->nama, 0, 1)) }}
            </div>
            <div>
                <h2 class="text-lg font-bold text-decora-text">{{ $admin->nama }}</h2>
                <p class="text-sm text-decora-text/60">{{ $admin->email }}</p>
            </div>
        </div>

        <dl class="divide-y divide-decora-cream-dark text-sm">
            <div class="flex justify-between py-3">
                <dt class="text-decora-text/50">Dibuat Pada</dt>
                <dd class="text-decora-text">{{ $admin->created_at->translatedFormat('d F Y, H:i') }}</dd>
            </div>
            <div class="flex justify-between py-3">
                <dt class="text-decora-text/50">Terakhir Diupdate</dt>
                <dd class="text-decora-text">{{ $admin->updated_at->translatedFormat('d F Y, H:i') }}</dd>
            </div>
        </dl>

        <div class="flex gap-3 mt-6 pt-6 border-t border-decora-cream-dark">
            <a href="{{ route('admin.akun.edit', $admin->id) }}" class="px-5 py-2 rounded-lg bg-decora-sage/40 text-decora-brown-dark font-medium text-sm hover:bg-decora-sage/60 transition">
                Edit Admin
            </a>
        </div>
    </div>

</x-admin-layout>