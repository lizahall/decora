<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Admin' }} - DECORA</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100">
    <div class="flex min-h-screen">

        {{-- Sidebar --}}
        <aside class="w-56 bg-white border-r border-gray-300 flex flex-col">
            <div class="h-16 flex items-center justify-center border-b border-gray-300 font-bold text-lg">
                LOGO
            </div>
            <nav class="flex-1 py-4 text-sm">
                <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 hover:bg-gray-100 {{ request()->routeIs('admin.dashboard') ? 'bg-gray-100 font-semibold' : '' }}">Dashboard</a>
                <a href="{{ route('admin.produk.index') }}" class="block px-4 py-2 hover:bg-gray-100 {{ request()->routeIs('admin.produk.*') ? 'bg-gray-100 font-semibold' : '' }}">Data Produk</a>
                <a href="{{ route('admin.pesanan.index') }}" class="block px-4 py-2 hover:bg-gray-100 {{ request()->routeIs('admin.pesanan.*') ? 'bg-gray-100 font-semibold' : '' }}">Data Pesanan</a>
                <a href="{{ route('admin.user.index') }}" class="block px-4 py-2 hover:bg-gray-100 {{ request()->routeIs('admin.user.*') ? 'bg-gray-100 font-semibold' : '' }}">Data User</a>
                <a href="{{ route('admin.akun.index') }}" class="block px-4 py-2 hover:bg-gray-100 {{ request()->routeIs('admin.akun.*') ? 'bg-gray-100 font-semibold' : '' }}">Data Admin</a>
                <a href="{{ route('admin.laporan.index') }}" class="block px-4 py-2 hover:bg-gray-100 {{ request()->routeIs('admin.laporan.*') ? 'bg-gray-100 font-semibold' : '' }}">Laporan Penjualan</a>
            </nav>
        </aside>

        {{-- Main --}}
        <div class="flex-1 flex flex-col">

            {{-- Topbar --}}
            <header class="h-16 bg-white border-b border-gray-300 flex items-center justify-end px-6 gap-3">
                <div class="w-9 h-9 rounded-full bg-gray-300 flex items-center justify-center text-sm font-semibold">A</div>
                <span class="text-sm font-medium">Administrator</span>
                <form method="POST" action="{{ route('admin.logout') }}">
                    @csrf
                    <button class="text-sm text-red-600 ml-2">Logout</button>
                </form>
            </header>

            <main class="flex-1 p-6">
                @if (session('success'))
                    <div class="mb-4 text-sm text-green-700 bg-green-50 border border-green-200 rounded p-2">
                        {{ session('success') }}
                    </div>
                @endif

                {{ $slot }}
            </main>
        </div>
    </div>
</body>
</html>