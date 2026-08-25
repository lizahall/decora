<x-admin-layout title="Tambah Produk">

    <h1 class="text-xl font-bold mb-4">Tambah Produk</h1>

    @if ($errors->any())
        <div class="mb-4 text-sm text-red-600 bg-red-50 border border-red-200 rounded p-2">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form method="POST" action="{{ route('admin.produk.store') }}" enctype="multipart/form-data" class="bg-white border border-gray-300 rounded p-6 max-w-lg space-y-4">
        @csrf

        <div>
            <label class="block text-sm font-medium mb-1">Nama Produk</label>
            <input type="text" name="nama" value="{{ old('nama') }}" class="w-full border border-gray-400 rounded-sm px-3 py-2">
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Harga</label>
            <input type="number" name="harga" value="{{ old('harga') }}" class="w-full border border-gray-400 rounded-sm px-3 py-2">
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Stok</label>
            <input type="number" name="stok" value="{{ old('stok') }}" class="w-full border border-gray-400 rounded-sm px-3 py-2">
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Kategori</label>
            <input type="text" name="kategori" value="{{ old('kategori') }}" class="w-full border border-gray-400 rounded-sm px-3 py-2">
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Deskripsi</label>
            <textarea name="deskripsi" rows="4" class="w-full border border-gray-400 rounded-sm px-3 py-2">{{ old('deskripsi') }}</textarea>
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Foto Produk</label>
            <input type="file" name="foto" class="w-full">
        </div>

        <div class="flex gap-3">
            <button type="submit" class="bg-green-200 border border-gray-400 px-6 py-2 rounded-sm font-semibold">Simpan</button>
            <a href="{{ route('admin.produk.index') }}" class="px-6 py-2 border border-gray-400 rounded-sm">Batal</a>
        </div>
    </form>

</x-admin-layout>