<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Dashboard
        </h2>
    </x-slot>

    <div class="mt-8 px-6">
        <div class="bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 rounded-2xl shadow-lg p-8 text-white">
            <h1 class="text-3xl md:text-4xl font-extrabold mb-2">Selamat Datang di Dashboard PKL 👋</h1>
            <p class="text-lg md:text-xl font-light">
                Udah dapet tempat PKL? Langsung laporin di sini, biar datamu tercatat!!
            </p>
        </div>
    </div>

    <div class="py-10 px-6 max-w-7xl mx-auto">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            {{-- Jumlah Siswa PKL --}}
            <div class="bg-blue-100 p-6 rounded-lg shadow">
                <h3 class="text-lg font-semibold text-gray-700 mb-2">Siswa PKL</h3>
                <p class="text-3xl font-bold text-blue-700">{{ $jumlahSiswa }}</p>
            </div>

            {{-- Jumlah Industri --}}
            <div class="bg-green-100 p-6 rounded-lg shadow">
                <h3 class="text-lg font-semibold text-gray-700 mb-2">Industri Terdaftar</h3>
                <p class="text-3xl font-bold text-green-700">{{ $jumlahIndustri }}</p>
            </div>

            {{-- Jumlah Sudah Lapor PKL --}}
            <div class="bg-purple-100 p-6 rounded-lg shadow">
                <h3 class="text-lg font-semibold text-gray-700 mb-2">Sudah Lapor PKL</h3>
                <p class="text-3xl font-bold text-purple-700">{{ $jumlahSudahLapor }}</p>
            </div>
        </div>
    </div>
</x-app-layout>
