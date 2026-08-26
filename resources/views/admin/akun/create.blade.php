<x-admin-layout title="Tambah Admin">

    <h1 class="text-xl font-bold mb-4">Tambah Akun Admin</h1>

    @if ($errors->any())
        <div class="mb-4 text-sm text-red-600 bg-red-50 border border-red-200 rounded p-2">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form method="POST" action="{{ route('admin.akun.store') }}" class="bg-white border border-gray-300 rounded p-6 max-w-lg space-y-4">
        @csrf

        <div>
            <label class="block text-sm font-medium mb-1">Nama</label>
            <input type="text" name="nama" value="{{ old('nama') }}" class="w-full border border-gray-400 rounded-sm px-3 py-2">
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Email</label>
            <input type="email" name="email" value="{{ old('email') }}" class="w-full border border-gray-400 rounded-sm px-3 py-2">
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Password</label>
            <input type="password" name="password" class="w-full border border-gray-400 rounded-sm px-3 py-2">
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Konfirmasi Password</label>
            <input type="password" name="password_confirmation" class="w-full border border-gray-400 rounded-sm px-3 py-2">
        </div>

        <div class="flex gap-3">
            <button type="submit" class="bg-green-200 border border-gray-400 px-6 py-2 rounded-sm font-semibold">Simpan</button>
            <a href="{{ route('admin.akun.index') }}" class="px-6 py-2 border border-gray-400 rounded-sm">Batal</a>
        </div>
    </form>

</x-admin-layout>