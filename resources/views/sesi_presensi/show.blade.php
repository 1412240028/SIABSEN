<x-app-layout>
    <div class="p-4 md:p-8 overflow-y-auto pb-24 md:pb-8">
        
        <!-- Page Header -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
            <div>
                <div class="flex items-center gap-2 mb-2">
                    <a href="{{ route('dosen.sesi_presensi.index') }}" class="text-slate-400 hover:text-primary transition-colors">
                        <span class="material-symbols-outlined text-[20px]">arrow_back</span>
                    </a>
                    <h2 class="font-headline-xl text-headline-xl font-bold text-on-surface">Panel Presensi Sesi</h2>
                </div>
                <p class="font-body-sm text-body-sm text-on-surface-variant ml-7">
                    {{ $sesiPresensi->jadwal->mataKuliah->nama }} - Kelas {{ $sesiPresensi->jadwal->kelas->nama_kelas }} (Pertemuan {{ $sesiPresensi->pertemuan_ke }})
                </p>
            </div>
            
            <div class="flex flex-wrap gap-3">
                @if ($sesiPresensi->status === 'OPEN')
                    <form method="POST" action="{{ route('dosen.sesi_presensi.close', $sesiPresensi) }}" class="inline-flex">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="bg-error hover:bg-error/90 text-white font-label-medium text-label-medium px-5 py-2.5 rounded-lg flex items-center gap-2 shadow-sm transition-colors">
                            <span class="material-symbols-outlined text-[20px]">stop_circle</span>
                            Tutup Sesi Presensi
                        </button>
                    </form>
                @endif

                @if ($sesiPresensi->status === 'CLOSED' && $belumPresensi->isNotEmpty())
                    <form method="POST" action="{{ route('dosen.sesi_presensi.mark-alpha', $sesiPresensi) }}" class="inline-flex">
                        @csrf
                        <button type="submit" onclick="return confirm('Tandai semua mahasiswa yang belum presensi ({{ $belumPresensi->count() }} orang) sebagai Alpha?')" class="bg-error hover:bg-error-container hover:text-error text-white font-label-medium text-label-medium px-5 py-2.5 rounded-lg flex items-center gap-2 shadow-sm transition-colors border border-transparent">
                            <span class="material-symbols-outlined text-[20px]">rule</span>
                            Tandai Alpha Sisa Mahasiswa
                        </button>
                    </form>
                @endif
            </div>
        </div>

        @if ($errors->any())
            <div class="mb-6 rounded-lg border border-error/20 bg-error-container/30 p-4 text-sm font-label-medium text-error flex items-center gap-3">
                <span class="material-symbols-outlined text-xl">error</span>
                <span>{{ $errors->first() }}</span>
            </div>
        @endif

        @php
            $statusCards = [
                ['key' => 'HADIR', 'label' => 'Hadir', 'icon' => 'check_circle', 'color' => 'text-status-hadir', 'bg' => 'bg-status-hadir/10'],
                ['key' => 'TERLAMBAT', 'label' => 'Terlambat', 'icon' => 'schedule', 'color' => 'text-status-terlambat', 'bg' => 'bg-status-terlambat/10'],
                ['key' => 'IZIN', 'label' => 'Izin', 'icon' => 'edit_document', 'color' => 'text-status-izin', 'bg' => 'bg-status-izin/10'],
                ['key' => 'SAKIT', 'label' => 'Sakit', 'icon' => 'local_hospital', 'color' => 'text-status-sakit', 'bg' => 'bg-status-sakit/10'],
                ['key' => 'ALPHA', 'label' => 'Alpha', 'icon' => 'cancel', 'color' => 'text-status-alpha', 'bg' => 'bg-status-alpha/10'],
            ];

            $badgeClasses = [
                'HADIR' => 'bg-status-hadir/10 text-status-hadir border-status-hadir/20',
                'TERLAMBAT' => 'bg-status-terlambat/10 text-status-terlambat border-status-terlambat/20',
                'IZIN' => 'bg-status-izin/10 text-status-izin border-status-izin/20',
                'SAKIT' => 'bg-status-sakit/10 text-status-sakit border-status-sakit/20',
                'ALPHA' => 'bg-status-alpha/10 text-status-alpha border-status-alpha/20',
            ];
        @endphp

        <!-- Top Section: Stats & Token -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
            
            <!-- Left: Attendance Stats Grid -->
            <div class="lg:col-span-2 bg-white rounded-xl border border-slate-200 shadow-soft p-6">
                <h3 class="font-headline-sm text-headline-sm font-bold text-on-surface mb-4">Statistik Kehadiran</h3>
                <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                    @foreach ($statusCards as $status)
                        <div class="rounded-lg border border-slate-100 p-4 flex flex-col {{ $status['bg'] }} transition-transform hover:-translate-y-1">
                            <div class="flex items-center justify-between mb-2">
                                <span class="font-label-medium text-sm {{ $status['color'] }}">{{ $status['label'] }}</span>
                                <span class="material-symbols-outlined {{ $status['color'] }} text-[20px]">{{ $status['icon'] }}</span>
                            </div>
                            <span class="font-display-sm text-display-sm font-bold {{ $status['color'] }}">{{ $statusCounts[$status['key']] ?? 0 }}</span>
                        </div>
                    @endforeach
                    <div class="rounded-lg border border-slate-200 bg-slate-50 p-4 flex flex-col transition-transform hover:-translate-y-1">
                        <div class="flex items-center justify-between mb-2">
                            <span class="font-label-medium text-sm text-slate-600">Belum Presensi</span>
                            <span class="material-symbols-outlined text-slate-400 text-[20px]">help</span>
                        </div>
                        <span class="font-display-sm text-display-sm font-bold text-slate-700">{{ $belumPresensi->count() }}</span>
                    </div>
                </div>
            </div>

            <!-- Right: Session Token & Info -->
            <div class="bg-primary-container rounded-xl border border-primary/20 shadow-soft p-6 flex flex-col justify-between relative overflow-hidden">
                <!-- Background decoration -->
                <span class="material-symbols-outlined absolute -right-6 -bottom-6 text-[150px] text-primary/5 select-none pointer-events-none">pin</span>
                
                <div>
                    <h3 class="font-headline-sm text-headline-sm font-bold text-on-primary-container flex items-center gap-2">
                        <span class="material-symbols-outlined">key</span> Token Sesi
                    </h3>
                    <p class="text-sm font-body-sm text-on-primary-container/80 mt-1">Gunakan token ini untuk presensi manual via aplikasi mahasiswa.</p>
                    
                    <div class="mt-6 mb-4">
                        <div class="bg-white/90 backdrop-blur rounded-xl p-4 text-center border border-white/50 shadow-inner">
                            <span class="font-display-md text-display-md font-bold tracking-[0.2em] text-primary font-numeric-token">{{ $sesiPresensi->token }}</span>
                        </div>
                    </div>
                </div>

                <div>
                    <div class="flex items-center justify-between text-xs font-label-sm text-on-primary-container/80 border-t border-primary/10 pt-3 mt-4">
                        <span>Status Sesi:</span>
                        @if ($sesiPresensi->status === 'OPEN')
                            <span class="inline-flex items-center gap-1.5 font-bold text-green-700 bg-green-100 px-2 py-1 rounded">
                                <span class="w-1.5 h-1.5 rounded-full bg-green-500 animate-pulse"></span>
                                BERJALAN
                            </span>
                        @else
                            <span class="font-bold text-slate-600 bg-slate-200 px-2 py-1 rounded">
                                {{ $sesiPresensi->status }}
                            </span>
                        @endif
                    </div>
                    <div class="flex items-center justify-between text-xs font-label-sm text-on-primary-container/80 mt-1">
                        <span>Buka:</span>
                        <span class="font-numeric-token">{{ $sesiPresensi->opened_at->format('H:i') }} WIB</span>
                    </div>
                </div>
            </div>
        </div>

        @if ($sesiPresensi->status === 'OPEN')
            <!-- Active Session Controls (QR & Manual Entry) -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
                <!-- QR Code Display -->
                <div class="bg-white rounded-xl border border-slate-200 shadow-soft p-6 flex flex-col items-center justify-center text-center">
                    <h3 class="font-headline-sm text-headline-sm font-bold text-on-surface mb-2">Scan QR Code</h3>
                    <p class="text-sm font-body-sm text-on-surface-variant mb-6 max-w-sm">Tampilkan QR code ini di layar proyektor agar mahasiswa dapat melakukan presensi mandiri menggunakan aplikasi mereka.</p>
                    
                    <div class="bg-white p-4 rounded-2xl shadow-sm border border-slate-100 inline-block">
                        {!! $qrCode !!}
                    </div>
                    
                    <button type="button" class="mt-6 bg-slate-100 hover:bg-slate-200 text-slate-700 font-label-medium text-sm px-4 py-2 rounded-lg flex items-center gap-2 transition-colors">
                        <span class="material-symbols-outlined text-[18px]">fullscreen</span>
                        Perbesar QR Code
                    </button>
                </div>

                <!-- Manual Input Form -->
                <div class="bg-white rounded-xl border border-slate-200 shadow-soft p-6">
                    <h3 class="font-headline-sm text-headline-sm font-bold text-on-surface mb-2">Presensi Manual</h3>
                    <p class="text-sm font-body-sm text-on-surface-variant mb-6">Ubah atau masukkan status kehadiran mahasiswa secara manual.</p>
                    
                    <form method="POST" action="{{ route('dosen.sesi_presensi.presensi.store', $sesiPresensi) }}" class="space-y-4">
                        @csrf
                        <input type="hidden" name="sesi_presensi_id" value="{{ $sesiPresensi->id }}" />
                        <input type="hidden" name="metode" value="MANUAL" />

                        <div>
                            <label for="mahasiswa_id" class="block font-label-medium text-sm text-on-surface mb-1.5">Pilih Mahasiswa</label>
                            <select id="mahasiswa_id" name="mahasiswa_id" class="w-full px-4 py-2.5 border border-outline-variant rounded-lg text-body-sm focus:border-primary focus:ring-1 focus:ring-primary bg-white transition-colors" required>
                                <option value="">-- Pilih Mahasiswa --</option>
                                @foreach ($mahasiswa as $mhs)
                                    <option value="{{ $mhs->id }}" {{ old('mahasiswa_id') == $mhs->id ? 'selected' : '' }}>{{ $mhs->nim }} - {{ $mhs->nama }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('mahasiswa_id')" class="mt-1 text-error text-xs" />
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label for="status" class="block font-label-medium text-sm text-on-surface mb-1.5">Status Kehadiran</label>
                                <select id="status" name="status" class="w-full px-4 py-2.5 border border-outline-variant rounded-lg text-body-sm focus:border-primary focus:ring-1 focus:ring-primary bg-white transition-colors" required>
                                    <option value="HADIR">Hadir</option>
                                    <option value="TERLAMBAT">Terlambat</option>
                                    <option value="IZIN">Izin</option>
                                    <option value="SAKIT">Sakit</option>
                                    <option value="ALPHA">Alpha</option>
                                </select>
                                <x-input-error :messages="$errors->get('status')" class="mt-1 text-error text-xs" />
                            </div>
                            <div>
                                <label for="catatan" class="block font-label-medium text-sm text-on-surface mb-1.5">Catatan (Opsional)</label>
                                <input id="catatan" name="catatan" type="text" class="w-full px-4 py-2.5 border border-outline-variant rounded-lg text-body-sm focus:border-primary focus:ring-1 focus:ring-primary bg-white transition-colors" value="{{ old('catatan') }}" placeholder="Keterangan..." />
                            </div>
                        </div>

                        <div class="pt-2">
                            <button type="submit" class="w-full bg-primary hover:bg-primary-container text-white font-label-medium px-4 py-2.5 rounded-lg flex justify-center items-center gap-2 shadow-sm transition-colors">
                                <span class="material-symbols-outlined text-[20px]">how_to_reg</span>
                                Simpan Status Presensi
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        @endif

        <!-- Daftar Mahasiswa Table -->
        <div class="bg-white rounded-xl border border-slate-200 shadow-soft flex flex-col overflow-hidden">
            <div class="p-5 border-b border-slate-200 bg-slate-50/50 flex justify-between items-center">
                <h3 class="font-headline-sm text-headline-sm font-bold text-on-surface">Detail Kehadiran Mahasiswa</h3>
                <span class="text-sm font-label-medium text-slate-500">Total: {{ $mahasiswa->count() }} Orang</span>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50 border-b border-slate-200 font-label-xs text-label-xs text-slate-500 uppercase tracking-wider">
                            <th class="px-6 py-4 font-medium">Mahasiswa</th>
                            <th class="px-6 py-4 font-medium">Status Kehadiran</th>
                            <th class="px-6 py-4 font-medium">Metode</th>
                            <th class="px-6 py-4 font-medium">Waktu Presensi</th>
                            <th class="px-6 py-4 font-medium">Catatan</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 font-body-sm text-body-sm text-on-surface">
                        @foreach ($mahasiswa as $mhs)
                            @php
                                $absen = $presensiByMahasiswa->get($mhs->id);
                            @endphp
                            <tr class="hover:bg-slate-50/80 transition-colors {{ !$absen ? 'bg-amber-50/30' : '' }}">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        @php
                                            $initials = collect(explode(' ', $mhs->nama))->take(2)->map(fn($w) => strtoupper(substr($w, 0, 1)))->join('');
                                        @endphp
                                        <div class="w-8 h-8 rounded-full bg-secondary-fixed-dim/20 text-secondary-fixed-dim font-bold text-xs flex items-center justify-center shrink-0">
                                            {{ $initials }}
                                        </div>
                                        <div>
                                            <p class="font-bold text-on-surface leading-tight">{{ $mhs->nama }}</p>
                                            <p class="text-xs text-slate-500 font-numeric-token mt-0.5">{{ $mhs->nim }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    @if ($absen)
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-md font-label-xs text-label-xs font-bold border {{ $badgeClasses[$absen->status] ?? 'bg-slate-100 text-slate-700 border-slate-200' }}">
                                            {{ $absen->status }}
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-md bg-slate-100 text-slate-500 font-label-xs text-label-xs font-bold border border-slate-200 border-dashed">
                                            BELUM PRESENSI
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-slate-600 font-label-sm text-xs">
                                    @if($absen && $absen->metode === 'QR_CODE')
                                        <span class="inline-flex items-center gap-1 text-primary"><span class="material-symbols-outlined text-[16px]">qr_code_scanner</span> QR</span>
                                    @elseif($absen && $absen->metode === 'TOKEN')
                                        <span class="inline-flex items-center gap-1 text-primary"><span class="material-symbols-outlined text-[16px]">key</span> Token</span>
                                    @elseif($absen && $absen->metode === 'MANUAL')
                                        <span class="inline-flex items-center gap-1 text-amber-600"><span class="material-symbols-outlined text-[16px]">edit_note</span> Manual</span>
                                    @else
                                        -
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-slate-600 font-numeric-token text-sm">
                                    {{ $absen?->waktu_presensi ? $absen->waktu_presensi->format('H:i') . ' WIB' : '-' }}
                                </td>
                                <td class="px-6 py-4 text-slate-600 text-sm">
                                    {{ $absen->catatan ?? '-' }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</x-app-layout>
