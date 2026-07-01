<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Detail Dosen</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="grid gap-4 sm:grid-cols-2">
                    <div>
                        <p class="text-sm font-medium text-gray-500">Nama</p>
                        <p class="mt-2 text-gray-900">{{ $dosen->nama }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">NIDN</p>
                        <p class="mt-2 text-gray-900">{{ $dosen->nidn }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Email</p>
                        <p class="mt-2 text-gray-900">{{ $dosen->user->email }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Jenis Kelamin</p>
                        <p class="mt-2 text-gray-900">{{ $dosen->jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan' }}</p>
                    </div>
                    <div class="sm:col-span-2">
                        <p class="text-sm font-medium text-gray-500">No. HP</p>
                        <p class="mt-2 text-gray-900">{{ $dosen->no_hp ?? '-' }}</p>
                    </div>
                    <div class="sm:col-span-2">
                        <p class="text-sm font-medium text-gray-500">Alamat</p>
                        <p class="mt-2 text-gray-900">{{ $dosen->alamat ?? '-' }}</p>
                    </div>
                </div>

                <div class="mt-6 flex justify-end gap-2">
                    <a href="{{ route('dosen.index') }}" class="px-4 py-2 text-sm text-gray-600 hover:underline">Kembali</a>
                    @if (auth()->user()->isAdmin())
                        <a href="{{ route('dosen.edit', $dosen) }}" class="px-4 py-2 bg-indigo-600 text-white rounded-md text-sm hover:bg-indigo-700">Edit</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
