<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Admin - DECORA</title>
    @vite('resources/css/app.css')
</head>
<body class="font-sans antialiased">
    <div class="min-h-screen flex items-center justify-center bg-decora-cream px-4">

        <div class="w-full max-w-sm bg-white rounded-xl border border-decora-cream-dark shadow-sm overflow-hidden">

            <div class="bg-decora-brown text-white text-center py-5">
                <p class="font-bold text-xl tracking-wide">DECORA</p>
                <p class="text-xs text-white/70 mt-1">Panel Administrator</p>
            </div>

            <div class="p-8">
                @if ($errors->any())
                    <div class="mb-4 text-sm text-red-600 bg-red-50 border border-red-200 rounded-lg p-3">
                        @foreach ($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                @endif

                <form method="POST" action="{{ route('admin.login.submit') }}" class="space-y-4">
                    @csrf

                    <div>
                        <label for="email" class="block text-sm font-medium text-decora-text/70 mb-1">Email</label>
                        <input
                            id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                            class="w-full border-decora-cream-dark bg-decora-cream/40 rounded-lg focus:border-decora-sage focus:ring-decora-sage"
                        >
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-medium text-decora-text/70 mb-1">Password</label>
                        <input
                            id="password" type="password" name="password" required
                            class="w-full border-decora-cream-dark bg-decora-cream/40 rounded-lg focus:border-decora-sage focus:ring-decora-sage"
                        >
                    </div>

                    <button type="submit"
                            class="w-full py-2.5 bg-decora-brown text-white rounded-lg font-semibold hover:bg-decora-brown-dark transition">
                        Masuk
                    </button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>