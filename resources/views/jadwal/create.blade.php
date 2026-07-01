<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Tambah Jadwal</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form method="POST" action="{{ route('admin.jadwal.store') }}">
                    @csrf

                    <div class="mb-4">
                        <x-input-label for="dosen_id" value="Dosen" />
                        <select id="dosen_id" name="dosen_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                            <option value="">Pilih dosen</option>
                            @foreach ($dosens as $dosen)
                                <option value="{{ $dosen->id }}" {{ old('dosen_id') == $dosen->id ? 'selected' : '' }}>{{ $dosen->nama }}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('dosen_id')" class="mt-2" />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="kelas_id" value="Kelas" />
                        <select id="kelas_id" name="kelas_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                            <option value="">Pilih kelas</option>
                            @foreach ($kelas as $kelasItem)
                                <option value="{{ $kelasItem->id }}" {{ old('kelas_id') == $kelasItem->id ? 'selected' : '' }}>{{ $kelasItem->nama_kelas }}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('kelas_id')" class="mt-2" />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="mata_kuliah_id" value="Mata Kuliah" />
                        <select id="mata_kuliah_id" name="mata_kuliah_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                            <option value="">Pilih mata kuliah</option>
                            @foreach ($mataKuliah as $mata)
                                <option value="{{ $mata->id }}" {{ old('mata_kuliah_id') == $mata->id ? 'selected' : '' }}>{{ $mata->nama }} ({{ $mata->kode }})</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('mata_kuliah_id')" class="mt-2" />
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <x-input-label for="semester" value="Semester" />
                            <select id="semester" name="semester" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                                <option value="Ganjil" {{ old('semester') == 'Ganjil' ? 'selected' : '' }}>Ganjil</option>
                                <option value="Genap" {{ old('semester') == 'Genap' ? 'selected' : '' }}>Genap</option>
                            </select>
                            <x-input-error :messages="$errors->get('semester')" class="mt-2" />
                        </div>
                        <div>
                            <x-input-label for="tahun_ajaran" value="Tahun Ajaran" />
                            <x-text-input id="tahun_ajaran" name="tahun_ajaran" type="text" class="mt-1 block w-full" value="{{ old('tahun_ajaran', date('Y') . '/' . (date('Y') + 1)) }}" required />
                            <x-input-error :messages="$errors->get('tahun_ajaran')" class="mt-2" />
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-4">
                        <div>
                            <x-input-label for="hari" value="Hari" />
                            <select id="hari" name="hari" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                                @foreach(['Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'] as $hari)
                                    <option value="{{ $hari }}" {{ old('hari') == $hari ? 'selected' : '' }}>{{ $hari }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('hari')" class="mt-2" />
                        </div>
                        <div>
                            <x-input-label for="ruangan" value="Ruangan" />
                            <x-text-input id="ruangan" name="ruangan" type="text" class="mt-1 block w-full" value="{{ old('ruangan') }}" />
                            <x-input-error :messages="$errors->get('ruangan')" class="mt-2" />
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-4">
                        <div>
                            <x-input-label for="jam_mulai" value="Jam Mulai" />
                            <x-text-input id="jam_mulai" name="jam_mulai" type="time" class="mt-1 block w-full" value="{{ old('jam_mulai') }}" required />
                            <x-input-error :messages="$errors->get('jam_mulai')" class="mt-2" />
                        </div>
                        <div>
                            <x-input-label for="jam_selesai" value="Jam Selesai" />
                            <x-text-input id="jam_selesai" name="jam_selesai" type="time" class="mt-1 block w-full" value="{{ old('jam_selesai') }}" required />
                            <x-input-error :messages="$errors->get('jam_selesai')" class="mt-2" />
                        </div>
                    </div>

                    <div class="mb-4 mt-4">
                        <x-input-label for="status" value="Status" />
                        <select id="status" name="status" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                            <option value="1" {{ old('status', '1') == '1' ? 'selected' : '' }}>Aktif</option>
                            <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Nonaktif</option>
                        </select>
                        <x-input-error :messages="$errors->get('status')" class="mt-2" />
                    </div>

                    <div class="flex justify-end gap-2 mt-6">
                        <a href="{{ route('admin.jadwal.index') }}" class="px-4 py-2 text-sm text-gray-600 hover:underline">Batal</a>
                        <x-primary-button>Simpan Jadwal</x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
