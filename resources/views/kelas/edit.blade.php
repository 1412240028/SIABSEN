<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit Kelas</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form method="POST" action="{{ route('kelas.update', $kelas) }}">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <x-input-label for="nama_kelas" value="Nama Kelas" />
                        <x-text-input id="nama_kelas" name="nama_kelas" type="text" class="mt-1 block w-full" value="{{ old('nama_kelas', $kelas->nama_kelas) }}" required autofocus />
                        <x-input-error :messages="$errors->get('nama_kelas')" class="mt-2" />
                    </div>
                    <div class="mb-4">
                        <x-input-label for="angkatan" value="Angkatan" />
                        <x-text-input id="angkatan" name="angkatan" type="number" class="mt-1 block w-full" value="{{ old('angkatan', $kelas->angkatan) }}" required />
                        <x-input-error :messages="$errors->get('angkatan')" class="mt-2" />
                    </div>
                    <div class="mb-4">
                        <x-input-label for="kapasitas" value="Kapasitas" />
                        <x-text-input id="kapasitas" name="kapasitas" type="number" class="mt-1 block w-full" value="{{ old('kapasitas', $kelas->kapasitas) }}" required />
                        <x-input-error :messages="$errors->get('kapasitas')" class="mt-2" />
                    </div>
                    <div class="mb-6">
                        <x-input-label for="status" value="Status" />
                        <select id="status" name="status" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                            <option value="1" {{ old('status', $kelas->status) == 1 ? 'selected' : '' }}>Aktif</option>
                            <option value="0" {{ old('status', $kelas->status) == 0 ? 'selected' : '' }}>Nonaktif</option>
                        </select>
                        <x-input-error :messages="$errors->get('status')" class="mt-2" />
                    </div>
                    <div class="flex justify-end gap-2">
                        <a href="{{ route('kelas.index') }}" class="px-4 py-2 text-sm text-gray-600 hover:underline">Batal</a>
                        <x-primary-button>Update</x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>