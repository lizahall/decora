<x-admin-layout title="Detail User">

    <div class="flex items-center justify-between mb-5">
        <h1 class="text-xl font-bold text-decora-text">Detail User</h1>
        <a href="{{ route('admin.user.index') }}" class="text-sm text-decora-brown font-medium hover:underline">← Kembali</a>
    </div>

    <div class="bg-white border border-decora-cream-dark rounded-2xl p-6 sm:p-8 max-w-xl">
        <div class="flex items-center gap-4 mb-6">
            <div class="w-16 h-16 rounded-full overflow-hidden bg-decora-sage/40 flex items-center justify-center shrink-0">
                @if ($user->foto)
                    <img src="{{ asset('storage/'.$user->foto) }}" class="w-full h-full object-cover">
                @else
                    <span class="text-xl font-bold text-decora-brown-dark">{{ strtoupper(substr($user->nama, 0, 1)) }}</span>
                @endif
            </div>
            <div>
                <h2 class="text-lg font-bold text-decora-text">{{ $user->nama }}</h2>
                <p class="text-sm text-decora-text/60">{{ $user->email }}</p>
            </div>
        </div>

        <dl class="divide-y divide-decora-cream-dark text-sm">
            <div class="flex justify-between py-3">
                <dt class="text-decora-text/50">No. Telepon</dt>
                <dd class="text-decora-text font-medium">{{ $user->no_telepon ?: '-' }}</dd>
            </div>
            <div class="py-3">
                <dt class="text-decora-text/50 mb-1">Alamat</dt>
                <dd class="text-decora-text">{{ $user->alamat ?: '-' }}</dd>
            </div>
            <div class="flex justify-between py-3">
                <dt class="text-decora-text/50">Terdaftar Pada</dt>
                <dd class="text-decora-text">{{ $user->created_at->translatedFormat('d F Y, H:i') }}</dd>
            </div>
            <div class="flex justify-between py-3">
                <dt class="text-decora-text/50">Total Pesanan</dt>
                <dd class="text-decora-text">{{ $user->pesanan()->count() }}</dd>
            </div>
        </dl>
    </div>

</x-admin-layout>