<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Dashboard Administrator
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <p>Selamat datang, <strong>{{ auth()->user()->name }}</strong>!</p>
                    <p class="text-sm text-gray-500 mt-1">Anda login sebagai Administrator SIABSEN.</p>
                    <div class="mt-6 grid gap-4 md:grid-cols-2">
                        <a href="{{ route('admin.presensi.rekap') }}" class="block rounded-lg border border-gray-200 bg-white px-4 py-6 shadow-sm hover:border-gray-300">
                            <h3 class="text-lg font-semibold">Rekap Presensi</h3>
                            <p class="mt-2 text-sm text-gray-600">Lihat ringkasan kehadiran dan laporan presensi mahasiswa.</p>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>