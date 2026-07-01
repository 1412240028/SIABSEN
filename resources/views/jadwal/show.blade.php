<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Detail Jadwal</h2>
            <a href="{{ route('admin.jadwal.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 text-white rounded-md text-sm hover:bg-gray-700">Kembali ke Jadwal</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 space-y-6">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <p class="text-sm font-semibold text-gray-600">Mata Kuliah</p>
                        <p class="mt-1 text-gray-900">{{ $jadwal->mataKuliah->nama }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-gray-600">Kode</p>
                        <p class="mt-1 text-gray-900">{{ $jadwal->mataKuliah->kode }}</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <p class="text-sm font-semibold text-gray-600">Dosen</p>
                        <p class="mt-1 text-gray-900">{{ $jadwal->dosen->nama }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-gray-600">Kelas</p>
                        <p class="mt-1 text-gray-900">{{ $jadwal->kelas->nama_kelas }}</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <p class="text-sm font-semibold text-gray-600">Semester</p>
                        <p class="mt-1 text-gray-900">{{ $jadwal->semester }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-gray-600">Tahun Ajaran</p>
                        <p class="mt-1 text-gray-900">{{ $jadwal->tahun_ajaran }}</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <p class="text-sm font-semibold text-gray-600">Hari</p>
                        <p class="mt-1 text-gray-900">{{ $jadwal->hari }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-gray-600">Jam</p>
                        <p class="mt-1 text-gray-900">{{ $jadwal->jam_mulai }} - {{ $jadwal->jam_selesai }}</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <p class="text-sm font-semibold text-gray-600">Ruangan</p>
                        <p class="mt-1 text-gray-900">{{ $jadwal->ruangan ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-gray-600">Status</p>
                        <p class="mt-1 text-gray-900">{{ $jadwal->status ? 'Aktif' : 'Nonaktif' }}</p>
                    </div>
                </div>

                <div class="flex justify-end gap-2">
                    <a href="{{ route('admin.jadwal.edit', $jadwal) }}" class="px-4 py-2 text-sm text-indigo-600 hover:underline">Edit</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
