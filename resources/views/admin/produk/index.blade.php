<x-admin-layout title="Data Produk">

    <div class="flex items-center justify-between mb-4">
        <h1 class="text-xl font-bold">Data Produk</h1>
        <a href="{{ route('admin.produk.create') }}" class="bg-green-200 border border-gray-400 px-4 py-2 rounded-sm text-sm font-semibold">
            + Tambah Produk
        </a>
    </div>

    <table class="w-full border border-gray-400 bg-white text-sm">
        <thead>
            <tr class="border-b border-gray-400 bg-gray-50">
                <th class="border-r border-gray-300 px-3 py-2 text-left">Foto</th>
                <th class="border-r border-gray-300 px-3 py-2 text-left">Nama Produk</th>
                <th class="border-r border-gray-300 px-3 py-2 text-left">Kategori</th>
                <th class="border-r border-gray-300 px-3 py-2 text-left">Harga</th>
                <th class="border-r border-gray-300 px-3 py-2 text-left">Stok</th>
                <th class="px-3 py-2 text-left">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($produk as $item)
                <tr class="border-b border-gray-300">
                    <td class="border-r border-gray-300 px-3 py-2">
                        <img src="{{ $item->foto ? asset('storage/'.$item->foto) : 'https://placehold.co/60x60' }}" class="w-12 h-12 object-cover rounded">
                    </td>
                    <td class="border-r border-gray-300 px-3 py-2">{{ $item->nama }}</td>
                    <td class="border-r border-gray-300 px-3 py-2">{{ $item->kategori }}</td>
                    <td class="border-r border-gray-300 px-3 py-2">Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
                    <td class="border-r border-gray-300 px-3 py-2">{{ $item->stok }}</td>
                    <td class="px-3 py-2 space-x-2 whitespace-nowrap">
                        <a href="{{ route('produk.show', $item->id) }}" class="text-blue-600" target="_blank">Detail</a>
                        <a href="{{ route('admin.produk.edit', $item->id) }}" class="text-yellow-600">Edit</a>
                        <form action="{{ route('admin.produk.destroy', $item->id) }}" method="POST" class="inline" onsubmit="return confirm('Hapus produk ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="px-3 py-6 text-center text-gray-500">Belum ada data produk.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-4">{{ $produk->links() }}</div>

</x-admin-layout>