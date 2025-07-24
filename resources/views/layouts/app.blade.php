<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'e-Prescription Sipatex' }}</title>
    <link rel="icon" type="image/png" href="{{ asset('img/logo/sipatex.png') }}">
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 text-gray-900 min-h-screen flex">

    {{-- Sidebar responsif --}}
    <aside id="sidebar" class="w-50 bg-blue-100 border-r shadow-sm transition-all duration-300 overflow-hidden">
        @include('layouts.partials.sidebar')
    </aside>

    {{-- Konten utama --}}
    <main class="flex-1 p-6">
        {{-- Navbar --}}
        @include('layouts.partials.navbar')

        {{-- Slot konten halaman --}}
        {{ $slot }}

        {{-- Footer --}}
        @include('layouts.partials.footer')
    </main>

</body>
</html>
