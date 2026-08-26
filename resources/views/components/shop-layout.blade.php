<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'DECORA' }}</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-50 min-h-screen flex flex-col">

    <nav class="bg-white border-b border-gray-300">
        <div class="max-w-6xl mx-auto px-4 h-16 flex items-center justify-between">
            <a href="{{ route('home') }}" class="font-bold text-lg">DECORA</a>

            <div class="hidden sm:flex items-center gap-6 text-sm">
                <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'font-semibold' : 'text-gray-600' }}">Beranda</a>
                <a href="{{ route('produk.index') }}" class="{{ request()->routeIs('produk.*') ? 'font-semibold' : 'text-gray-600' }}">Katalog</a>
            </div>

            <div class="flex items-center gap-4 text-sm">
                @auth
                    <a href="{{ route('keranjang.index') }}" class="relative text-gray-600">
                        Keranjang
                        @php $jumlahKeranjang = auth()->user()->keranjang()->sum('jumlah'); @endphp
                        @if ($jumlahKeranjang > 0)
                            <span class="absolute -top-2 -right-3 bg-red-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center">{{ $jumlahKeranjang }}</span>
                        @endif
                    </a>
                    <a href="{{ route('pesanan.index') }}" class="text-gray-600">Riwayat Pesanan</a>

                    <div class="relative group">
                        <button class="font-medium">{{ auth()->user()->nama }} ▾</button>
                        <div class="absolute right-0 mt-1 w-40 bg-white border border-gray-300 rounded shadow-sm hidden group-hover:block z-10">
                            <a href="{{ route('profile.edit') }}" class="block px-4 py-2 hover:bg-gray-50">Edit Profil</a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full text-left px-4 py-2 hover:bg-gray-50 text-red-600">Logout</button>
                            </form>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="text-gray-600">Login</a>
                    <a href="{{ route('register') }}" class="font-semibold">Daftar</a>
                @endauth
            </div>
        </div>
    </nav>

    <main class="flex-1">
        {{ $slot }}
    </main>

    <footer class="bg-white border-t border-gray-300 py-4 text-center text-xs text-gray-500">
        &copy; {{ date('Y') }} DECORA — Furniture & Dekorasi Rumah
    </footer>

</body>
</html>