<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Buat Sesi Presensi</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form method="POST" action="{{ route('dosen.sesi_presensi.store') }}">
                    @csrf

                    <div class="mb-4">
                        <x-input-label for="jadwal_id" value="Jadwal" />
                        <select id="jadwal_id" name="jadwal_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                            <option value="">Pilih jadwal</option>
                            @foreach ($jadwal as $item)
                                <option value="{{ $item->id }}" {{ old('jadwal_id') == $item->id ? 'selected' : '' }}>
                                    {{ $item->mataKuliah->nama }} - {{ $item->kelas->nama_kelas }} ({{ $item->hari }} {{ $item->jam_mulai }}-{{ $item->jam_selesai }})
                                </option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('jadwal_id')" class="mt-2" />
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <x-input-label for="pertemuan_ke" value="Pertemuan ke" />
                            <x-text-input id="pertemuan_ke" name="pertemuan_ke" type="number" class="mt-1 block w-full" value="{{ old('pertemuan_ke', 1) }}" required />
                            <x-input-error :messages="$errors->get('pertemuan_ke')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="tanggal" value="Tanggal" />
                            <x-text-input id="tanggal" name="tanggal" type="date" class="mt-1 block w-full" value="{{ old('tanggal') }}" required />
                            <x-input-error :messages="$errors->get('tanggal')" class="mt-2" />
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-4">
                        <div>
                            <x-input-label for="opened_at" value="Waktu Buka" />
                            <x-text-input id="opened_at" name="opened_at" type="datetime-local" class="mt-1 block w-full" value="{{ old('opened_at') }}" required />
                            <x-input-error :messages="$errors->get('opened_at')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="expired_at" value="Waktu Tutup" />
                            <x-text-input id="expired_at" name="expired_at" type="datetime-local" class="mt-1 block w-full" value="{{ old('expired_at') }}" required />
                            <x-input-error :messages="$errors->get('expired_at')" class="mt-2" />
                        </div>
                    </div>

                    <div class="flex justify-end gap-2 mt-6">
                        <a href="{{ route('dosen.sesi_presensi.index') }}" class="px-4 py-2 text-sm text-gray-600 hover:underline">Batal</a>
                        <x-primary-button>Buat Sesi</x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
