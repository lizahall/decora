<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>DECORA</title>
    @vite('resources/css/app.css')
</head>
<body class="font-sans text-decora-text antialiased">
    <div class="min-h-screen flex flex-col items-center justify-center bg-decora-cream px-4 py-10">

        <a href="{{ route('home') }}" class="font-bold text-2xl text-decora-brown tracking-wide mb-6">
            DECORA
        </a>

        <div class="w-full sm:max-w-md bg-white rounded-xl border border-decora-cream-dark shadow-sm px-8 py-8">
            {{ $slot }}
        </div>

        <a href="{{ route('home') }}" class="text-xs text-decora-text/50 hover:text-decora-brown mt-6">
            ← Kembali ke Beranda
        </a>
    </div>
</body>
</html>