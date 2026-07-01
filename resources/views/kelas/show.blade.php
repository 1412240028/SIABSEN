<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Detail Kelas</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="grid gap-4 sm:grid-cols-2">
                    <div>
                        <p class="text-sm font-medium text-gray-500">Nama Kelas</p>
                        <p class="mt-2 text-gray-900">{{ $kelas->nama_kelas }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Angkatan</p>
                        <p class="mt-2 text-gray-900">{{ $kelas->angkatan }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Kapasitas</p>
                        <p class="mt-2 text-gray-900">{{ $kelas->kapasitas }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Status</p>
                        <p class="mt-2">
                            @if ($kelas->status)
                                <span class="px-2 py-1 bg-green-100 text-green-700 rounded text-xs">Aktif</span>
                            @else
                                <span class="px-2 py-1 bg-gray-100 text-gray-600 rounded text-xs">Nonaktif</span>
                            @endif
                        </p>
                    </div>
                </div>

                <div class="mt-6 flex justify-end gap-2">
                    <a href="{{ route('kelas.index') }}" class="px-4 py-2 text-sm text-gray-600 hover:underline">Kembali</a>
                    @if (auth()->user()->isAdmin())
                        <a href="{{ route('kelas.edit', $kelas) }}" class="px-4 py-2 bg-indigo-600 text-white rounded-md text-sm hover:bg-indigo-700">Edit</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
