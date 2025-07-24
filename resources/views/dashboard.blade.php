<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-primary leading-tight">
            Dashboard
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-6xl mx-auto px-4">
            {{-- Hero Section --}}
            <div class="bg-gradient-to-r from-green-100 via-blue-100 to-white rounded-xl shadow-md overflow-hidden mb-10">
                <div class="p-6 sm:flex sm:items-center sm:justify-between">
                    <div>
                        <h1 class="text-2xl sm:text-3xl font-bold text-primary mb-2 animate__animated animate__fadeInDown">
                            Selamat Datang di Sistem e-Prescription <span class="text-green-600">Sipatex</span>!
                        </h1>
                        <p class="text-sm sm:text-base text-gray-700">
                            Kelola resep, obat, dan data pasien dengan efisien dan cepat.
                        </p>
                    </div>
                    <img src="{{ asset('images/apotek_welcome.svg') }}" alt="Apotek" class="w-32 sm:w-40 md:w-48 animate__animated animate__zoomIn hidden sm:block">
                </div>
            </div>

            {{-- Stats or Quick Info --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white border-l-4 border-blue-500 rounded shadow p-4">
                    <div class="text-gray-700 font-semibold">Total Obat</div>
                    <div class="text-2xl font-bold text-blue-600 mt-1">{{ $totalObat }}</div>
                </div>
                <div class="bg-white border-l-4 border-green-500 rounded shadow p-4">
                    <div class="text-gray-700 font-semibold">Total Resep</div>
                    <div class="text-2xl font-bold text-green-600 mt-1">{{ $totalResep }}</div>
                </div>
                <div class="bg-white border-l-4 border-purple-500 rounded shadow p-4">
                    <div class="text-gray-700 font-semibold">Signa Tersedia</div>
                    <div class="text-2xl font-bold text-purple-600 mt-1">{{ $totalSigna }}</div>
                </div>
            </div>


            {{-- Footer Note --}}
            <div class="mt-10 text-center text-sm text-gray-500 italic">
                Sistem ini dibuat untuk mendukung proses digitalisasi pelayanan resep di Klinik Sipatex.
            </div>
        </div>
    </div>
</x-app-layout>
