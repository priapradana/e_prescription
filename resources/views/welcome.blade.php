<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem E-Prescription Apotek</title>
    @vite('resources/css/app.css')
</head>

@php
    $bg = asset('img/photos/welcome2.jpg');
@endphp

<body class="relative min-h-screen bg-cover bg-center bg-no-repeat" style="background-image: url('{{ $bg }}')">

    {{-- Overlay transparan --}}
    <div class="absolute inset-0 bg-black bg-opacity-60 z-0"></div>

    {{-- Konten Login --}}
    <div class="relative z-10 min-h-screen flex items-center justify-center px-4">
        <div class="bg-white bg-opacity-95 backdrop-blur-md rounded-lg shadow-xl px-6 py-8 w-full max-w-md">

            <h1 class="text-2xl font-bold text-primary text-center mb-1">Sipatex</h1>
            <p class="text-sm text-gray-600 text-center mb-4">E‑Prescription</p>

            <form method="POST" action="{{ route('login') }}" class="space-y-4">
                @csrf

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input id="email" name="email" type="email" required autofocus
                           class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input id="password" name="password" type="password" required
                           class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
                </div>

                {{-- Tombol Login --}}
                <div>
                    <button class="w-full px-4 py-2 bg-primary hover:bg-primary-dark text-white font-semibold rounded-md transition">
                        Login
                    </button>
                </div>
            </form>

            {{-- Error Message --}}
            @if ($errors->any())
                <div class="mt-4 text-sm text-red-600 text-center">
                    {{ $errors->first() }}
                </div>
            @endif

            <div class="mt-6 text-xs text-center text-gray-400">
                &copy; {{ date('Y') }} Sistem Apotek Digital.
            </div>

        </div>
    </div>
</body>
</html>
