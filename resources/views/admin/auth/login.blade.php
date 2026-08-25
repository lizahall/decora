<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Admin - DECORA</title>
    @vite('resources/css/app.css')
</head>
<body class="min-h-screen flex items-center justify-center" style="background-color: #FBF6EE;">

    <div class="w-full max-w-sm border border-gray-400 rounded-md overflow-hidden bg-white shadow-sm">

        {{-- Title bar --}}
        <div class="text-center font-bold py-3 border-b border-gray-400" style="background-color: #FBF6EE;">
            HALAMAN LOGIN ADMIN
        </div>

        <div class="p-6">

            {{-- Pesan error validasi (SEKENARIO GAGAL) --}}
            @if ($errors->any())
                <div class="mb-4 text-sm text-red-600 bg-red-50 border border-red-200 rounded p-2">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('admin.login.submit') }}">
                @csrf

                {{-- Email --}}
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input
                        id="email"
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        required
                        autofocus
                        class="w-full border border-gray-400 rounded-sm px-3 py-2 focus:outline-none focus:ring-2"
                        style="--tw-ring-color: #A8D5BA;"
                    >
                </div>

                {{-- Password --}}
                <div class="mb-6">
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                    <input
                        id="password"
                        type="password"
                        name="password"
                        required
                        class="w-full border border-gray-400 rounded-sm px-3 py-2 focus:outline-none focus:ring-2"
                        style="--tw-ring-color: #A8D5BA;"
                    >
                </div>

                {{-- Tombol Login --}}
                <div class="flex justify-center">
                    <button
                        type="submit"
                        class="px-10 py-2 rounded-sm font-semibold text-gray-800 border border-gray-400 hover:opacity-90 transition"
                        style="background-color: #C9E4CA;"
                    >
                        LOGIN
                    </button>
                </div>

            </form>
        </div>
    </div>

</body>
</html>