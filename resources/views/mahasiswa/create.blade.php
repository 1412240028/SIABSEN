<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Tambah Mahasiswa</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form method="POST" action="{{ route('mahasiswa.store') }}">
                    @csrf

                    <div class="mb-4">
                        <x-input-label for="name" value="Nama" />
                        <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" value="{{ old('name') }}" required autofocus />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="email" value="Email" />
                        <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" value="{{ old('email') }}" required />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="password" value="Password" />
                        <x-text-input id="password" name="password" type="password" class="mt-1 block w-full" required />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="kelas_id" value="Kelas" />
                        <select id="kelas_id" name="kelas_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                            <option value="">Pilih kelas</option>
                            @foreach ($kelas as $item)
                                <option value="{{ $item->id }}" {{ old('kelas_id') == $item->id ? 'selected' : '' }}>{{ $item->nama_kelas }} - {{ $item->angkatan }}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('kelas_id')" class="mt-2" />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="nim" value="NIM" />
                        <x-text-input id="nim" name="nim" type="text" class="mt-1 block w-full" value="{{ old('nim') }}" required />
                        <x-input-error :messages="$errors->get('nim')" class="mt-2" />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="jenis_kelamin" value="Jenis Kelamin" />
                        <select id="jenis_kelamin" name="jenis_kelamin" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                            <option value="L" {{ old('jenis_kelamin') === 'L' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="P" {{ old('jenis_kelamin') === 'P' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                        <x-input-error :messages="$errors->get('jenis_kelamin')" class="mt-2" />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="tanggal_lahir" value="Tanggal Lahir" />
                        <x-text-input id="tanggal_lahir" name="tanggal_lahir" type="date" class="mt-1 block w-full" value="{{ old('tanggal_lahir') }}" />
                        <x-input-error :messages="$errors->get('tanggal_lahir')" class="mt-2" />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="no_hp" value="No. HP" />
                        <x-text-input id="no_hp" name="no_hp" type="text" class="mt-1 block w-full" value="{{ old('no_hp') }}" />
                        <x-input-error :messages="$errors->get('no_hp')" class="mt-2" />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="alamat" value="Alamat" />
                        <textarea id="alamat" name="alamat" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" rows="4">{{ old('alamat') }}</textarea>
                        <x-input-error :messages="$errors->get('alamat')" class="mt-2" />
                    </div>

                    <div class="mb-6">
                        <x-input-label for="angkatan" value="Angkatan" />
                        <x-text-input id="angkatan" name="angkatan" type="number" class="mt-1 block w-full" value="{{ old('angkatan', date('Y')) }}" required />
                        <x-input-error :messages="$errors->get('angkatan')" class="mt-2" />
                    </div>

                    <div class="flex justify-end gap-2">
                        <a href="{{ route('mahasiswa.index') }}" class="px-4 py-2 text-sm text-gray-600 hover:underline">Batal</a>
                        <x-primary-button>Simpan</x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
