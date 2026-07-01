<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Riwayat Presensi</h2>
            <a href="{{ route('mahasiswa.presensi.scan.form') }}" class="inline-flex items-center justify-center rounded-md bg-indigo-600 px-4 py-2 text-sm font-medium text-white hover:bg-indigo-700">
                Scan Presensi
            </a>
        </div>
    </x-slot>

    @php
        $badgeClasses = [
            'HADIR' => 'bg-green-100 text-green-800',
            'TERLAMBAT' => 'bg-amber-100 text-amber-800',
            'IZIN' => 'bg-blue-100 text-blue-800',
            'SAKIT' => 'bg-orange-100 text-orange-800',
            'ALPHA' => 'bg-red-100 text-red-800',
        ];

        $hasFilter = ! empty($filters['status']) || ! empty($filters['mata_kuliah_id']);
    @endphp

    <div class="py-10">
        <div class="max-w-7xl mx-auto space-y-6 px-4 sm:px-6 lg:px-8">
            <section class="rounded-lg border border-gray-200 bg-white p-6 shadow-sm">
                <form method="GET" action="{{ route('mahasiswa.presensi.history') }}" class="grid gap-4 lg:grid-cols-[1fr_1fr_auto] lg:items-end">
                    <div>
                        <x-input-label for="mata_kuliah_id" value="Mata Kuliah" />
                        <select id="mata_kuliah_id" name="mata_kuliah_id" class="mt-1 block w-full rounded-md border-gray-300 text-sm shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="">Semua mata kuliah</option>
                            @foreach ($mataKuliahOptions as $mataKuliah)
                                <option value="{{ $mataKuliah->id }}" {{ (string) ($filters['mata_kuliah_id'] ?? '') === (string) $mataKuliah->id ? 'selected' : '' }}>
                                    {{ $mataKuliah->kode }} - {{ $mataKuliah->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <x-input-label for="status" value="Status" />
                        <select id="status" name="status" class="mt-1 block w-full rounded-md border-gray-300 text-sm shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="">Semua status</option>
                            @foreach ($statusOptions as $value => $label)
                                <option value="{{ $value }}" {{ ($filters['status'] ?? '') === $value ? 'selected' : '' }}>
                                    {{ $label }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="flex gap-2">
                        <button type="submit" class="inline-flex items-center justify-center rounded-md bg-gray-900 px-4 py-2 text-sm font-medium text-white hover:bg-gray-800">
                            Terapkan
                        </button>
                        @if ($hasFilter)
                            <a href="{{ route('mahasiswa.presensi.history') }}" class="inline-flex items-center justify-center rounded-md border border-gray-300 px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">
                                Reset
                            </a>
                        @endif
                    </div>
                </form>
            </section>

            <section class="rounded-lg border border-gray-200 bg-white shadow-sm">
                <div class="border-b border-gray-200 px-6 py-4">
                    <h3 class="text-lg font-semibold text-gray-900">Daftar Riwayat</h3>
                    <p class="mt-1 text-sm text-gray-500">Catatan presensi ditampilkan dari yang terbaru.</p>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full text-left text-sm">
                        <thead class="border-b bg-gray-50 text-xs uppercase text-gray-500">
                            <tr>
                                <th class="px-6 py-3 font-semibold">Mata Kuliah</th>
                                <th class="px-6 py-3 font-semibold">Kelas</th>
                                <th class="px-6 py-3 font-semibold">Tanggal</th>
                                <th class="px-6 py-3 font-semibold">Status</th>
                                <th class="px-6 py-3 font-semibold">Metode</th>
                                <th class="px-6 py-3 font-semibold">Waktu</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($presensi as $item)
                                <tr class="border-b last:border-0 hover:bg-gray-50">
                                    <td class="px-6 py-4">
                                        <p class="font-medium text-gray-900">{{ $item->sesiPresensi->jadwal->mataKuliah->nama }}</p>
                                        <p class="mt-1 text-xs text-gray-500">{{ $item->sesiPresensi->jadwal->mataKuliah->kode }}</p>
                                    </td>
                                    <td class="px-6 py-4 text-gray-700">{{ $item->sesiPresensi->jadwal->kelas->nama_kelas }}</td>
                                    <td class="px-6 py-4 text-gray-700">{{ $item->sesiPresensi->tanggal->format('d M Y') }}</td>
                                    <td class="px-6 py-4">
                                        <span class="rounded-full px-2.5 py-1 text-xs font-semibold {{ $badgeClasses[$item->status] ?? 'bg-gray-100 text-gray-700' }}">
                                            {{ $item->status }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="rounded-full bg-gray-100 px-2.5 py-1 text-xs font-semibold text-gray-700">
                                            {{ $item->metode }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-gray-700">
                                        {{ $item->waktu_presensi ? $item->waktu_presensi->format('H:i, d M Y') : '-' }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-12 text-center">
                                        <p class="font-medium text-gray-700">
                                            {{ $hasFilter ? 'Tidak ada presensi yang cocok dengan filter.' : 'Belum ada riwayat presensi.' }}
                                        </p>
                                        <p class="mt-1 text-sm text-gray-500">
                                            {{ $hasFilter ? 'Coba ubah filter mata kuliah atau status.' : 'Riwayat akan muncul setelah presensi pertama tercatat.' }}
                                        </p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="border-t border-gray-200 px-6 py-4">
                    {{ $presensi->links() }}
                </div>
            </section>
        </div>
    </div>
</x-app-layout>
