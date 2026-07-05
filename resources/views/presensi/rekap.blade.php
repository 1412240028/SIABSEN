<x-app-layout>
    <div class="p-4 md:p-8 overflow-y-auto pb-24 md:pb-8">
        
        <!-- Page Header -->
        <div class="mb-8">
            <h2 class="font-headline-xl text-headline-xl font-bold text-on-surface">Rekap Presensi Akademik</h2>
            <p class="font-body-sm text-body-sm text-on-surface-variant mt-1">Pantau dan kelola data presensi seluruh mahasiswa berdasarkan filter spesifik.</p>
        </div>

        @php
            $badgeClasses = [
                'HADIR' => 'bg-status-hadir/10 text-status-hadir border-status-hadir/20',
                'TERLAMBAT' => 'bg-status-terlambat/10 text-status-terlambat border-status-terlambat/20',
                'IZIN' => 'bg-status-izin/10 text-status-izin border-status-izin/20',
                'SAKIT' => 'bg-status-sakit/10 text-status-sakit border-status-sakit/20',
                'ALPHA' => 'bg-status-alpha/10 text-status-alpha border-status-alpha/20',
            ];

            $hasFilter = ! empty($filters['kelas_id'])
                || ! empty($filters['mata_kuliah_id'])
                || ! empty($filters['status'])
                || ! empty($filters['tanggal_mulai'])
                || ! empty($filters['tanggal_selesai']);
        @endphp

        <div class="bg-white rounded-xl border border-slate-200 shadow-soft flex flex-col mb-6">
            
            <!-- Filter Section -->
            <div class="p-5 border-b border-slate-200 bg-slate-50/50">
                <form method="GET" action="{{ route('admin.presensi.rekap') }}" class="flex flex-col gap-4">
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4">
                        <!-- Kelas -->
                        <div>
                            <label for="kelas_id" class="block font-label-medium text-xs text-on-surface mb-1.5 uppercase tracking-wider text-slate-500">Kelas</label>
                            <select id="kelas_id" name="kelas_id" class="w-full px-3 py-2 border border-outline-variant rounded-lg text-body-sm focus:border-primary focus:ring-1 focus:ring-primary bg-white transition-colors">
                                <option value="">-- Semua --</option>
                                @foreach ($kelasOptions as $kelas)
                                    <option value="{{ $kelas->id }}" {{ (string) ($filters['kelas_id'] ?? '') === (string) $kelas->id ? 'selected' : '' }}>
                                        {{ $kelas->nama_kelas }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Mata Kuliah -->
                        <div class="lg:col-span-2">
                            <label for="mata_kuliah_id" class="block font-label-medium text-xs text-on-surface mb-1.5 uppercase tracking-wider text-slate-500">Mata Kuliah</label>
                            <select id="mata_kuliah_id" name="mata_kuliah_id" class="w-full px-3 py-2 border border-outline-variant rounded-lg text-body-sm focus:border-primary focus:ring-1 focus:ring-primary bg-white transition-colors">
                                <option value="">-- Semua Mata Kuliah --</option>
                                @foreach ($mataKuliahOptions as $mataKuliah)
                                    <option value="{{ $mataKuliah->id }}" {{ (string) ($filters['mata_kuliah_id'] ?? '') === (string) $mataKuliah->id ? 'selected' : '' }}>
                                        {{ $mataKuliah->kode }} - {{ $mataKuliah->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Status -->
                        <div>
                            <label for="status" class="block font-label-medium text-xs text-on-surface mb-1.5 uppercase tracking-wider text-slate-500">Status Kehadiran</label>
                            <select id="status" name="status" class="w-full px-3 py-2 border border-outline-variant rounded-lg text-body-sm focus:border-primary focus:ring-1 focus:ring-primary bg-white transition-colors">
                                <option value="">-- Semua --</option>
                                @foreach ($statusOptions as $value => $label)
                                    <option value="{{ $value }}" {{ ($filters['status'] ?? '') === $value ? 'selected' : '' }}>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 items-end">
                        <!-- Tanggal Mulai -->
                        <div>
                            <label for="tanggal_mulai" class="block font-label-medium text-xs text-on-surface mb-1.5 uppercase tracking-wider text-slate-500">Dari Tanggal</label>
                            <input id="tanggal_mulai" name="tanggal_mulai" type="date" class="w-full px-3 py-2 border border-outline-variant rounded-lg text-body-sm focus:border-primary focus:ring-1 focus:ring-primary bg-white transition-colors font-numeric-token text-sm" value="{{ $filters['tanggal_mulai'] ?? '' }}" />
                        </div>

                        <!-- Tanggal Selesai -->
                        <div>
                            <label for="tanggal_selesai" class="block font-label-medium text-xs text-on-surface mb-1.5 uppercase tracking-wider text-slate-500">Sampai Tanggal</label>
                            <input id="tanggal_selesai" name="tanggal_selesai" type="date" class="w-full px-3 py-2 border border-outline-variant rounded-lg text-body-sm focus:border-primary focus:ring-1 focus:ring-primary bg-white transition-colors font-numeric-token text-sm" value="{{ $filters['tanggal_selesai'] ?? '' }}" />
                        </div>
                        
                        <!-- Actions -->
                        <div class="lg:col-span-2 flex gap-2">
                            <button type="submit" class="bg-primary hover:bg-primary-container text-white font-label-medium px-5 py-2 rounded-lg flex items-center justify-center gap-2 shadow-sm transition-colors flex-1 md:flex-none">
                                <span class="material-symbols-outlined text-[18px]">filter_alt</span>
                                Terapkan Filter
                            </button>
                            
                            @if ($hasFilter)
                                <a href="{{ route('admin.presensi.rekap') }}" class="bg-slate-200 hover:bg-slate-300 text-slate-700 font-label-medium px-4 py-2 rounded-lg flex items-center justify-center gap-2 transition-colors">
                                    <span class="material-symbols-outlined text-[18px]">clear</span>
                                    Reset
                                </a>
                            @endif

                            <button type="button" class="bg-green-600 hover:bg-green-700 text-white font-label-medium px-4 py-2 rounded-lg flex items-center justify-center gap-2 shadow-sm transition-colors ml-auto hidden md:flex" onclick="alert('Fitur Export Excel/PDF segera hadir!')">
                                <span class="material-symbols-outlined text-[18px]">download</span>
                                Export Data
                            </button>
                        </div>
                    </div>

                </form>
            </div>

            <!-- Header Info -->
            <div class="px-6 py-4 border-b border-slate-100 flex justify-between items-center bg-white">
                <div>
                    <h3 class="font-headline-sm text-base font-bold text-slate-800">Data Presensi</h3>
                </div>
                <div class="text-sm font-label-medium text-slate-500">
                    Menampilkan <span class="text-primary font-bold">{{ $rekap->count() }}</span> dari <span class="text-slate-700 font-bold">{{ $rekap->total() }}</span> data
                </div>
            </div>

            <!-- Table Section -->
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50/80 border-b border-slate-200 font-label-xs text-label-xs text-slate-500 uppercase tracking-wider">
                            <th class="px-6 py-4 font-medium">Mahasiswa</th>
                            <th class="px-6 py-4 font-medium">Mata Kuliah & Kelas</th>
                            <th class="px-6 py-4 font-medium">Tanggal</th>
                            <th class="px-6 py-4 font-medium">Waktu</th>
                            <th class="px-6 py-4 font-medium">Status</th>
                            <th class="px-6 py-4 font-medium text-right">Metode</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 font-body-sm text-body-sm text-on-surface">
                        @forelse ($rekap as $item)
                            <tr class="hover:bg-slate-50/80 transition-colors group">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        @php
                                            $initials = collect(explode(' ', $item->mahasiswa->nama))->take(2)->map(fn($w) => strtoupper(substr($w, 0, 1)))->join('');
                                        @endphp
                                        <div class="w-8 h-8 rounded-full bg-secondary-fixed-dim/20 text-secondary-fixed-dim font-bold text-xs flex items-center justify-center shrink-0">
                                            {{ $initials }}
                                        </div>
                                        <div>
                                            <p class="font-bold text-on-surface leading-tight">{{ $item->mahasiswa->nama }}</p>
                                            <p class="text-xs text-slate-500 font-numeric-token mt-0.5">{{ $item->mahasiswa->nim }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <p class="font-bold text-slate-700">{{ $item->sesiPresensi->jadwal->mataKuliah->nama }}</p>
                                    <p class="mt-0.5 text-xs text-slate-500 font-numeric-token">
                                        {{ $item->sesiPresensi->jadwal->mataKuliah->kode }} &bull; Kelas {{ $item->sesiPresensi->jadwal->kelas->nama_kelas }}
                                    </p>
                                </td>
                                <td class="px-6 py-4 font-label-medium text-slate-600">
                                    {{ $item->sesiPresensi->tanggal->format('d/m/Y') }}
                                </td>
                                <td class="px-6 py-4 text-slate-500 font-numeric-token text-sm">
                                    {{ $item->waktu_presensi ? $item->waktu_presensi->format('H:i') . ' WIB' : '-' }}
                                </td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-md font-label-xs text-label-xs font-bold border {{ $badgeClasses[$item->status] ?? 'bg-slate-100 text-slate-700 border-slate-200' }}">
                                        {{ $item->status }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <span class="inline-flex items-center justify-center px-2 py-1 rounded bg-slate-100 text-slate-600 font-label-xs text-xs border border-slate-200">
                                        {{ $item->metode }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-16 text-center">
                                    <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-slate-100 mb-4">
                                        <span class="material-symbols-outlined text-3xl text-slate-400">inventory_2</span>
                                    </div>
                                    <h3 class="font-headline-sm text-slate-700 font-bold mb-1">
                                        {{ $hasFilter ? 'Tidak Ada Data Presensi' : 'Data Rekap Kosong' }}
                                    </h3>
                                    <p class="font-body-sm text-slate-500 text-sm max-w-md mx-auto">
                                        {{ $hasFilter ? 'Pencarian dengan filter tersebut tidak menemukan hasil apa pun. Silakan ubah filter Anda.' : 'Belum ada data presensi yang masuk ke dalam sistem. Data akan otomatis muncul ketika presensi tercatat.' }}
                                    </p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if ($rekap->hasPages())
                <div class="p-4 border-t border-slate-200 bg-slate-50">
                    {{ $rekap->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
