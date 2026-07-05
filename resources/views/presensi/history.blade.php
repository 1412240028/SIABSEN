<x-app-layout>
    <div class="p-4 md:p-8 overflow-y-auto pb-24 md:pb-8">
        
        <!-- Page Header -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
            <div>
                <h2 class="font-headline-xl text-headline-xl font-bold text-on-surface">Riwayat Kehadiran</h2>
                <p class="font-body-sm text-body-sm text-on-surface-variant mt-1">Lacak catatan presensi Anda berdasarkan mata kuliah dan status kehadiran.</p>
            </div>
            <a href="{{ route('mahasiswa.presensi.scan.form') }}" class="bg-primary hover:bg-primary-container text-white font-label-medium text-label-medium px-5 py-2.5 rounded-lg flex items-center gap-2 shadow-sm transition-colors">
                <span class="material-symbols-outlined text-[20px]">qr_code_scanner</span>
                Scan Presensi Baru
            </a>
        </div>

        @php
            $badgeClasses = [
                'HADIR' => 'bg-status-hadir/10 text-status-hadir border-status-hadir/20',
                'TERLAMBAT' => 'bg-status-terlambat/10 text-status-terlambat border-status-terlambat/20',
                'IZIN' => 'bg-status-izin/10 text-status-izin border-status-izin/20',
                'SAKIT' => 'bg-status-sakit/10 text-status-sakit border-status-sakit/20',
                'ALPHA' => 'bg-status-alpha/10 text-status-alpha border-status-alpha/20',
            ];

            $hasFilter = ! empty($filters['status']) || ! empty($filters['mata_kuliah_id']);
        @endphp

        <div class="bg-white rounded-xl border border-slate-200 shadow-soft flex flex-col mb-6">
            <!-- Filter Section -->
            <div class="p-5 border-b border-slate-200 bg-slate-50/50">
                <form method="GET" action="{{ route('mahasiswa.presensi.history') }}" class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-4 items-end">
                    
                    <div class="lg:col-span-2">
                        <label for="mata_kuliah_id" class="block font-label-medium text-sm text-on-surface mb-1.5">Mata Kuliah</label>
                        <select id="mata_kuliah_id" name="mata_kuliah_id" class="w-full px-4 py-2 border border-outline-variant rounded-lg text-body-sm focus:border-primary focus:ring-1 focus:ring-primary bg-white transition-colors">
                            <option value="">Semua Mata Kuliah</option>
                            @foreach ($mataKuliahOptions as $mataKuliah)
                                <option value="{{ $mataKuliah->id }}" {{ (string) ($filters['mata_kuliah_id'] ?? '') === (string) $mataKuliah->id ? 'selected' : '' }}>
                                    {{ $mataKuliah->kode }} - {{ $mataKuliah->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="status" class="block font-label-medium text-sm text-on-surface mb-1.5">Status</label>
                        <select id="status" name="status" class="w-full px-4 py-2 border border-outline-variant rounded-lg text-body-sm focus:border-primary focus:ring-1 focus:ring-primary bg-white transition-colors">
                            <option value="">Semua Status</option>
                            @foreach ($statusOptions as $value => $label)
                                <option value="{{ $value }}" {{ ($filters['status'] ?? '') === $value ? 'selected' : '' }}>
                                    {{ $label }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="flex items-center gap-2">
                        <button type="submit" class="flex-1 bg-slate-800 hover:bg-slate-900 text-white font-label-medium px-4 py-2 rounded-lg flex items-center justify-center gap-2 shadow-sm transition-colors">
                            <span class="material-symbols-outlined text-[18px]">filter_list</span>
                            Filter
                        </button>
                        @if ($hasFilter)
                            <a href="{{ route('mahasiswa.presensi.history') }}" class="bg-slate-100 hover:bg-slate-200 text-slate-600 font-label-medium px-4 py-2 rounded-lg flex items-center justify-center transition-colors" title="Reset Filter">
                                <span class="material-symbols-outlined text-[18px]">close</span>
                            </a>
                        @endif
                    </div>
                </form>
            </div>

            <!-- Table Section -->
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50 border-b border-slate-200 font-label-xs text-label-xs text-slate-500 uppercase tracking-wider">
                            <th class="px-6 py-4 font-medium">Informasi Sesi</th>
                            <th class="px-6 py-4 font-medium">Tanggal Sesi</th>
                            <th class="px-6 py-4 font-medium">Status</th>
                            <th class="px-6 py-4 font-medium">Waktu Tercatat</th>
                            <th class="px-6 py-4 font-medium text-right">Metode</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 font-body-sm text-body-sm text-on-surface">
                        @forelse ($presensi as $item)
                            <tr class="hover:bg-slate-50/80 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="font-bold text-on-surface leading-tight">{{ $item->sesiPresensi->jadwal->mataKuliah->nama }}</div>
                                    <div class="text-xs text-slate-500 font-numeric-token mt-1">
                                        {{ $item->sesiPresensi->jadwal->mataKuliah->kode }} &bull; Kelas {{ $item->sesiPresensi->jadwal->kelas->nama_kelas }} &bull; P. {{ $item->sesiPresensi->pertemuan_ke }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 font-label-medium text-slate-700">
                                    {{ $item->sesiPresensi->tanggal->format('d M Y') }}
                                </td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-md font-label-xs text-label-xs font-bold border {{ $badgeClasses[$item->status] ?? 'bg-slate-100 text-slate-700 border-slate-200' }}">
                                        {{ $item->status }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-slate-600 font-numeric-token text-sm">
                                    {{ $item->waktu_presensi ? $item->waktu_presensi->format('H:i') . ' WIB' : '-' }}
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <span class="inline-flex items-center justify-center px-2 py-1 rounded bg-slate-100 text-slate-600 font-label-xs text-xs border border-slate-200">
                                        {{ $item->metode }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-16 text-center">
                                    <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-slate-100 mb-4">
                                        <span class="material-symbols-outlined text-3xl text-slate-400">history_toggle_off</span>
                                    </div>
                                    <h3 class="font-headline-sm text-slate-700 font-bold mb-1">
                                        {{ $hasFilter ? 'Tidak Ada Data Presensi' : 'Belum Ada Riwayat Presensi' }}
                                    </h3>
                                    <p class="font-body-sm text-slate-500 text-sm max-w-sm mx-auto">
                                        {{ $hasFilter ? 'Tidak ada presensi yang sesuai dengan kriteria filter yang Anda berikan. Silakan sesuaikan filter pencarian.' : 'Catatan kehadiran Anda akan muncul di sini setelah Anda melakukan scan presensi atau didata secara manual oleh Dosen.' }}
                                    </p>
                                    @if($hasFilter)
                                        <a href="{{ route('mahasiswa.presensi.history') }}" class="inline-block mt-4 text-primary hover:underline font-label-medium text-sm">Reset Filter Pencarian</a>
                                    @endif
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if ($presensi->hasPages())
                <div class="p-4 border-t border-slate-200 bg-slate-50">
                    {{ $presensi->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
