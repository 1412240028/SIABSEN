<x-app-layout>
    <div class="p-4 md:p-8 overflow-y-auto">
        {{-- Page Header --}}
        <div class="mb-6">
            <a href="{{ route('admin.jadwal.index') }}" class="inline-flex items-center gap-1 text-sm text-on-surface-variant hover:text-primary transition-colors mb-2">
                <span class="material-symbols-outlined text-[18px]">arrow_back</span>
                Kembali ke Daftar Jadwal
            </a>
            <h2 class="font-headline-xl text-headline-xl font-bold text-on-surface">Detail Jadwal Kuliah</h2>
            <p class="text-sm text-on-surface-variant mt-1">Informasi lengkap mengenai jadwal perkuliahan.</p>
        </div>

        {{-- Detail Card --}}
        <div class="max-w-3xl mx-auto">
            <div class="bg-white rounded-xl border border-slate-200 shadow-soft p-6">

                {{-- Section 1: Informasi Akademik --}}
                <h3 class="font-bold text-on-surface flex items-center gap-2 mb-4">
                    <span class="material-symbols-outlined text-primary">menu_book</span>
                    Informasi Akademik
                </h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div>
                        <p class="text-xs font-label-medium text-on-surface-variant uppercase tracking-wider">Mata Kuliah</p>
                        <p class="mt-1 text-base font-medium text-on-surface">{{ $jadwal->mataKuliah->nama }}</p>
                    </div>
                    <div>
                        <p class="text-xs font-label-medium text-on-surface-variant uppercase tracking-wider">Kode</p>
                        <p class="mt-1 text-base font-medium text-on-surface font-mono">{{ $jadwal->mataKuliah->kode }}</p>
                    </div>
                    <div>
                        <p class="text-xs font-label-medium text-on-surface-variant uppercase tracking-wider">Dosen Pengampu</p>
                        <p class="mt-1 text-base font-medium text-on-surface">{{ $jadwal->dosen->nama }}</p>
                    </div>
                    <div>
                        <p class="text-xs font-label-medium text-on-surface-variant uppercase tracking-wider">Kelas</p>
                        <p class="mt-1 text-base font-medium text-on-surface">{{ $jadwal->kelas->nama_kelas }}</p>
                    </div>
                </div>

                <hr class="border-slate-100 my-6">

                {{-- Section 2: Waktu & Tempat --}}
                <h3 class="font-bold text-on-surface flex items-center gap-2 mb-4">
                    <span class="material-symbols-outlined text-primary">schedule</span>
                    Waktu & Tempat
                </h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div>
                        <p class="text-xs font-label-medium text-on-surface-variant uppercase tracking-wider">Hari</p>
                        <p class="mt-1">
                            <span class="inline-flex px-3 py-1 rounded-full text-xs font-bold bg-primary/10 text-primary">{{ $jadwal->hari }}</span>
                        </p>
                    </div>
                    <div>
                        <p class="text-xs font-label-medium text-on-surface-variant uppercase tracking-wider">Jam</p>
                        <p class="mt-1 text-base font-medium text-on-surface font-mono">{{ substr($jadwal->jam_mulai, 0, 5) }} - {{ substr($jadwal->jam_selesai, 0, 5) }}</p>
                    </div>
                    <div>
                        <p class="text-xs font-label-medium text-on-surface-variant uppercase tracking-wider">Ruangan</p>
                        <p class="mt-1 text-base font-medium text-on-surface">{{ $jadwal->ruangan ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-xs font-label-medium text-on-surface-variant uppercase tracking-wider">Status</p>
                        <div class="mt-1">
                            @if ($jadwal->status)
                                <span class="px-3 py-1 rounded-full text-xs font-bold bg-green-100 text-green-700">Aktif</span>
                            @else
                                <span class="px-3 py-1 rounded-full text-xs font-bold bg-slate-100 text-slate-500">Nonaktif</span>
                            @endif
                        </div>
                    </div>
                </div>

                <hr class="border-slate-100 my-6">

                {{-- Section 3: Periode --}}
                <h3 class="font-bold text-on-surface flex items-center gap-2 mb-4">
                    <span class="material-symbols-outlined text-primary">date_range</span>
                    Periode
                </h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div>
                        <p class="text-xs font-label-medium text-on-surface-variant uppercase tracking-wider">Semester</p>
                        <p class="mt-1 text-base font-medium text-on-surface">{{ $jadwal->semester }}</p>
                    </div>
                    <div>
                        <p class="text-xs font-label-medium text-on-surface-variant uppercase tracking-wider">Tahun Ajaran</p>
                        <p class="mt-1 text-base font-medium text-on-surface">{{ $jadwal->tahun_ajaran }}</p>
                    </div>
                </div>

                {{-- Footer Actions --}}
                <div class="flex items-center justify-between mt-8 pt-6 border-t border-slate-100">
                    <a href="{{ route('admin.jadwal.index') }}" class="text-on-surface-variant hover:text-primary font-label-medium flex items-center gap-1 transition-colors">
                        <span class="material-symbols-outlined text-[18px]">arrow_back</span>
                        Kembali
                    </a>
                    <a href="{{ route('admin.jadwal.edit', $jadwal) }}" class="bg-primary hover:bg-primary-container text-white font-label-medium px-5 py-2.5 rounded-lg flex items-center gap-2 shadow-sm transition-colors">
                        <span class="material-symbols-outlined text-[18px]">edit</span>
                        Edit Data
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

