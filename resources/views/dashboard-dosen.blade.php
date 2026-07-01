<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard Dosen</h2>
                <p class="mt-1 text-sm text-gray-500">Ringkasan jadwal dan sesi presensi Anda.</p>
            </div>
            <a href="{{ route('dosen.sesi_presensi.create') }}" class="inline-flex items-center justify-center rounded-md bg-indigo-600 px-4 py-2 text-sm font-medium text-white hover:bg-indigo-700">
                Buat Sesi
            </a>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto space-y-6 px-4 sm:px-6 lg:px-8">
            @if (! $dosen)
                <div class="rounded-lg border border-amber-200 bg-amber-50 p-5 text-sm text-amber-800">
                    Akun ini belum terhubung dengan data dosen. Hubungi administrator untuk melengkapi profil dosen.
                </div>
            @endif

            <div class="grid gap-4 lg:grid-cols-4">
                <section class="rounded-lg border border-gray-200 bg-white p-6 shadow-sm lg:col-span-2">
                    <p class="text-sm font-medium text-gray-500">Selamat datang</p>
                    <h3 class="mt-1 text-2xl font-semibold text-gray-900">{{ auth()->user()->name }}</h3>
                    <div class="mt-5 grid gap-4 sm:grid-cols-2">
                        <div>
                            <p class="text-xs font-medium uppercase text-gray-500">NIDN</p>
                            <p class="mt-1 font-semibold text-gray-900">{{ $dosen->nidn ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-xs font-medium uppercase text-gray-500">Hari Ini</p>
                            <p class="mt-1 font-semibold text-gray-900">{{ $hariIni }}</p>
                        </div>
                    </div>
                </section>

                <section class="rounded-lg border border-gray-200 bg-white p-6 shadow-sm">
                    <p class="text-sm font-medium text-gray-500">Jadwal Aktif</p>
                    <p class="mt-3 text-4xl font-bold text-gray-900">{{ $totalJadwal }}</p>
                </section>

                <section class="rounded-lg border border-gray-200 bg-white p-6 shadow-sm">
                    <p class="text-sm font-medium text-gray-500">Total Sesi</p>
                    <p class="mt-3 text-4xl font-bold text-gray-900">{{ $totalSesi }}</p>
                </section>
            </div>

            <div class="grid gap-6 lg:grid-cols-3">
                <section class="rounded-lg border border-gray-200 bg-white shadow-sm lg:col-span-2">
                    <div class="border-b border-gray-200 px-6 py-4">
                        <h3 class="text-lg font-semibold text-gray-900">Jadwal Hari Ini</h3>
                        <p class="mt-1 text-sm text-gray-500">Jadwal mengajar untuk hari {{ $hariIni }}.</p>
                    </div>

                    <div class="divide-y divide-gray-100">
                        @forelse ($jadwalHariIni as $jadwal)
                            <div class="flex flex-col gap-3 px-6 py-4 sm:flex-row sm:items-center sm:justify-between">
                                <div>
                                    <p class="font-semibold text-gray-900">{{ $jadwal->mataKuliah->nama }}</p>
                                    <p class="mt-1 text-sm text-gray-500">
                                        {{ $jadwal->kelas->nama_kelas }} - {{ substr($jadwal->jam_mulai, 0, 5) }} sampai {{ substr($jadwal->jam_selesai, 0, 5) }}
                                    </p>
                                </div>
                                <span class="inline-flex w-fit rounded-full bg-gray-100 px-2.5 py-1 text-xs font-semibold text-gray-700">
                                    {{ $jadwal->ruangan ?? 'Tanpa ruangan' }}
                                </span>
                            </div>
                        @empty
                            <div class="px-6 py-10 text-center text-sm text-gray-500">
                                Tidak ada jadwal mengajar hari ini.
                            </div>
                        @endforelse
                    </div>
                </section>

                <section class="rounded-lg border border-gray-200 bg-white shadow-sm">
                    <div class="border-b border-gray-200 px-6 py-4">
                        <h3 class="text-lg font-semibold text-gray-900">Sesi Aktif</h3>
                        <p class="mt-1 text-sm text-gray-500">Sesi yang sedang dibuka.</p>
                    </div>

                    <div class="divide-y divide-gray-100">
                        @forelse ($sesiAktif as $sesi)
                            <a href="{{ route('dosen.sesi_presensi.show', $sesi) }}" class="block px-6 py-4 hover:bg-gray-50">
                                <p class="font-semibold text-gray-900">{{ $sesi->jadwal->mataKuliah->nama }}</p>
                                <p class="mt-1 text-sm text-gray-500">{{ $sesi->jadwal->kelas->nama_kelas }} - Pertemuan {{ $sesi->pertemuan_ke }}</p>
                                <p class="mt-2 text-xs text-gray-500">Tutup: {{ $sesi->expired_at->format('d M Y H:i') }}</p>
                            </a>
                        @empty
                            <div class="px-6 py-10 text-center text-sm text-gray-500">
                                Tidak ada sesi aktif.
                            </div>
                        @endforelse
                    </div>
                </section>
            </div>

            <section class="rounded-lg border border-gray-200 bg-white shadow-sm">
                <div class="flex flex-col gap-2 border-b border-gray-200 px-6 py-4 sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900">Sesi Terbaru</h3>
                        <p class="mt-1 text-sm text-gray-500">Lima sesi presensi terakhir yang Anda buat.</p>
                    </div>
                    <a href="{{ route('dosen.sesi_presensi.index') }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-700">Lihat semua</a>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full text-left text-sm">
                        <thead class="border-b bg-gray-50 text-xs uppercase text-gray-500">
                            <tr>
                                <th class="px-6 py-3 font-semibold">Mata Kuliah</th>
                                <th class="px-6 py-3 font-semibold">Kelas</th>
                                <th class="px-6 py-3 font-semibold">Pertemuan</th>
                                <th class="px-6 py-3 font-semibold">Tanggal</th>
                                <th class="px-6 py-3 font-semibold">Status</th>
                                <th class="px-6 py-3 font-semibold text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($sesiTerbaru as $sesi)
                                <tr class="border-b last:border-0 hover:bg-gray-50">
                                    <td class="px-6 py-4 font-medium text-gray-900">{{ $sesi->jadwal->mataKuliah->nama }}</td>
                                    <td class="px-6 py-4 text-gray-700">{{ $sesi->jadwal->kelas->nama_kelas }}</td>
                                    <td class="px-6 py-4 text-gray-700">{{ $sesi->pertemuan_ke }}</td>
                                    <td class="px-6 py-4 text-gray-700">{{ $sesi->tanggal->format('d M Y') }}</td>
                                    <td class="px-6 py-4">
                                        <span class="rounded-full bg-gray-100 px-2.5 py-1 text-xs font-semibold text-gray-700">{{ $sesi->status }}</span>
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <a href="{{ route('dosen.sesi_presensi.show', $sesi) }}" class="font-medium text-indigo-600 hover:text-indigo-700">Detail</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-10 text-center text-sm text-gray-500">
                                        Belum ada sesi presensi.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </section>
        </div>
    </div>
</x-app-layout>
