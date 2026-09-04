<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'DECORA' }}</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-decora-cream min-h-screen flex flex-col font-sans text-decora-text">

    {{-- Navbar utama --}}
    <nav class="bg-white/90 backdrop-blur border-b border-decora-cream-dark sticky top-0 z-20">
        <div class="max-w-6xl mx-auto px-4 h-16 flex items-center justify-between gap-6">

            <a href="{{ route('home') }}" class="font-bold text-xl text-decora-brown tracking-wide shrink-0">
                DECORA<span class="text-decora-sage-dark">.</span>
            </a>

            <div class="hidden md:flex items-center gap-7 text-sm font-medium">
                <a href="{{ route('home') }}" class="pb-1 border-b-2 {{ request()->routeIs('home') ? 'border-decora-brown text-decora-brown' : 'border-transparent text-decora-text/70 hover:text-decora-brown' }}">Beranda</a>
                <a href="{{ route('produk.index') }}" class="pb-1 border-b-2 {{ request()->routeIs('produk.*') ? 'border-decora-brown text-decora-brown' : 'border-transparent text-decora-text/70 hover:text-decora-brown' }}">Katalog</a>
                <a href="{{ route('kontak.index') }}" class="pb-1 border-b-2 {{ request()->routeIs('kontak.*') ? 'border-decora-brown text-decora-brown' : 'border-transparent text-decora-text/70 hover:text-decora-brown' }}">Kontak</a>
            </div>

            {{-- Search bar --}}
            <form action="{{ route('produk.index') }}" method="GET" class="hidden sm:block flex-1 max-w-xs">
                <div class="relative">
                    <span class="absolute left-3 top-1/2 -translate-y-1/2 text-decora-text/40 text-sm">🔍</span>
                    <input
                        type="text"
                        name="cari"
                        value="{{ request('cari') }}"
                        placeholder="Cari produk..."
                        class="w-full pl-9 text-sm rounded-full border-decora-cream-dark bg-decora-cream focus:bg-white focus:ring-decora-sage focus:border-decora-sage"
                    >
                </div>
            </form>

            <div class="flex items-center gap-4 text-sm shrink-0">
                @auth
                    <a href="{{ route('keranjang.index') }}" class="relative text-decora-text/70 hover:text-decora-brown text-lg" title="Keranjang">
                        🛒
                        @php $jumlahKeranjang = auth()->user()->keranjang()->sum('jumlah'); @endphp
                        @if ($jumlahKeranjang > 0)
                            <span class="absolute -top-1.5 -right-2 bg-decora-brown text-white text-[10px] rounded-full w-4 h-4 flex items-center justify-center">{{ $jumlahKeranjang }}</span>
                        @endif
                    </a>

                    <div class="relative group">
                        <button class="w-8 h-8 rounded-full bg-decora-sage/40 flex items-center justify-center text-sm font-bold text-decora-brown-dark overflow-hidden">
                            @if (auth()->user()->foto)
                                <img src="{{ asset('storage/'.auth()->user()->foto) }}" class="w-full h-full object-cover">
                            @else
                                {{ strtoupper(substr(auth()->user()->nama, 0, 1)) }}
                            @endif
                        </button>
                        <div class="absolute right-0 top-full pt-2 w-44 hidden group-hover:block z-10">
                            <div class="bg-white border border-decora-cream-dark rounded-lg shadow-lg overflow-hidden">
                                <p class="px-4 py-2 text-xs text-decora-text/50 border-b border-decora-cream-dark">{{ auth()->user()->nama }}</p>
                                <a href="{{ route('pesanan.index') }}" class="block px-4 py-2 hover:bg-decora-cream text-sm">Riwayat Pesanan</a>
                                <a href="{{ route('profile.edit') }}" class="block px-4 py-2 hover:bg-decora-cream text-sm">Edit Profil</a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="w-full text-left px-4 py-2 hover:bg-decora-cream text-red-600 text-sm">Logout</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="text-decora-text/70 hover:text-decora-brown">Login</a>
                    <x-button variant="primary" class="!px-4 !py-1.5" onclick="window.location='{{ route('register') }}'">Daftar</x-button>
                @endauth
            </div>
        </div>
    </nav>

    <main class="flex-1">
        {{ $slot }}
    </main>

    <footer class="bg-decora-brown text-white mt-auto">
        <div class="max-w-6xl mx-auto px-4 py-6 flex flex-wrap items-center justify-center gap-x-10 gap-y-3 text-sm">
            <span>🛡️ Aman &amp; Terpercaya</span>
            <span>📦 Produk Berkualitas</span>
            <span>💳 Pembayaran Aman</span>
            <span>🚚 Gratis Ongkir</span>
        </div>
        <div class="text-center text-xs text-white/70 pb-4">
            &copy; {{ date('Y') }} DECORA — Furniture &amp; Dekorasi Rumah
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if (session('success'))
        <script>
            Swal.fire({
                toast: true, position: 'top-end', icon: 'success',
                title: @json(session('success')),
                showConfirmButton: false, timer: 3000, timerProgressBar: true,
            });
        </script>
    @endif
    @if (session('error'))
        <script>
            Swal.fire({
                toast: true, position: 'top-end', icon: 'error',
                title: @json(session('error')),
                showConfirmButton: false, timer: 3500, timerProgressBar: true,
            });
        </script>
    @endif

</body>
</html>