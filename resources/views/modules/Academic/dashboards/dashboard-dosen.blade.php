<x-app-layout>
    @php
        $hour = (int) date('H');
        $salutation = match(true) {
            $hour >= 5 && $hour < 11 => 'Selamat Pagi',
            $hour >= 11 && $hour < 15 => 'Selamat Siang',
            $hour >= 15 && $hour < 18 => 'Selamat Sore',
            default => 'Selamat Malam',
        };
    @endphp

    <div class="p-4 md:p-8 overflow-y-auto pb-24 md:pb-8">
        <div class="max-w-7xl mx-auto space-y-8">
            <!-- Page Header & Primary Action -->
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                <div>
                    <h2 class="font-headline-2xl text-headline-2xl font-bold text-on-surface">{{ $salutation }}, {{ $dosen->nama ?? auth()->user()->name }}</h2>
                    <p class="font-body-base text-body-base text-on-surface-variant mt-1">Berikut adalah ringkasan jadwal dan aktivitas Anda hari ini.</p>
                </div>
                <a href="{{ route('dosen.sesi_presensi.create') }}" class="bg-secondary-container hover:bg-secondary-fixed-dim text-on-secondary-container font-label-medium text-label-medium px-6 py-3 rounded-xl flex items-center gap-2 shadow-card transition-all transform hover:-translate-y-0.5 active:translate-y-0">
                    <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">add_circle</span>
                    Buka Sesi Presensi
                </a>
            </div>

            <!-- Bento Grid Layout -->
            <div class="grid grid-cols-1 xl:grid-cols-12 gap-6">

                <!-- Quick Stats Cards (Spanning 8 columns total) -->
                <div class="xl:col-span-8 grid grid-cols-1 sm:grid-cols-3 gap-6">

                    <!-- Stat 1: Kelas Hari Ini -->
                    <div class="bg-white rounded-xl border border-slate-100 p-6 shadow-sm hover:shadow-md transition-shadow">
                        <div class="flex justify-between items-start mb-4">
                            <div class="w-12 h-12 rounded-xl bg-primary/5 flex items-center justify-center text-primary">
                                <span class="material-symbols-outlined text-[28px]">calendar_today</span>
                            </div>
                            <span class="text-label-xs font-bold text-primary bg-primary/10 px-2 py-1 rounded uppercase tracking-wider">Hari Ini</span>
                        </div>
                        <div>
                            <p class="text-label-medium text-on-surface-variant mb-1">Kelas Terjadwal</p>
                            <div class="flex items-baseline gap-2">
                                <span class="text-[32px] font-bold text-on-surface font-numeric-token">{{ $jadwalHariIni->count() }}</span>
                                <span class="text-body-sm text-on-surface-variant">Sesi Kuliah</span>
                            </div>
                        </div>
                    </div>

                    <!-- Stat 2: Kehadiran -->
                    <div class="bg-white rounded-xl border border-slate-100 p-6 shadow-sm hover:shadow-md transition-shadow">
                        <div class="flex justify-between items-start mb-4">
                            <div class="w-12 h-12 rounded-xl bg-status-hadir/5 flex items-center justify-center text-status-hadir">
                                <span class="material-symbols-outlined text-[28px]">person_check</span>
                            </div>
                            <div class="flex items-center gap-1 text-status-hadir font-bold text-label-xs">
                                <span class="material-symbols-outlined text-[14px]">trending_up</span> +5%
                            </div>
                        </div>
                        <div>
                            <p class="text-label-medium text-on-surface-variant mb-1">Rata-rata Kehadiran</p>
                            <div class="flex items-baseline gap-2">
                                <span class="text-[32px] font-bold text-on-surface font-numeric-token">94.2%</span>
                            </div>
                        </div>
                    </div>

                    <!-- Stat 3: Kendala -->
                    <div class="bg-white rounded-xl border border-slate-100 p-6 shadow-sm hover:shadow-md transition-shadow">
                        <div class="flex justify-between items-start mb-4">
                            <div class="w-12 h-12 rounded-xl bg-status-alpa/5 flex items-center justify-center text-status-alpa">
                                <span class="material-symbols-outlined text-[28px]">error</span>
                            </div>
                            <span class="text-label-xs font-bold text-status-alpa bg-status-alpa/10 px-2 py-1 rounded uppercase tracking-wider">Penting</span>
                        </div>
                        <div>
                            <p class="text-label-medium text-on-surface-variant mb-1">Mahasiswa Bermasalah</p>
                            <div class="flex items-baseline gap-2">
                                <span class="text-[32px] font-bold text-on-surface font-numeric-token">8</span>
                                <span class="text-body-sm text-on-surface-variant">Kasus Alpa</span>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Next Class Widget (Spanning 4 columns) -->
                <div class="xl:col-span-4 bg-slate-900 text-white rounded-xl shadow-card relative overflow-hidden flex flex-col">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-primary/20 rounded-full -mr-16 -mt-16 blur-3xl"></div>

                    @if($sesiAktif->first())
                        @php $sesi = $sesiAktif->first(); @endphp
                        <div class="p-6 relative z-10 flex-1">
                            <div class="flex justify-between items-center mb-6">
                                <div class="flex items-center gap-2">
                                    <span class="w-2 h-2 rounded-full bg-secondary-container animate-pulse"></span>
                                    <span class="text-label-xs font-bold uppercase tracking-widest text-slate-400">Sesi Berjalan</span>
                                </div>
                                <span class="font-numeric-token text-sm bg-white/10 px-3 py-1 rounded-full">
                                    {{ \Carbon\Carbon::parse($sesi->jadwal->jam_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($sesi->jadwal->jam_selesai)->format('H:i') }}
                                </span>
                            </div>

                            <h3 class="text-headline-xl font-bold mb-2">{{ $sesi->jadwal->mataKuliah->nama ?? '-' }}</h3>
                            <div class="flex items-center gap-2 text-slate-400 mb-6">
                                <span class="material-symbols-outlined text-sm">location_on</span>
                                <span class="text-body-sm">Ruang {{ $sesi->jadwal->ruangan ?? '-' }} • {{ $sesi->jadwal->kelas->nama_kelas ?? '-' }}</span>
                            </div>

                            <div class="flex items-center justify-between">
                                <div class="flex -space-x-2">
                                    <div class="w-8 h-8 rounded-full border-2 border-slate-900 bg-slate-700 flex items-center justify-center text-[10px] font-bold text-white">A</div>
                                    <div class="w-8 h-8 rounded-full border-2 border-slate-900 bg-slate-600 flex items-center justify-center text-[10px] font-bold text-white">B</div>
                                    <div class="w-8 h-8 rounded-full border-2 border-slate-900 bg-slate-800 flex items-center justify-center text-[10px] font-bold">+{{ $sesi->presensi->count() }}</div>
                                </div>

                                <a href="{{ route('dosen.sesi_presensi.show', $sesi->id) }}" class="text-primary hover:text-primary-fixed font-label-medium text-sm transition-colors">Lihat Daftar Hadir</a>
                            </div>
                        </div>

                        <div class="p-4 bg-white/5 mt-auto border-t border-white/10 relative z-10">
                            <a href="{{ route('dosen.sesi_presensi.show', $sesi->id) }}" class="w-full bg-secondary-container text-on-secondary-container hover:bg-secondary-fixed-dim font-bold py-3 rounded-lg transition-all flex items-center justify-center gap-2 shadow-lg">
                                <span class="material-symbols-outlined">qr_code_scanner</span>
                                Buka Panel Presensi
                            </a>
                        </div>
                    @else
                        <div class="p-6 relative z-10 flex-1 flex flex-col items-center justify-center text-center">
                            <div class="w-12 h-12 rounded-xl flex items-center justify-center mb-3 bg-white/5">
                                <span class="material-symbols-outlined text-slate-400">event_busy</span>
                            </div>
                            <p class="font-label-medium text-slate-300">Tidak ada sesi aktif</p>
                            <p class="text-label-xs text-slate-500 mt-1">Buka sesi presensi baru untuk memulai</p>
                        </div>

                        <div class="p-4 bg-white/5 mt-auto border-t border-white/10 relative z-10">
                            <a href="{{ route('dosen.sesi_presensi.create') }}" class="w-full bg-secondary-container text-on-secondary-container hover:bg-secondary-fixed-dim font-bold py-3 rounded-lg transition-all flex items-center justify-center gap-2 shadow-lg">
                                <span class="material-symbols-outlined">add_circle</span>
                                Buka Sesi Baru
                            </a>
                        </div>
                    @endif
                </div>

                <!-- Schedule Table (Spanning 8 columns) -->
                <div class="xl:col-span-8 bg-surface rounded-xl border border-slate-200 shadow-soft overflow-hidden">
                    <div class="px-6 py-5 border-b border-slate-100 flex justify-between items-center bg-white">
                        <h3 class="text-headline-lg font-bold text-on-surface">Jadwal Mengajar Hari Ini</h3>
                        <a href="{{ route('dosen.sesi_presensi.index') }}" class="text-primary hover:bg-primary/5 px-4 py-2 rounded-lg font-label-medium transition-colors">Lihat Kalender</a>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-slate-50/50 border-b border-slate-100">
                                    <th class="px-6 py-4 text-label-xs font-bold text-slate-500 uppercase tracking-widest">Waktu</th>
                                    <th class="px-6 py-4 text-label-xs font-bold text-slate-500 uppercase tracking-widest">Mata Kuliah</th>
                                    <th class="px-6 py-4 text-label-xs font-bold text-slate-500 uppercase tracking-widest">Ruang</th>
                                    <th class="px-6 py-4 text-label-xs font-bold text-slate-500 uppercase tracking-widest">Status</th>
                                    <th class="px-6 py-4 text-label-xs font-bold text-slate-500 uppercase tracking-widest text-right">Aksi</th>
                                </tr>
                            </thead>

                            <tbody class="divide-y divide-slate-50 bg-white">
                                @forelse($jadwalHariIni as $jadwal)
                                    @php
                                        $activeSesi = $sesiAktif->first(fn($s) => $s->jadwal_id === $jadwal->id);
                                        $closedSesi = $sesiTerbaru->first(fn($s) => $s->jadwal_id === $jadwal->id && $s->status === 'CLOSED' && $s->tanggal->isToday());
                                        $isActive = $activeSesi !== null;
                                    @endphp

                                    <tr class="hover:bg-slate-50/80 transition-colors {{ $isActive ? 'bg-primary/5 hover:bg-primary/10' : '' }}">
                                        <td class="px-6 py-5 font-numeric-token text-sm {{ $isActive ? 'text-primary font-bold' : 'text-on-surface' }}">
                                            {{ \Carbon\Carbon::parse($jadwal->jam_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($jadwal->jam_selesai)->format('H:i') }}
                                        </td>

                                        <td class="px-6 py-5">
                                            <p class="font-bold text-on-surface">{{ $jadwal->mataKuliah->nama }}</p>
                                            <p class="text-label-xs text-on-surface-variant">{{ $jadwal->kelas->nama_kelas }} • Reguler</p>
                                        </td>

                                        <td class="px-6 py-5 text-body-sm">{{ $jadwal->ruangan ?? '-' }}</td>

                                        <td class="px-6 py-5">
                                            @if($isActive)
                                                <span class="inline-flex items-center px-3 py-1 rounded-full text-[11px] font-bold bg-secondary-container/10 text-on-secondary-container border border-secondary-container/20">
                                                    Sedang Berjalan
                                                </span>
                                            @elseif($closedSesi)
                                                <span class="inline-flex items-center px-3 py-1 rounded-full text-[11px] font-bold bg-status-hadir/10 text-status-hadir border border-status-hadir/20">
                                                    Selesai ({{ $closedSesi->presensi->count() }}/40)
                                                </span>
                                            @else
                                                <span class="inline-flex items-center px-3 py-1 rounded-full text-[11px] font-bold bg-slate-100 text-slate-500 border border-slate-200">
                                                    Belum Mulai
                                                </span>
                                            @endif
                                        </td>

                                        <td class="px-6 py-5 text-right">
                                            @if($isActive)
                                                <a href="{{ route('dosen.sesi_presensi.show', $activeSesi->id) }}" class="bg-primary text-white px-4 py-1.5 rounded-lg text-label-xs font-bold hover:bg-primary-container transition-colors shadow-sm inline-block">Detail</a>
                                            @else
                                                <button class="text-slate-400 hover:text-primary transition-colors">
                                                    <span class="material-symbols-outlined">more_horiz</span>
                                                </button>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-6 py-12 text-center text-slate-500">
                                            <span class="material-symbols-outlined text-4xl mb-2 text-slate-300">calendar_today</span>
                                            <p class="font-body-sm">Tidak ada jadwal mengajar hari ini.</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Recent Absences Alert (Spanning 4 columns) -->
                <div class="xl:col-span-4 bg-surface rounded-xl border border-slate-200 shadow-soft flex flex-col">
                    <div class="px-6 py-5 border-b border-slate-100 bg-white">
                        <h3 class="text-headline-lg font-bold text-on-surface flex items-center gap-2">
                            <span class="material-symbols-outlined text-primary">assignment_late</span>
                            Pengajuan Izin Baru
                        </h3>
                    </div>

                    <div class="p-2 flex-1 bg-white">
                        <div class="space-y-1">
                            @forelse($izinTerbaru as $izin)
                                @php
                                    $nama = optional($izin->user)->name ?? 'Unknown';
                                    $initials = collect(explode(' ', $nama))->take(2)->map(fn($w) => strtoupper(substr($w, 0, 1)))->join('');
                                    $bgColor = $izin->jenis === 'SAKIT' ? 'bg-amber-500' : 'bg-blue-500';
                                    $badgeBg = $izin->jenis === 'SAKIT' ? 'bg-status-sakit/10' : 'bg-status-izin/10';
                                    $badgeText = $izin->jenis === 'SAKIT' ? 'text-status-sakit' : 'text-status-izin';
                                @endphp

                                <div class="p-4 rounded-xl hover:bg-slate-50 transition-all cursor-pointer group">
                                    <div class="flex gap-4">
                                        <div class="w-10 h-10 rounded-lg shrink-0 flex items-center justify-center text-white font-bold {{ $bgColor }}">
                                            {{ $initials }}
                                        </div>

                                        <div class="flex-1 min-w-0">
                                            <div class="flex justify-between items-start">
                                                <p class="font-bold text-on-surface truncate">{{ $nama }}</p>
                                                <span class="text-[10px] text-slate-400">{{ $izin->created_at->diffForHumans() }}</span>
                                            </div>
                                            <p class="text-label-xs text-on-surface-variant truncate mb-2">{{ $izin->keterangan ?? '-' }}</p>

                                            <div class="flex items-center gap-2">
                                                <span class="px-2 py-0.5 rounded {{ $badgeBg }} {{ $badgeText }} text-[10px] font-bold uppercase">{{ $izin->jenis }}</span>
                                                <span class="text-[11px] text-slate-400 flex items-center gap-1">
                                                    <span class="material-symbols-outlined text-[14px]">description</span> Dokumen Terlampir
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="p-6 text-center text-slate-500">
                                    <span class="material-symbols-outlined text-3xl mb-2 text-slate-300">inbox</span>
                                    <p class="font-body-sm text-sm">Tidak ada pengajuan izin baru.</p>
                                </div>
                            @endforelse
                        </div>

                        <div class="p-4 mt-2">
                            <a href="#" class="block text-center w-full py-2 text-label-medium text-primary hover:bg-primary/5 rounded-lg border border-primary/20 transition-colors">Lihat Semua Pengajuan</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

