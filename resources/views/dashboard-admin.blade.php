<x-app-layout>
    <div class="p-4 md:p-8 overflow-y-auto pb-24 md:pb-8">
        {{-- Page Title --}}
        <div class="mb-8 hidden md:block">
            <h2 class="font-headline-xl text-headline-xl font-bold text-primary dark:text-primary-fixed-dim">Ringkasan Sistem</h2>
        </div>
        
        <div class="mb-8 md:hidden">
            <h2 class="font-headline-xl text-headline-xl font-bold text-primary dark:text-primary-fixed-dim">Ringkasan Sistem</h2>
        </div>

        {{-- Stats Grid (Bento Style Layout) --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-grid-gap-mobile md:gap-grid-gap-desktop mb-8">
            {{-- Stat Card 1: Total Mahasiswa --}}
            <div class="bg-white p-card-padding rounded-xl border border-slate-200 shadow-soft relative overflow-hidden group hover:border-primary-container transition-colors">
                <div class="absolute -right-4 -top-4 w-24 h-24 bg-surface-container rounded-full opacity-50 group-hover:scale-110 transition-transform duration-500"></div>
                <div class="flex justify-between items-start relative z-10">
                    <div>
                        <p class="font-label-medium text-label-medium text-on-surface-variant mb-1">Total Mahasiswa</p>
                        <h3 class="font-numeric-token text-3xl font-bold text-on-surface">{{ $totalMahasiswa }}</h3>
                    </div>
                    <div class="w-10 h-10 rounded-lg bg-surface-container flex items-center justify-center text-primary-container">
                        <span class="material-symbols-outlined">group</span>
                    </div>
                </div>
                <div class="mt-4 flex items-center gap-1 text-status-hadir relative z-10">
                    <span class="material-symbols-outlined text-sm">trending_up</span>
                    <span class="font-label-xs text-label-xs font-medium">Mahasiswa Terdaftar</span>
                </div>
            </div>

            {{-- Stat Card 2: Total Dosen --}}
            <div class="bg-white p-card-padding rounded-xl border border-slate-200 shadow-soft relative overflow-hidden group hover:border-primary-container transition-colors">
                <div class="flex justify-between items-start relative z-10">
                    <div>
                        <p class="font-label-medium text-label-medium text-on-surface-variant mb-1">Total Dosen</p>
                        <h3 class="font-numeric-token text-3xl font-bold text-on-surface">{{ $totalDosen }}</h3>
                    </div>
                    <div class="w-10 h-10 rounded-lg bg-surface-container-high flex items-center justify-center text-on-secondary-container">
                        <span class="material-symbols-outlined">person_4</span>
                    </div>
                </div>
                <div class="mt-4 flex items-center gap-1 text-slate-500 relative z-10">
                    <span class="material-symbols-outlined text-sm">horizontal_rule</span>
                    <span class="font-label-xs text-label-xs font-medium">Pengajar Aktif</span>
                </div>
            </div>

            {{-- Stat Card 3: Kelas Aktif --}}
            <div class="bg-white p-card-padding rounded-xl border border-slate-200 shadow-soft relative overflow-hidden group hover:border-primary-container transition-colors">
                <div class="flex justify-between items-start relative z-10">
                    <div>
                        <p class="font-label-medium text-label-medium text-on-surface-variant mb-1">Kelas Aktif</p>
                        <h3 class="font-numeric-token text-3xl font-bold text-on-surface">{{ $kelasAktif }}</h3>
                    </div>
                    <div class="w-10 h-10 rounded-lg bg-secondary-fixed flex items-center justify-center text-on-secondary-fixed-variant">
                        <span class="material-symbols-outlined">meeting_room</span>
                    </div>
                </div>
                @php
                    $capPersen = $totalKapasitas > 0 ? min(100, round(($kelasAktif / max($totalKapasitas, 1)) * 100 * 40)) : 0;
                @endphp
                <div class="mt-4 w-full bg-slate-100 rounded-full h-1.5 relative z-10">
                    <div class="bg-secondary-container h-1.5 rounded-full" style="width: {{ $capPersen }}%"></div>
                </div>
                <p class="font-label-xs text-label-xs text-slate-500 mt-2 text-right relative z-10">Kapasitas: {{ $totalKapasitas }}</p>
            </div>

            {{-- Stat Card 4: Sesi Hari Ini --}}
            <div class="bg-primary-container p-card-padding rounded-xl border border-primary-container shadow-card relative overflow-hidden">
                <div class="absolute inset-0 bg-gradient-to-br from-transparent to-primary opacity-50"></div>
                <div class="flex justify-between items-start relative z-10 text-white">
                    <div>
                        <p class="font-label-medium text-label-medium text-on-primary-container mb-1">Sesi Presensi Hari Ini</p>
                        <h3 class="font-numeric-token text-3xl font-bold">{{ $sesiHariIni }}</h3>
                    </div>
                    <div class="w-10 h-10 rounded-lg bg-white/20 flex items-center justify-center text-white backdrop-blur-sm">
                        <span class="material-symbols-outlined">how_to_reg</span>
                    </div>
                </div>
                <div class="mt-4 flex justify-between items-end relative z-10">
                    <div class="flex -space-x-2">
                        <div class="w-8 h-8 rounded-full bg-status-hadir border-2 border-primary-container flex items-center justify-center text-xs font-bold text-white z-30" title="Selesai">
                            {{ $sesiStatusCounts['CLOSED'] ?? 0 }}
                        </div>
                        <div class="w-8 h-8 rounded-full bg-secondary-container border-2 border-primary-container flex items-center justify-center text-xs font-bold text-on-secondary-container z-20" title="Berjalan">
                            {{ $sesiStatusCounts['OPEN'] ?? 0 }}
                        </div>
                    </div>
                    <a href="{{ route('admin.presensi.rekap') }}" class="text-white hover:text-on-primary-container font-label-xs text-label-xs flex items-center gap-1 transition-colors">
                        Detail <span class="material-symbols-outlined text-sm">arrow_forward</span>
                    </a>
                </div>
            </div>
        </div>

        {{-- Main Section: Activity Table & Side Panel --}}
        <div class="grid grid-cols-1 xl:grid-cols-3 gap-grid-gap-desktop">
            
            {{-- Table Section (Spans 2 columns on extra large screens) --}}
            <div class="xl:col-span-2 bg-white rounded-xl border border-slate-200 shadow-soft overflow-hidden flex flex-col">
                <div class="p-4 md:p-5 border-b border-slate-200 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                    <h3 class="font-headline-lg text-headline-lg font-semibold text-on-surface">Aktivitas Presensi Terbaru</h3>
                    <div class="flex gap-2">
                        <button class="px-3 py-1.5 border border-outline-variant rounded-lg font-label-medium text-label-medium text-on-surface-variant hover:bg-slate-50 transition-colors flex items-center gap-2">
                            <span class="material-symbols-outlined text-sm">filter_list</span> Filter
                        </button>
                        <a href="{{ route('admin.presensi.rekap') }}" class="px-3 py-1.5 bg-primary-container text-white rounded-lg font-label-medium text-label-medium hover:bg-primary transition-colors shadow-sm">
                            Lihat Semua
                        </a>
                    </div>
                </div>
                <div class="overflow-x-auto">
                    @if($recentActivity->isEmpty())
                        <div class="p-12 text-center text-slate-500">
                            <span class="material-symbols-outlined text-4xl mb-2 text-slate-300">inbox</span>
                            <p class="font-body-sm">Belum ada aktivitas presensi.</p>
                        </div>
                    @else
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-slate-50 border-b border-slate-200 font-label-xs text-label-xs text-slate-500 uppercase tracking-wider">
                                    <th class="px-5 py-3 font-medium">Mata Kuliah</th>
                                    <th class="px-5 py-3 font-medium">Dosen Pengampu</th>
                                    <th class="px-5 py-3 font-medium">Waktu</th>
                                    <th class="px-5 py-3 font-medium">Kehadiran</th>
                                    <th class="px-5 py-3 font-medium text-right">Status</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100 font-body-sm text-body-sm text-on-surface">
                                @foreach($recentActivity as $sesi)
                                    @php
                                        $jadwal = $sesi->jadwal;
                                        $dosenName = optional(optional($jadwal)->dosen)->nama ?? '-';
                                        $dosenInitials = collect(explode(' ', $dosenName))->take(2)->map(fn($w) => strtoupper(substr($w, 0, 1)))->join('');
                                        $hadir = $sesi->presensi->count();
                                        $kapasitas = optional(optional($jadwal)->kelas)->kapasitas ?? 40;
                                        $persen = $kapasitas > 0 ? round(($hadir / $kapasitas) * 100) : 0;
                                    @endphp
                                    <tr class="hover:bg-slate-50 transition-colors">
                                        <td class="px-5 py-4">
                                            <p class="font-semibold text-primary-container">{{ optional(optional($jadwal)->mataKuliah)->nama ?? '-' }}</p>
                                            <p class="text-slate-500 font-label-xs mt-0.5">{{ optional(optional($jadwal)->mataKuliah)->kode ?? '' }} - {{ optional(optional($jadwal)->kelas)->nama_kelas ?? '-' }}</p>
                                        </td>
                                        <td class="px-5 py-4 flex items-center gap-2">
                                            <div class="w-6 h-6 rounded-full bg-surface-container flex items-center justify-center text-xs text-primary-container font-bold">
                                                {{ $dosenInitials }}
                                            </div>
                                            {{ $dosenName }}
                                        </td>
                                        <td class="px-5 py-4 font-numeric-token">
                                            {{ $jadwal ? \Carbon\Carbon::parse($jadwal->jam_mulai)->format('H:i') : '-' }} - {{ $jadwal ? \Carbon\Carbon::parse($jadwal->jam_selesai)->format('H:i') : '-' }}
                                        </td>
                                        <td class="px-5 py-4">
                                            <div class="flex items-center gap-2">
                                                <div class="flex-1 h-1.5 bg-slate-100 rounded-full w-24">
                                                    <div class="h-1.5 {{ $persen >= 80 ? 'bg-status-hadir' : ($persen >= 50 ? 'bg-secondary-container' : 'bg-status-alpa') }} rounded-full" style="width: {{ min(100, $persen) }}%"></div>
                                                </div>
                                                <span class="font-numeric-token text-xs text-slate-500">{{ $hadir }}/{{ $kapasitas }}</span>
                                            </div>
                                        </td>
                                        <td class="px-5 py-4 text-right">
                                            @if($sesi->status === 'OPEN')
                                                <span class="inline-flex items-center px-2 py-0.5 rounded-md bg-yellow-100 text-status-sakit font-label-xs text-label-xs font-semibold">Berjalan</span>
                                            @else
                                                <span class="inline-flex items-center px-2 py-0.5 rounded-md bg-green-100 text-status-hadir font-label-xs text-label-xs font-semibold">Selesai</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>

            {{-- Right Panel: Quick Actions & Alerts --}}
            <div class="space-y-6">
                {{-- Quick Actions Glass Card --}}
                <div class="bg-white/80 backdrop-blur-md rounded-xl border border-white shadow-soft p-5 relative overflow-hidden">
                    <div class="absolute inset-0 bg-gradient-to-br from-surface-container-high/40 to-transparent"></div>
                    <div class="relative z-10">
                        <h3 class="font-headline-lg text-headline-lg font-semibold text-on-surface mb-4">Aksi Cepat</h3>
                        <div class="grid grid-cols-2 gap-3">
                            <a href="{{ route('admin.jadwal.index') }}" class="flex flex-col items-center justify-center p-3 bg-white border border-slate-200 rounded-lg hover:border-primary-container hover:shadow-sm transition-all group">
                                <span class="material-symbols-outlined text-slate-400 group-hover:text-primary-container mb-2">event</span>
                                <span class="font-label-xs text-label-xs text-center text-slate-600 group-hover:text-primary-container">Kelola Jadwal</span>
                            </a>
                            <a href="{{ route('mahasiswa.index') }}" class="flex flex-col items-center justify-center p-3 bg-white border border-slate-200 rounded-lg hover:border-primary-container hover:shadow-sm transition-all group">
                                <span class="material-symbols-outlined text-slate-400 group-hover:text-primary-container mb-2">manage_accounts</span>
                                <span class="font-label-xs text-label-xs text-center text-slate-600 group-hover:text-primary-container">Kelola User</span>
                            </a>
                            <a href="{{ route('admin.presensi.rekap') }}" class="flex flex-col items-center justify-center p-3 bg-white border border-slate-200 rounded-lg hover:border-primary-container hover:shadow-sm transition-all group">
                                <span class="material-symbols-outlined text-slate-400 group-hover:text-primary-container mb-2">summarize</span>
                                <span class="font-label-xs text-label-xs text-center text-slate-600 group-hover:text-primary-container">Rekap Laporan</span>
                            </a>
                            <a href="{{ route('profile.edit') }}" class="flex flex-col items-center justify-center p-3 bg-white border border-slate-200 rounded-lg hover:border-primary-container hover:shadow-sm transition-all group">
                                <span class="material-symbols-outlined text-slate-400 group-hover:text-primary-container mb-2">settings_suggest</span>
                                <span class="font-label-xs text-label-xs text-center text-slate-600 group-hover:text-primary-container">Konfigurasi</span>
                            </a>
                        </div>
                    </div>
                </div>

                {{-- System Alerts --}}
                <div class="bg-white rounded-xl border border-slate-200 shadow-soft p-5">
                    <h3 class="font-headline-lg text-headline-lg font-semibold text-on-surface mb-4">Peringatan Sistem</h3>
                    <div class="space-y-3">
                        @if($pendingIzin > 0)
                        <div class="flex items-start gap-3 p-3 bg-secondary-fixed/30 rounded-lg border border-secondary-fixed">
                            <span class="material-symbols-outlined text-secondary mt-0.5">info</span>
                            <div>
                                <p class="font-label-medium text-label-medium text-on-secondary-fixed-variant">Pengajuan Izin Pending</p>
                                <p class="font-label-xs text-label-xs text-slate-600 mt-1">Terdapat {{ $pendingIzin }} pengajuan izin yang perlu diverifikasi.</p>
                            </div>
                        </div>
                        @endif
                        @if($pendingKomplain > 0)
                        <div class="flex items-start gap-3 p-3 bg-error-container/30 rounded-lg border border-error-container">
                            <span class="material-symbols-outlined text-error mt-0.5">warning</span>
                            <div>
                                <p class="font-label-medium text-label-medium text-on-error-container">Komplain Presensi Pending</p>
                                <p class="font-label-xs text-label-xs text-slate-600 mt-1">Terdapat {{ $pendingKomplain }} komplain presensi yang belum ditangani.</p>
                            </div>
                        </div>
                        @endif
                        @if($pendingIzin === 0 && $pendingKomplain === 0)
                        <div class="flex items-start gap-3 p-3 bg-slate-50 rounded-lg border border-slate-200">
                            <span class="material-symbols-outlined text-slate-400 mt-0.5">check_circle</span>
                            <div>
                                <p class="font-label-medium text-label-medium text-slate-600">Sistem Berjalan Lancar</p>
                                <p class="font-label-xs text-label-xs text-slate-500 mt-1">Tidak ada peringatan baru saat ini.</p>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>