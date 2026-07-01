<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit Mata Kuliah</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form method="POST" action="{{ route('mata_kuliah.update', $mataKuliah) }}">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <x-input-label for="kode" value="Kode Mata Kuliah" />
                        <x-text-input id="kode" name="kode" type="text" class="mt-1 block w-full" value="{{ old('kode', $mataKuliah->kode) }}" required autofocus />
                        <x-input-error :messages="$errors->get('kode')" class="mt-2" />
                    </div>
                    <div class="mb-4">
                        <x-input-label for="nama" value="Nama Mata Kuliah" />
                        <x-text-input id="nama" name="nama" type="text" class="mt-1 block w-full" value="{{ old('nama', $mataKuliah->nama) }}" required />
                        <x-input-error :messages="$errors->get('nama')" class="mt-2" />
                    </div>
                    <div class="mb-4">
                        <x-input-label for="sks" value="SKS" />
                        <x-text-input id="sks" name="sks" type="number" class="mt-1 block w-full" value="{{ old('sks', $mataKuliah->sks) }}" required />
                        <x-input-error :messages="$errors->get('sks')" class="mt-2" />
                    </div>
                    <div class="mb-6">
                        <x-input-label for="status" value="Status" />
                        <select id="status" name="status" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                            <option value="1" {{ old('status', $mataKuliah->status) == 1 ? 'selected' : '' }}>Aktif</option>
                            <option value="0" {{ old('status', $mataKuliah->status) == 0 ? 'selected' : '' }}>Nonaktif</option>
                        </select>
                        <x-input-error :messages="$errors->get('status')" class="mt-2" />
                    </div>
                    <div class="flex justify-end gap-2">
                        <a href="{{ route('mata_kuliah.index') }}" class="px-4 py-2 text-sm text-gray-600 hover:underline">Batal</a>
                        <x-primary-button>Update</x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>