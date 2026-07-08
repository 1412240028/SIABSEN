<x-app-layout>
    @php
        $dayNames = [0=>'Minggu',1=>'Senin',2=>'Selasa',3=>'Rabu',4=>'Kamis',5=>'Jumat',6=>'Sabtu'];
        $hariIni = $dayNames[now()->dayOfWeek];
        $jadwalHariIni = $mahasiswa
            ? \App\Models\Jadwal::with(['mataKuliah', 'kelas', 'dosen'])
                ->where('kelas_id', $mahasiswa->kelas_id)
                ->where('status', true)
                ->where('hari', $hariIni)
                ->orderBy('jam_mulai')
                ->get()
            : collect();
    @endphp

    <div class="p-4 lg:p-8 overflow-y-auto pb-24 md:pb-8">
        <!-- Header Section -->
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-8">
            <div>
                <h2 class="font-headline-2xl text-headline-2xl font-bold text-on-surface mb-1">
                    Selamat datang kembali, {{ $mahasiswa->nama ?? auth()->user()->name }}!
                </h2>
                <p class="font-body-base text-body-base text-on-surface-variant">
                    Semester Ganjil 2024/2025 • {{ $mahasiswa->kelas->nama_kelas ?? '-' }}
                </p>
            </div>
            <a href="{{ route('mahasiswa.presensi.scan.form') }}" class="bg-secondary-container text-on-secondary-container hover:bg-secondary-fixed-dim transition-colors font-headline-lg text-headline-lg px-6 py-3 rounded-lg flex items-center gap-2 shadow-sm font-bold w-full md:w-auto justify-center">
                <span class="material-symbols-outlined" data-weight="fill">qr_code_scanner</span>
                Presensi Sekarang
            </a>
        </div>

        <!-- Dashboard Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-grid-gap-mobile lg:gap-grid-gap-desktop">

            <!-- Left Column (Stats & Schedule) -->
            <div class="lg:col-span-8 flex flex-col gap-grid-gap-mobile lg:gap-grid-gap-desktop">

                <!-- Stats Bento -->
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">

                    <!-- Stat Card 1 -->
                    <div class="bg-white p-card-padding rounded-xl border border-slate-200 shadow-soft flex flex-col justify-between">
                        <div class="flex items-center justify-between mb-2">
                            <p class="font-label-xs text-label-xs text-on-surface-variant uppercase tracking-wide">Tingkat Kehadiran</p>
                            <span class="material-symbols-outlined text-primary">analytics</span>
                        </div>
                        <div class="flex items-end gap-2">
                            <span class="font-numeric-token text-3xl font-bold text-on-surface leading-none">{{ $attendancePercentage }}%</span>
                            <span class="font-label-xs text-label-xs text-status-hadir flex items-center bg-green-50 px-1.5 py-0.5 rounded">
                                <span class="material-symbols-outlined text-[14px]">trending_up</span> +2%
                            </span>
                        </div>
                    </div>

                    <!-- Stat Card 2 -->
                    <div class="bg-white p-card-padding rounded-xl border border-slate-200 shadow-soft flex flex-col justify-between">
                        <div class="flex items-center justify-between mb-2">
                            <p class="font-label-xs text-label-xs text-on-surface-variant uppercase tracking-wide">Hadir</p>
                            <div class="w-6 h-6 rounded-full bg-green-100 flex items-center justify-center">
                                <span class="material-symbols-outlined text-status-hadir text-[16px]" data-weight="fill">check_circle</span>
                            </div>
                        </div>
                        <div class="flex items-end gap-2">
                            <span class="font-numeric-token text-3xl font-bold text-on-surface leading-none">{{ $statusCounts['HADIR'] + $statusCounts['TERLAMBAT'] }}</span>
                            <span class="font-body-sm text-body-sm text-on-surface-variant">Sesi</span>
                        </div>
                    </div>

                    <!-- Stat Card 3 -->
                    <div class="bg-white p-card-padding rounded-xl border border-slate-200 shadow-soft flex flex-col justify-between">
                        <div class="flex items-center justify-between mb-2">
                            <p class="font-label-xs text-label-xs text-on-surface-variant uppercase tracking-wide">Sakit/Izin</p>
                            <div class="w-6 h-6 rounded-full bg-blue-100 flex items-center justify-center">
                                <span class="material-symbols-outlined text-status-izin text-[16px]" data-weight="fill">info</span>
                            </div>
                        </div>
                        <div class="flex items-end gap-2">
                            <span class="font-numeric-token text-3xl font-bold text-on-surface leading-none">{{ $statusCounts['SAKIT'] + $statusCounts['IZIN'] }}</span>
                            <span class="font-body-sm text-body-sm text-on-surface-variant">Sesi</span>
                        </div>
                    </div>

                    <!-- Stat Card 4 -->
                    <div class="bg-white p-card-padding rounded-xl border border-slate-200 shadow-soft flex flex-col justify-between">
                        <div class="flex items-center justify-between mb-2">
                            <p class="font-label-xs text-label-xs text-on-surface-variant uppercase tracking-wide">Alpa</p>
                            <div class="w-6 h-6 rounded-full bg-red-100 flex items-center justify-center">
                                <span class="material-symbols-outlined text-status-alpa text-[16px]" data-weight="fill">cancel</span>
                            </div>
                        </div>
                        <div class="flex items-end gap-2">
                            <span class="font-numeric-token text-3xl font-bold text-on-surface leading-none">{{ $statusCounts['ALPHA'] }}</span>
                            <span class="font-body-sm text-body-sm text-on-surface-variant">Sesi</span>
                        </div>
                    </div>

                </div>

                <!-- Schedule Table -->
                <div class="bg-white rounded-xl border border-slate-200 shadow-soft overflow-hidden flex flex-col h-full">
                    <div class="p-4 border-b border-slate-200 flex items-center justify-between bg-slate-50">
                        <h3 class="font-headline-lg text-headline-lg font-bold text-on-surface">Jadwal Kuliah Hari Ini <span class="text-sm font-normal text-slate-500">({{ $hariIni }})</span></h3>
                        <a href="{{ route('mahasiswa.presensi.history') }}" class="text-primary font-label-medium text-label-medium hover:underline flex items-center gap-1">
                            Lihat Semua <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
                        </a>
                    </div>

                    @if($jadwalHariIni->isEmpty())
                        <div class="px-6 py-12 text-center text-slate-500">
                            <span class="material-symbols-outlined text-4xl mb-2 text-slate-300">calendar_today</span>
                            <p class="font-body-sm">Tidak ada jadwal kuliah hari ini.</p>
                        </div>
                    @else
                        <div class="overflow-x-auto">
                            <table class="w-full text-left border-collapse">
                                <thead>
                                    <tr class="bg-slate-50 border-b border-slate-200 font-label-xs text-label-xs text-on-surface-variant uppercase tracking-wider">
                                        <th class="py-3 px-4 font-medium">Waktu</th>
                                        <th class="py-3 px-4 font-medium">Mata Kuliah</th>
                                        <th class="py-3 px-4 font-medium">Ruang</th>
                                        <th class="py-3 px-4 font-medium">Dosen</th>
                                        <th class="py-3 px-4 font-medium text-right">Status Presensi</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-100">
                                    @foreach($jadwalHariIni as $jadwal)
                                        @php
                                            $presensiStatus = null;
                                            if ($mahasiswa) {
                                                $sesiForJadwal = \App\Models\SesiPresensi::where('jadwal_id', $jadwal->id)
                                                    ->whereDate('tanggal', today())
                                                    ->first();
                                                if ($sesiForJadwal) {
                                                    $existingPresensi = \App\Models\Presensi::where('sesi_presensi_id', $sesiForJadwal->id)
                                                        ->where('mahasiswa_id', $mahasiswa->id)
                                                        ->first();
                                                    if ($existingPresensi) {
                                                        $presensiStatus = $existingPresensi->status;
                                                    } elseif ($sesiForJadwal->status === 'OPEN') {
                                                        $presensiStatus = 'SCAN_AVAILABLE';
                                                    }
                                                }
                                            }
                                            $dosenName = optional($jadwal->dosen)->nama ?? '-';
                                            $dosenInitials = collect(explode(' ', $dosenName))->take(2)->map(fn($w) => strtoupper(substr($w, 0, 1)))->join('');
                                        @endphp
                                        <tr class="hover:bg-slate-50 transition-colors {{ $presensiStatus === 'SCAN_AVAILABLE' ? 'border-l-2 border-l-secondary-container bg-surface-bright' : '' }}">
                                            <td class="py-4 px-4 font-numeric-token text-numeric-token text-on-surface whitespace-nowrap">
                                                {{ \Carbon\Carbon::parse($jadwal->jam_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($jadwal->jam_selesai)->format('H:i') }}
                                            </td>
                                            <td class="py-4 px-4">
                                                <div class="font-label-medium text-label-medium text-on-surface font-semibold">{{ $jadwal->mataKuliah->nama }}</div>
                                                <div class="font-body-sm text-body-sm text-on-surface-variant">{{ $jadwal->mataKuliah->kode }} • {{ $jadwal->kelas->nama_kelas }}</div>
                                            </td>
                                            <td class="py-4 px-4 font-body-sm text-body-sm text-on-surface-variant">{{ $jadwal->ruangan ?? '-' }}</td>
                                            <td class="py-4 px-4">
                                                <div class="flex items-center gap-2">
                                                    <div class="w-6 h-6 rounded-full bg-slate-200 flex items-center justify-center text-xs font-bold text-slate-600">{{ $dosenInitials }}</div>
                                                    <span class="font-body-sm text-body-sm text-on-surface">{{ $dosenName }}</span>
                                                </div>
                                            </td>
                                            <td class="py-4 px-4 text-right">
                                                @if($presensiStatus === 'HADIR' || $presensiStatus === 'TERLAMBAT')
                                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-green-100 text-status-hadir font-label-xs text-label-xs font-bold">
                                                        <span class="material-symbols-outlined text-[14px]" data-weight="fill">check_circle</span> {{ $presensiStatus === 'TERLAMBAT' ? 'Terlambat' : 'Hadir' }}
                                                    </span>
                                                @elseif($presensiStatus === 'SCAN_AVAILABLE')
                                                    <a href="{{ route('mahasiswa.presensi.scan.form') }}" class="bg-secondary-container text-on-secondary-container hover:bg-secondary-fixed-dim px-3 py-1.5 rounded-lg font-label-xs text-label-xs font-bold transition-colors shadow-sm inline-flex items-center gap-1">
                                                        <span class="material-symbols-outlined text-[14px]">qr_code_scanner</span> Scan
                                                    </a>
                                                @elseif($presensiStatus === 'IZIN' || $presensiStatus === 'SAKIT')
                                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-blue-100 text-status-izin font-label-xs text-label-xs font-bold">
                                                        {{ $presensiStatus }}
                                                    </span>
                                                @elseif($presensiStatus === 'ALPHA')
                                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-red-100 text-status-alpa font-label-xs text-label-xs font-bold">
                                                        Alpha
                                                    </span>
                                                @else
                                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-slate-100 text-slate-500 font-label-xs text-label-xs font-medium">
                                                        Belum Mulai
                                                    </span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>

                <!-- Right Column (Announcements & Quick Links) -->
                <div class="lg:col-span-4 flex flex-col gap-grid-gap-mobile lg:gap-grid-gap-desktop">

                    <!-- Announcements -->
                    <div class="bg-white rounded-xl border border-slate-200 shadow-soft overflow-hidden flex flex-col h-full">
                        <div class="p-4 border-b border-slate-200 flex items-center justify-between bg-slate-50">
                            <h3 class="font-headline-lg text-headline-lg font-bold text-on-surface flex items-center gap-2">
                                <span class="material-symbols-outlined text-primary">campaign</span> Pengumuman
                            </h3>
                        </div>
                        <div class="p-0 divide-y divide-slate-100 flex-1 overflow-y-auto">
                            @forelse($pengumuman as $p)
                                @php
                                    if ($p->kategori === 'PENTING') {
                                        $badgeBg = 'bg-red-100';
                                        $badgeText = 'text-red-700';
                                    } elseif ($p->kategori === 'AKADEMIK') {
                                        $badgeBg = 'bg-blue-100';
                                        $badgeText = 'text-blue-700';
                                    } else {
                                        $badgeBg = 'bg-slate-100';
                                        $badgeText = 'text-slate-700';
                                    }
                                @endphp
                                <div class="p-4 hover:bg-slate-50 transition-colors cursor-pointer group">
                                    <div class="flex items-center justify-between mb-1">
                                        <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-bold uppercase tracking-wider {{ $badgeBg }} {{ $badgeText }}">{{ $p->kategori ?? 'Umum' }}</span>
                                        <span class="font-label-xs text-label-xs text-on-surface-variant">{{ $p->created_at->diffForHumans() }}</span>
                                    </div>
                                    <h4 class="font-label-medium text-label-medium font-bold text-on-surface group-hover:text-primary transition-colors">{{ $p->judul }}</h4>
                                    <p class="font-body-sm text-body-sm text-on-surface-variant mt-1 line-clamp-2">{{ $p->konten }}</p>
                                </div>
                            @empty
                                <div class="p-6 text-center text-slate-500">
                                    <span class="material-symbols-outlined text-3xl mb-2 text-slate-300">campaign</span>
                                    <p class="font-body-sm text-sm">Tidak ada pengumuman saat ini.</p>
                                </div>
                            @endforelse
                        </div>
                        <div class="p-3 border-t border-slate-200 bg-slate-50 text-center">
                            <a href="#" class="font-label-medium text-label-medium text-primary hover:underline font-medium">Lihat Semua Pengumuman</a>
                        </div>
                    </div>

                    <!-- Quick Actions -->
                    <div class="bg-primary rounded-xl p-card-padding text-white shadow-card relative overflow-hidden">
                        <div class="absolute -right-8 -top-8 w-32 h-32 bg-white opacity-10 rounded-full blur-2xl"></div>
                        <h3 class="font-headline-lg text-headline-lg font-bold mb-4 relative z-10">Aksi Cepat</h3>
                        <div class="grid grid-cols-2 gap-3 relative z-10">
                            <a href="{{ route('izin.create') }}" class="bg-primary-container hover:bg-surface-tint transition-colors p-3 rounded-lg flex flex-col items-center justify-center text-center gap-2 border border-primary-fixed-dim/30">
                                <span class="material-symbols-outlined text-on-primary-container">description</span>
                                <span class="font-label-xs text-label-xs font-medium text-on-primary-container">Surat Izin</span>
                            </a>
                            <a href="{{ route('komplain.create') }}" class="bg-primary-container hover:bg-surface-tint transition-colors p-3 rounded-lg flex flex-col items-center justify-center text-center gap-2 border border-primary-fixed-dim/30">
                                <span class="material-symbols-outlined text-on-primary-container">pending_actions</span>
                                <span class="font-label-xs text-label-xs font-medium text-on-primary-container">Komplain Presensi</span>
                            </a>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
</x-app-layout>

