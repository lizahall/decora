<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Admin' }} - DECORA</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-decora-cream font-sans text-decora-text">
    <div class="flex min-h-screen">

        {{-- Sidebar --}}
        <aside class="w-60 bg-decora-brown text-white flex flex-col shrink-0">
            <div class="h-16 flex items-center justify-center border-b border-white/10 font-bold text-lg tracking-wide">
                DECORA
            </div>
            <nav class="flex-1 py-4 text-sm space-y-1 px-3">
                @php
                    $menu = [
                        ['route' => 'admin.dashboard', 'active' => 'admin.dashboard', 'icon' => '📊', 'label' => 'Dashboard'],
                        ['route' => 'admin.produk.index', 'active' => 'admin.produk.*', 'icon' => '🛋️', 'label' => 'Produk'],
                        ['route' => 'admin.pesanan.index', 'active' => 'admin.pesanan.*', 'icon' => '📦', 'label' => 'Pesanan'],
                        ['route' => 'admin.user.index', 'active' => 'admin.user.*', 'icon' => '👥', 'label' => 'Data User'],
                        ['route' => 'admin.akun.index', 'active' => 'admin.akun.*', 'icon' => '🔑', 'label' => 'Data Admin'],
                        ['route' => 'admin.laporan.index', 'active' => 'admin.laporan.*', 'icon' => '📈', 'label' => 'Laporan Penjualan'],
                    ];
                @endphp
                @foreach ($menu as $item)
                    <a href="{{ route($item['route']) }}"
                       class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition {{ request()->routeIs($item['active']) ? 'bg-white text-decora-brown font-semibold' : 'text-white/80 hover:bg-white/10' }}">
                        <span>{{ $item['icon'] }}</span>
                        <span>{{ $item['label'] }}</span>
                    </a>
                @endforeach
            </nav>
        </aside>

        {{-- Main --}}
        <div class="flex-1 flex flex-col min-w-0">

            {{-- Topbar --}}
            <header class="h-16 bg-white border-b border-decora-cream-dark flex items-center justify-between px-6 shrink-0">
                <p class="font-semibold text-decora-text">{{ $title ?? 'Dashboard' }}</p>

                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-full bg-decora-sage flex items-center justify-center text-sm font-bold text-decora-brown-dark">
                        {{ strtoupper(substr(auth()->guard('admin')->user()->nama ?? 'A', 0, 1)) }}
                    </div>
                    <span class="text-sm font-medium">{{ auth()->guard('admin')->user()->nama ?? 'Admin' }}</span>
                    <form method="POST" action="{{ route('admin.logout') }}">
                        @csrf
                        <button class="text-sm text-red-600 font-medium ml-2">Logout</button>
                    </form>
                </div>
            </header>

            <main class="flex-1 p-6 overflow-x-auto">
                @if (session('success'))
                    <div class="mb-4 text-sm text-green-700 bg-green-50 border border-green-200 rounded-lg p-3">
                        {{ session('success') }}
                    </div>
                @endif
                @if (session('error'))
                    <div class="mb-4 text-sm text-red-600 bg-red-50 border border-red-200 rounded-lg p-3">
                        {{ session('error') }}
                    </div>
                @endif

                {{ $slot }}
            </main>
        </div>
    </div>
</body>
</html>