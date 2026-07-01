<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Detail Mahasiswa</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="grid gap-4 sm:grid-cols-2">
                    <div>
                        <p class="text-sm font-medium text-gray-500">Nama</p>
                        <p class="mt-2 text-gray-900">{{ $mahasiswa->nama }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">NIM</p>
                        <p class="mt-2 text-gray-900">{{ $mahasiswa->nim }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Email</p>
                        <p class="mt-2 text-gray-900">{{ $mahasiswa->user->email }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Kelas</p>
                        <p class="mt-2 text-gray-900">{{ $mahasiswa->kelas->nama_kelas ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Angkatan</p>
                        <p class="mt-2 text-gray-900">{{ $mahasiswa->angkatan }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Jenis Kelamin</p>
                        <p class="mt-2 text-gray-900">{{ $mahasiswa->jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan' }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Tanggal Lahir</p>
                        <p class="mt-2 text-gray-900">{{ $mahasiswa->tanggal_lahir?->format('d M Y') ?? '-' }}</p>
                    </div>
                    <div class="sm:col-span-2">
                        <p class="text-sm font-medium text-gray-500">No. HP</p>
                        <p class="mt-2 text-gray-900">{{ $mahasiswa->no_hp ?? '-' }}</p>
                    </div>
                    <div class="sm:col-span-2">
                        <p class="text-sm font-medium text-gray-500">Alamat</p>
                        <p class="mt-2 text-gray-900">{{ $mahasiswa->alamat ?? '-' }}</p>
                    </div>
                </div>

                <div class="mt-6 flex justify-end gap-2">
                    <a href="{{ route('mahasiswa.index') }}" class="px-4 py-2 text-sm text-gray-600 hover:underline">Kembali</a>
                    @if (auth()->user()->isAdmin())
                        <a href="{{ route('mahasiswa.edit', $mahasiswa) }}" class="px-4 py-2 bg-indigo-600 text-white rounded-md text-sm hover:bg-indigo-700">Edit</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
