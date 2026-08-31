<x-admin-layout title="Edit Produk">

    <h1 class="text-xl font-bold text-decora-text mb-5">Edit Produk</h1>

    @if ($errors->any())
        <div class="mb-4 text-sm text-red-600 bg-red-50 border border-red-200 rounded-lg p-3">
            @foreach ($errors->all() as $error)<p>{{ $error }}</p>@endforeach
        </div>
    @endif

    <form method="POST" action="{{ route('admin.produk.update', $produk->id) }}" enctype="multipart/form-data"
          class="bg-white border border-decora-cream-dark rounded-xl p-6 max-w-lg space-y-4">
        @csrf
        @method('PUT')

        @if ($produk->foto)
            <img src="{{ asset('storage/'.$produk->foto) }}" class="w-24 h-24 object-cover rounded-lg mb-2">
        @endif

        <div>
            <x-input-label value="Nama Produk" />
            <x-text-input type="text" name="nama" value="{{ old('nama', $produk->nama) }}" />
        </div>
        <div>
            <x-input-label value="Harga" />
            <x-text-input type="number" name="harga" value="{{ old('harga', $produk->harga) }}" />
        </div>
        <div>
            <x-input-label value="Stok" />
            <x-text-input type="number" name="stok" value="{{ old('stok', $produk->stok) }}" />
        </div>
        <div>
            <x-input-label value="Kategori" />
            <x-text-input type="text" name="kategori" value="{{ old('kategori', $produk->kategori) }}" />
        </div>
        <div>
            <x-input-label value="Deskripsi" />
            <textarea name="deskripsi" rows="4" class="w-full border-decora-cream-dark bg-decora-cream/40 rounded-lg focus:border-decora-sage focus:ring-decora-sage">{{ old('deskripsi', $produk->deskripsi) }}</textarea>
        </div>
        <div>
            <x-input-label value="Ganti Foto (opsional)" />
            <input type="file" name="foto" class="w-full text-sm">
        </div>

        <div class="flex gap-3 pt-2">
            <x-button type="submit" variant="primary">Update</x-button>
            <x-button variant="outline" onclick="window.location='{{ route('admin.produk.index') }}'">Batal</x-button>
        </div>
    </form>

</x-admin-layout>