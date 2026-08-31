<x-admin-layout title="Tambah Admin">

    <h1 class="text-xl font-bold text-decora-text mb-5">Tambah Akun Admin</h1>

    @if ($errors->any())
        <div class="mb-4 text-sm text-red-600 bg-red-50 border border-red-200 rounded-lg p-3">
            @foreach ($errors->all() as $error)<p>{{ $error }}</p>@endforeach
        </div>
    @endif

    <form method="POST" action="{{ route('admin.akun.store') }}" class="bg-white border border-decora-cream-dark rounded-xl p-6 max-w-lg space-y-4">
        @csrf
        <div>
            <x-input-label value="Nama" />
            <x-text-input type="text" name="nama" value="{{ old('nama') }}" />
        </div>
        <div>
            <x-input-label value="Email" />
            <x-text-input type="email" name="email" value="{{ old('email') }}" />
        </div>
        <div>
            <x-input-label value="Password" />
            <x-text-input type="password" name="password" />
        </div>
        <div>
            <x-input-label value="Konfirmasi Password" />
            <x-text-input type="password" name="password_confirmation" />
        </div>
        <div class="flex gap-3 pt-2">
            <x-button type="submit" variant="primary">Simpan</x-button>
            <x-button variant="outline" onclick="window.location='{{ route('admin.akun.index') }}'">Batal</x-button>
        </div>
    </form>

</x-admin-layout>