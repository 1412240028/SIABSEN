<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Detail Sesi Presensi</h2>
            @if ($sesiPresensi->status === 'OPEN')
                <form method="POST" action="{{ route('dosen.sesi_presensi.close', $sesiPresensi) }}" class="inline-flex">
                    @csrf
                    @method('PATCH')
                    <x-primary-button>Tutup Sesi</x-primary-button>
                </form>
            @endif
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 space-y-6">
                <div>
                    <h3 class="text-lg font-semibold text-gray-900">Jadwal</h3>
                    <p>{{ $sesiPresensi->jadwal->mataKuliah->nama }} - {{ $sesiPresensi->jadwal->kelas->nama_kelas }}</p>
                    <p class="text-sm text-gray-500">Dosen: {{ $sesiPresensi->jadwal->dosen->nama }}</p>
                    <p class="text-sm text-gray-500">Tanggal: {{ $sesiPresensi->tanggal->format('d M Y') }}</p>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="bg-gray-50 p-4 rounded-md">
                        <p class="text-sm font-semibold text-gray-700">Token</p>
                        <p class="mt-2 text-lg text-gray-900">{{ $sesiPresensi->token }}</p>
                    </div>
                    <div class="bg-gray-50 p-4 rounded-md">
                        <p class="text-sm font-semibold text-gray-700">Status</p>
                        <p class="mt-2 text-lg text-gray-900">{{ $sesiPresensi->status }}</p>
                    </div>
                </div>

                @if ($sesiPresensi->status === 'OPEN')
                    <div class="bg-white border border-gray-200 p-6 rounded-md shadow-sm">
                        <p class="text-sm font-semibold text-gray-700">QR Code Presensi</p>
                        <div class="mt-4 flex justify-center">
                            @php
                                echo \SimpleSoftwareIO\QrCode\Facades\QrCode::size(220)->generate($sesiPresensi->token);
                            @endphp
                        </div>
                        <p class="mt-4 text-sm text-gray-500">Mahasiswa dapat memindai QR ini untuk melakukan presensi otomatis.</p>
                    </div>
                @endif

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="bg-gray-50 p-4 rounded-md">
                        <p class="text-sm font-semibold text-gray-700">Waktu Buka</p>
                        <p class="mt-2 text-gray-900">{{ $sesiPresensi->opened_at->format('d M Y H:i') }}</p>
                    </div>
                    <div class="bg-gray-50 p-4 rounded-md">
                        <p class="text-sm font-semibold text-gray-700">Waktu Tutup</p>
                        <p class="mt-2 text-gray-900">{{ $sesiPresensi->expired_at->format('d M Y H:i') }}</p>
                    </div>
                </div>

                <div class="bg-gray-50 p-4 rounded-md">
                    <p class="text-sm font-semibold text-gray-700">Daftar Presensi</p>
                    @if ($sesiPresensi->presensi->isEmpty())
                        <p class="mt-2 text-gray-500">Belum ada presensi.</p>
                    @else
                        <ul class="mt-2 space-y-2 text-sm text-gray-700">
                            @foreach ($sesiPresensi->presensi as $absen)
                                <li class="flex justify-between gap-4">
                                    <span>{{ $absen->mahasiswa->nama }}</span>
                                    <span>{{ $absen->status }} - {{ $absen->metode }}</span>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>

                @if ($sesiPresensi->status === 'OPEN')
                    <div class="bg-white border border-gray-200 p-6 rounded-md shadow-sm">
                        <h3 class="text-lg font-semibold text-gray-900">Presensi Manual</h3>
                        <p class="text-sm text-gray-500 mt-1">Catat kehadiran mahasiswa jika QR tidak digunakan.</p>
                        <form method="POST" action="{{ route('dosen.sesi_presensi.presensi.store', $sesiPresensi) }}" class="mt-4 space-y-4">
                            @csrf
                            <input type="hidden" name="sesi_presensi_id" value="{{ $sesiPresensi->id }}" />

                            <div>
                                <x-input-label for="mahasiswa_id" value="Mahasiswa" />
                                <select id="mahasiswa_id" name="mahasiswa_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                                    <option value="">Pilih mahasiswa</option>
                                    @foreach ($mahasiswa as $mhs)
                                        <option value="{{ $mhs->id }}" {{ old('mahasiswa_id') == $mhs->id ? 'selected' : '' }}>{{ $mhs->nim }} — {{ $mhs->nama }}</option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('mahasiswa_id')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="status" value="Status Kehadiran" />
                                <select id="status" name="status" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                                    <option value="HADIR">HADIR</option>
                                    <option value="TERLAMBAT">TERLAMBAT</option>
                                    <option value="IZIN">IZIN</option>
                                    <option value="SAKIT">SAKIT</option>
                                    <option value="ALPHA">ALPHA</option>
                                </select>
                                <x-input-error :messages="$errors->get('status')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="catatan" value="Catatan (opsional)" />
                                <x-text-input id="catatan" name="catatan" type="text" class="mt-1 block w-full" value="{{ old('catatan') }}" />
                                <x-input-error :messages="$errors->get('catatan')" class="mt-2" />
                            </div>

                            <input type="hidden" name="metode" value="MANUAL" />
                            <div class="flex justify-end gap-2">
                                <x-primary-button>Catat Manual</x-primary-button>
                            </div>
                        </form>
                    </div>
                @endif

                <div class="flex justify-end gap-2">
                    <a href="{{ route('dosen.sesi_presensi.index') }}" class="px-4 py-2 text-sm text-gray-600 hover:underline">Kembali</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
