<x-admin-layout title="Dashboard">

    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-6">
        <div class="bg-white border border-decora-cream-dark rounded-xl p-5">
            <p class="text-sm text-decora-text/50 mb-1">Total Produk</p>
            <p class="text-2xl font-bold text-decora-text">{{ \App\Models\Produk::count() }}</p>
        </div>
        <div class="bg-white border border-decora-cream-dark rounded-xl p-5">
            <p class="text-sm text-decora-text/50 mb-1">Total User Terdaftar</p>
            <p class="text-2xl font-bold text-decora-text">{{ \App\Models\User::count() }}</p>
        </div>
        <div class="bg-white border border-decora-cream-dark rounded-xl p-5">
            <p class="text-sm text-decora-text/50 mb-1">Total Pesanan</p>
            <p class="text-2xl font-bold text-decora-text">{{ \App\Models\Pesanan::count() }}</p>
        </div>
    </div>

    <div class="bg-white border border-decora-cream-dark rounded-xl p-5">
        <p class="text-decora-text/70">Selamat datang, <span class="font-semibold text-decora-text">{{ auth()->guard('admin')->user()->nama }}</span>. Gunakan menu di samping untuk mengelola data DECORA.</p>
    </div>

</x-admin-layout>