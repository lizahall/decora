<x-admin-layout title="Dashboard">

    <h1 class="text-xl font-bold mb-6">Dashboard Admin</h1>

    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
        <div class="bg-white border border-gray-300 rounded p-4">
            <p class="text-sm text-gray-500">Total Produk</p>
            <p class="text-2xl font-bold">{{ \App\Models\Produk::count() }}</p>
        </div>
        <div class="bg-white border border-gray-300 rounded p-4">
            <p class="text-sm text-gray-500">Total User Terdaftar</p>
            <p class="text-2xl font-bold">{{ \App\Models\User::count() }}</p>
        </div>
        <div class="bg-white border border-gray-300 rounded p-4">
            <p class="text-sm text-gray-500">Total Pesanan</p>
            <p class="text-2xl font-bold">{{ \App\Models\Pesanan::count() }}</p>
        </div>
    </div>

    <p class="text-sm text-gray-500 mt-6">Selamat datang, Administrator. Gunakan menu di samping untuk mengelola data.</p>

</x-admin-layout>