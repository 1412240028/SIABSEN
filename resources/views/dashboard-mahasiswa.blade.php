<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard Mahasiswa
            </h2>
            <a href="{{ route('mahasiswa.presensi.scan.form') }}" class="inline-flex items-center justify-center rounded-md bg-indigo-600 px-4 py-2 text-sm font-medium text-white hover:bg-indigo-700">
                Scan Presensi
            </a>
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
            @if (! $mahasiswa)
                <div class="rounded-lg border border-amber-200 bg-amber-50 p-5 text-sm text-amber-800">
                    Akun ini belum terhubung dengan data mahasiswa. Hubungi administrator untuk melengkapi profil akademik.
                </div>
            @endif

            <div class="grid gap-4 lg:grid-cols-3">
                <section class="rounded-lg border border-gray-200 bg-white p-6 shadow-sm lg:col-span-2">
                    <p class="text-sm font-medium text-gray-500">Selamat datang</p>
                    <h3 class="mt-1 text-2xl font-semibold text-gray-900">{{ auth()->user()->name }}</h3>

                    <div class="mt-6 grid gap-4 sm:grid-cols-3">
                        <div>
                            <p class="text-xs font-medium uppercase text-gray-500">NIM</p>
                            <p class="mt-1 text-base font-semibold text-gray-900">{{ $mahasiswa->nim ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-xs font-medium uppercase text-gray-500">Kelas</p>
                            <p class="mt-1 text-base font-semibold text-gray-900">{{ $mahasiswa->kelas->nama_kelas ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-xs font-medium uppercase text-gray-500">Angkatan</p>
                            <p class="mt-1 text-base font-semibold text-gray-900">{{ $mahasiswa->angkatan ?? '-' }}</p>
                        </div>
                    </div>
                </section>

                <section class="rounded-lg border border-gray-200 bg-white p-6 shadow-sm">
                    <p class="text-sm font-medium text-gray-500">Persentase Hadir</p>
                    <div class="mt-3 flex items-end gap-2">
                        <p class="text-4xl font-bold text-gray-900">{{ $attendancePercentage }}%</p>
                        <p class="pb-1 text-sm text-gray-500">dari {{ $totalPresensi }} presensi</p>
                    </div>
                    <div class="mt-5 h-2 rounded-full bg-gray-100">
                        <div class="h-2 rounded-full bg-indigo-600" style="width: {{ $attendancePercentage }}%"></div>
                    </div>
                    <p class="mt-4 text-sm text-gray-600">Hadir dan terlambat dihitung sebagai kehadiran.</p>
                </section>
            </div>

            <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-5">
                @foreach ($statusCards as $status)
                    <section class="rounded-lg border p-5 shadow-sm {{ $status['class'] }}">
                        <p class="text-sm font-medium">{{ $status['label'] }}</p>
                        <p class="mt-3 text-3xl font-bold">{{ $statusCounts[$status['key']] ?? 0 }}</p>
                    </section>
                @endforeach
            </div>

            <div class="grid gap-6 lg:grid-cols-3">
                <section class="rounded-lg border border-gray-200 bg-white p-6 shadow-sm lg:col-span-2">
                    <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">Presensi Terbaru</h3>
                            <p class="mt-1 text-sm text-gray-500">Lima catatan terakhir dari riwayat presensi.</p>
                        </div>
                        <a href="{{ route('mahasiswa.presensi.history') }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-700">Lihat semua</a>
                    </div>

                    <div class="mt-5 overflow-x-auto">
                        <table class="min-w-full text-left text-sm">
                            <thead class="border-b bg-gray-50 text-xs uppercase text-gray-500">
                                <tr>
                                    <th class="px-4 py-3 font-semibold">Mata Kuliah</th>
                                    <th class="px-4 py-3 font-semibold">Tanggal</th>
                                    <th class="px-4 py-3 font-semibold">Status</th>
                                    <th class="px-4 py-3 font-semibold">Waktu</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($recentPresensi as $item)
                                    <tr class="border-b last:border-0 hover:bg-gray-50">
                                        <td class="px-4 py-3 font-medium text-gray-900">
                                            {{ $item->sesiPresensi->jadwal->mataKuliah->nama }}
                                            <span class="block text-xs font-normal text-gray-500">{{ $item->sesiPresensi->jadwal->kelas->nama_kelas }}</span>
                                        </td>
                                        <td class="px-4 py-3 text-gray-600">{{ $item->sesiPresensi->tanggal->format('d M Y') }}</td>
                                        <td class="px-4 py-3">
                                            <span class="rounded-full px-2.5 py-1 text-xs font-semibold {{ $badgeClasses[$item->status] ?? 'bg-gray-100 text-gray-700' }}">
                                                {{ $item->status }}
                                            </span>
                                        </td>
                                        <td class="px-4 py-3 text-gray-600">
                                            {{ $item->waktu_presensi ? $item->waktu_presensi->format('H:i') : '-' }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-4 py-8 text-center text-gray-500">Belum ada catatan presensi.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </section>

                <section class="rounded-lg border border-gray-200 bg-white p-6 shadow-sm">
                    <h3 class="text-lg font-semibold text-gray-900">Aksi Cepat</h3>
                    <div class="mt-5 space-y-3">
                        <a href="{{ route('mahasiswa.presensi.scan.form') }}" class="block rounded-md border border-indigo-200 bg-indigo-50 px-4 py-3 text-sm font-medium text-indigo-700 hover:bg-indigo-100">
                            Scan token presensi
                        </a>
                        <a href="{{ route('mahasiswa.presensi.history') }}" class="block rounded-md border border-gray-200 px-4 py-3 text-sm font-medium text-gray-700 hover:bg-gray-50">
                            Buka riwayat presensi
                        </a>
                        <a href="{{ route('profile.edit') }}" class="block rounded-md border border-gray-200 px-4 py-3 text-sm font-medium text-gray-700 hover:bg-gray-50">
                            Edit profil akun
                        </a>
                    </div>
                </section>
            </div>
        </div>
    </div>
</x-app-layout>
