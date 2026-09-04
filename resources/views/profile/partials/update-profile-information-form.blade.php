<section>
    <header class="mb-6">
        <h2 class="text-lg font-semibold text-decora-text">Informasi Profil</h2>
        <p class="mt-1 text-sm text-decora-text/60">Perbarui foto, nama, dan informasi kontak akun kamu.</p>
    </header>

    <form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="space-y-5">
        @csrf
        @method('patch')

        {{-- Foto Profil --}}
        <div class="flex items-center gap-4">
            <div class="w-16 h-16 rounded-full overflow-hidden bg-decora-sage/40 flex items-center justify-center shrink-0">
                @if ($user->foto)
                    <img src="{{ asset('storage/'.$user->foto) }}" class="w-full h-full object-cover">
                @else
                    <span class="text-xl font-bold text-decora-brown-dark">{{ strtoupper(substr($user->nama, 0, 1)) }}</span>
                @endif
            </div>
            <div>
                <label class="block text-sm font-medium text-decora-text/70 mb-1">Foto Profil</label>
                <input type="file" name="foto" class="text-sm">
                <x-input-error class="mt-1" :messages="$errors->get('foto')" />
            </div>
        </div>

        <div>
            <x-input-label for="nama" value="Nama" />
            <x-text-input id="nama" name="nama" type="text" class="mt-1 block w-full" :value="old('nama', $user->nama)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('nama')" />
        </div>

        <div>
            <x-input-label for="email" value="Email" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <p class="text-sm mt-2 text-decora-text/70">
                    Email kamu belum diverifikasi.
                    <button form="send-verification" class="underline text-decora-brown">
                        Kirim ulang email verifikasi.
                    </button>
                </p>
                @if (session('status') === 'verification-link-sent')
                    <p class="mt-2 text-sm font-medium text-green-600">
                        Link verifikasi baru sudah dikirim ke email kamu.
                    </p>
                @endif
            @endif
        </div>

        <div>
            <x-input-label for="no_telepon" value="No. Telepon" />
            <x-text-input id="no_telepon" name="no_telepon" type="text" class="mt-1 block w-full" :value="old('no_telepon', $user->no_telepon)" autocomplete="tel" />
            <x-input-error class="mt-2" :messages="$errors->get('no_telepon')" />
        </div>

        <div>
            <x-input-label for="alamat" value="Alamat" />
            <textarea id="alamat" name="alamat" rows="3" class="mt-1 block w-full border-decora-cream-dark bg-decora-cream/40 rounded-lg focus:border-decora-sage focus:ring-decora-sage">{{ old('alamat', $user->alamat) }}</textarea>
            <x-input-error class="mt-2" :messages="$errors->get('alamat')" />
        </div>

        <div class="flex items-center gap-4 pt-2">
            <x-primary-button>Simpan</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p class="text-sm text-green-600 font-medium">Tersimpan.</p>
            @endif
        </div>
    </form>
</section>

<form id="send-verification" method="post" action="{{ route('verification.send') }}">
    @csrf
</form>