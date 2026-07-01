<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Detail Sesi Presensi</h2>
                <p class="mt-1 text-sm text-gray-500">{{ $sesiPresensi->jadwal->mataKuliah->nama }} - {{ $sesiPresensi->jadwal->kelas->nama_kelas }}</p>
            </div>
            <div class="flex flex-wrap gap-2">
                @if ($sesiPresensi->status === 'OPEN')
                    <form method="POST" action="{{ route('dosen.sesi_presensi.close', $sesiPresensi) }}" class="inline-flex">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="inline-flex items-center justify-center rounded-md bg-gray-900 px-4 py-2 text-sm font-medium text-white hover:bg-gray-800">
                            Tutup Sesi
                        </button>
                    </form>
                @endif

                @if ($sesiPresensi->status === 'CLOSED' && $belumPresensi->isNotEmpty())
                    <form method="POST" action="{{ route('dosen.sesi_presensi.mark-alpha', $sesiPresensi) }}" class="inline-flex" onsubmit="return confirm('Tandai semua mahasiswa yang belum presensi sebagai Alpha?')">
                        @csrf
                        <button type="submit" class="inline-flex items-center justify-center rounded-md bg-red-600 px-4 py-2 text-sm font-medium text-white hover:bg-red-700">
                            Tandai Alpha
                        </button>
                    </form>
                @endif
            </div>
        </div>
    </x-slot>

    @php
        $statusCards = [
            ['key' => 'HADIR', 'label' => 'Hadir', 'class' => 'border-green-200 bg-green-50 text-green-700'],
            ['key' => 'TERLAMBAT', 'label' => 'Terlambat', 'class' => 'border-amber-200 bg-amber-50 text-amber-700'],
            ['key' => 'IZIN', 'label' => 'Izin', 'class' => 'border-blue-200 bg-blue-50 text-blue-700'],
            ['key' => 'SAKIT', 'label' => 'Sakit', 'class' => 'border-orange-200 bg-orange-50 text-orange-700'],
            ['key' => 'ALPHA', 'label' => 'Alpha', 'class' => 'border-red-200 bg-red-50 text-red-700'],
        ];

        $badgeClasses = [
            'HADIR' => 'bg-green-100 text-green-800',
            'TERLAMBAT' => 'bg-amber-100 text-amber-800',
            'IZIN' => 'bg-blue-100 text-blue-800',
            'SAKIT' => 'bg-orange-100 text-orange-800',
            'ALPHA' => 'bg-red-100 text-red-800',
        ];
    @endphp

    <div class="py-10">
        <div class="max-w-7xl mx-auto space-y-6 px-4 sm:px-6 lg:px-8">
            @if ($errors->any())
                <div class="rounded-lg border border-red-200 bg-red-50 p-4 text-sm text-red-700">
                    {{ $errors->first() }}
                </div>
            @endif

            <div class="grid gap-4 lg:grid-cols-3">
                <section class="rounded-lg border border-gray-200 bg-white p-6 shadow-sm lg:col-span-2">
                    <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
                        <div>
                            <p class="text-xs font-medium uppercase text-gray-500">Dosen</p>
                            <p class="mt-1 font-semibold text-gray-900">{{ $sesiPresensi->jadwal->dosen->nama }}</p>
                        </div>
                        <div>
                            <p class="text-xs font-medium uppercase text-gray-500">Tanggal</p>
                            <p class="mt-1 font-semibold text-gray-900">{{ $sesiPresensi->tanggal->format('d M Y') }}</p>
                        </div>
                        <div>
                            <p class="text-xs font-medium uppercase text-gray-500">Pertemuan</p>
                            <p class="mt-1 font-semibold text-gray-900">{{ $sesiPresensi->pertemuan_ke }}</p>
                        </div>
                        <div>
                            <p class="text-xs font-medium uppercase text-gray-500">Status</p>
                            <p class="mt-1 font-semibold text-gray-900">{{ $sesiPresensi->status }}</p>
                        </div>
                    </div>

                    <div class="mt-6 grid gap-4 sm:grid-cols-2">
                        <div class="rounded-md bg-gray-50 p-4">
                            <p class="text-sm font-semibold text-gray-700">Waktu Buka</p>
                            <p class="mt-2 text-gray-900">{{ $sesiPresensi->opened_at->format('d M Y H:i') }}</p>
                        </div>
                        <div class="rounded-md bg-gray-50 p-4">
                            <p class="text-sm font-semibold text-gray-700">Waktu Tutup</p>
                            <p class="mt-2 text-gray-900">{{ $sesiPresensi->expired_at->format('d M Y H:i') }}</p>
                        </div>
                    </div>
                </section>

                <section class="rounded-lg border border-gray-200 bg-white p-6 shadow-sm">
                    <p class="text-sm font-semibold text-gray-700">Token Presensi</p>
                    <p class="mt-3 rounded-md bg-gray-50 px-4 py-3 text-center font-mono text-2xl font-bold tracking-wider text-gray-900">{{ $sesiPresensi->token }}</p>
                    <p class="mt-3 text-sm text-gray-500">{{ $sesiPresensi->status === 'OPEN' ? 'Token aktif selama sesi masih dibuka.' : 'Token tidak dapat digunakan setelah sesi ditutup.' }}</p>
                </section>
            </div>

            <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-6">
                @foreach ($statusCards as $status)
                    <section class="rounded-lg border p-5 shadow-sm {{ $status['class'] }}">
                        <p class="text-sm font-medium">{{ $status['label'] }}</p>
                        <p class="mt-3 text-3xl font-bold">{{ $statusCounts[$status['key']] ?? 0 }}</p>
                    </section>
                @endforeach
                <section class="rounded-lg border border-gray-200 bg-white p-5 text-gray-700 shadow-sm">
                    <p class="text-sm font-medium">Belum Presensi</p>
                    <p class="mt-3 text-3xl font-bold">{{ $belumPresensi->count() }}</p>
                </section>
            </div>

            @if ($sesiPresensi->status === 'OPEN')
                <section class="rounded-lg border border-gray-200 bg-white p-6 shadow-sm">
                    <h3 class="text-lg font-semibold text-gray-900">QR Code Presensi</h3>
                    <div class="mt-5 flex justify-center">
                        {!! $qrCode !!}
                    </div>
                    <p class="mt-4 text-center text-sm text-gray-500">Mahasiswa dapat memindai QR ini atau memasukkan token secara manual.</p>
                </section>
            @endif

            @if ($belumPresensi->isNotEmpty())
                <section class="rounded-lg border border-amber-200 bg-amber-50 p-6 shadow-sm">
                    <h3 class="text-lg font-semibold text-amber-900">Belum Presensi</h3>
                    <div class="mt-4 grid gap-2 sm:grid-cols-2 lg:grid-cols-3">
                        @foreach ($belumPresensi as $mhs)
                            <div class="rounded-md border border-amber-200 bg-white px-4 py-3 text-sm">
                                <p class="font-semibold text-gray-900">{{ $mhs->nama }}</p>
                                <p class="mt-1 text-gray-500">{{ $mhs->nim }}</p>
                            </div>
                        @endforeach
                    </div>
                </section>
            @endif

            @if ($sesiPresensi->status === 'OPEN')
                <section class="rounded-lg border border-gray-200 bg-white p-6 shadow-sm">
                    <h3 class="text-lg font-semibold text-gray-900">Presensi Manual</h3>
                    <p class="mt-1 text-sm text-gray-500">Catat atau perbarui status mahasiswa jika QR tidak digunakan.</p>
                    <form method="POST" action="{{ route('dosen.sesi_presensi.presensi.store', $sesiPresensi) }}" class="mt-5 grid gap-4 lg:grid-cols-[1fr_180px_1fr_auto] lg:items-end">
                        @csrf
                        <input type="hidden" name="sesi_presensi_id" value="{{ $sesiPresensi->id }}" />

                        <div>
                            <x-input-label for="mahasiswa_id" value="Mahasiswa" />
                            <select id="mahasiswa_id" name="mahasiswa_id" class="mt-1 block w-full rounded-md border-gray-300 text-sm shadow-sm">
                                <option value="">Pilih mahasiswa</option>
                                @foreach ($mahasiswa as $mhs)
                                    <option value="{{ $mhs->id }}" {{ old('mahasiswa_id') == $mhs->id ? 'selected' : '' }}>{{ $mhs->nim }} - {{ $mhs->nama }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('mahasiswa_id')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="status" value="Status" />
                            <select id="status" name="status" class="mt-1 block w-full rounded-md border-gray-300 text-sm shadow-sm">
                                <option value="HADIR">HADIR</option>
                                <option value="TERLAMBAT">TERLAMBAT</option>
                                <option value="IZIN">IZIN</option>
                                <option value="SAKIT">SAKIT</option>
                                <option value="ALPHA">ALPHA</option>
                            </select>
                            <x-input-error :messages="$errors->get('status')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="catatan" value="Catatan" />
                            <x-text-input id="catatan" name="catatan" type="text" class="mt-1 block w-full text-sm" value="{{ old('catatan') }}" />
                            <x-input-error :messages="$errors->get('catatan')" class="mt-2" />
                        </div>

                        <input type="hidden" name="metode" value="MANUAL" />
                        <button type="submit" class="inline-flex items-center justify-center rounded-md bg-indigo-600 px-4 py-2 text-sm font-medium text-white hover:bg-indigo-700">
                            Simpan
                        </button>
                    </form>
                </section>
            @endif

            <section class="rounded-lg border border-gray-200 bg-white shadow-sm">
                <div class="border-b border-gray-200 px-6 py-4">
                    <h3 class="text-lg font-semibold text-gray-900">Daftar Mahasiswa</h3>
                    <p class="mt-1 text-sm text-gray-500">Status setiap mahasiswa pada sesi ini.</p>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full text-left text-sm">
                        <thead class="border-b bg-gray-50 text-xs uppercase text-gray-500">
                            <tr>
                                <th class="px-6 py-3 font-semibold">Mahasiswa</th>
                                <th class="px-6 py-3 font-semibold">Status</th>
                                <th class="px-6 py-3 font-semibold">Metode</th>
                                <th class="px-6 py-3 font-semibold">Waktu</th>
                                <th class="px-6 py-3 font-semibold">Catatan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($mahasiswa as $mhs)
                                @php
                                    $absen = $presensiByMahasiswa->get($mhs->id);
                                @endphp
                                <tr class="border-b last:border-0 hover:bg-gray-50">
                                    <td class="px-6 py-4">
                                        <p class="font-medium text-gray-900">{{ $mhs->nama }}</p>
                                        <p class="mt-1 text-xs text-gray-500">{{ $mhs->nim }}</p>
                                    </td>
                                    <td class="px-6 py-4">
                                        @if ($absen)
                                            <span class="rounded-full px-2.5 py-1 text-xs font-semibold {{ $badgeClasses[$absen->status] ?? 'bg-gray-100 text-gray-700' }}">
                                                {{ $absen->status }}
                                            </span>
                                        @else
                                            <span class="rounded-full bg-gray-100 px-2.5 py-1 text-xs font-semibold text-gray-700">BELUM</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-gray-700">{{ $absen->metode ?? '-' }}</td>
                                    <td class="px-6 py-4 text-gray-700">{{ $absen?->waktu_presensi ? $absen->waktu_presensi->format('H:i, d M Y') : '-' }}</td>
                                    <td class="px-6 py-4 text-gray-700">{{ $absen->catatan ?? '-' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </section>

            <div class="flex justify-end">
                <a href="{{ route('dosen.sesi_presensi.index') }}" class="inline-flex items-center justify-center rounded-md border border-gray-300 px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">
                    Kembali
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
