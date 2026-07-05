<x-app-layout>
    <div class="p-4 md:p-8 overflow-y-auto">
        {{-- Page Header --}}
        <div class="mb-6">
            <a href="{{ route('kelas.index') }}" class="inline-flex items-center gap-1 text-sm text-on-surface-variant hover:text-primary transition-colors mb-2">
                <span class="material-symbols-outlined text-[18px]">arrow_back</span>
                Kembali ke Daftar Kelas
            </a>
            <h2 class="font-headline-xl text-headline-xl font-bold text-on-surface">Detail Kelas</h2>
            <p class="text-sm text-on-surface-variant mt-1">Informasi lengkap mengenai data kelas.</p>
        </div>

        {{-- Detail Card --}}
        <div class="max-w-3xl mx-auto">
            <div class="bg-white rounded-xl border border-slate-200 shadow-soft p-6">

                {{-- Header with icon --}}
                <div class="flex items-center gap-4 mb-6">
                    <div class="w-14 h-14 rounded-xl bg-primary/10 text-primary font-bold flex items-center justify-center text-lg">
                        <span class="material-symbols-outlined text-[28px]">school</span>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-on-surface">{{ $kelas->nama_kelas }}</h3>
                        <p class="text-sm text-on-surface-variant">Angkatan {{ $kelas->angkatan }}</p>
                    </div>
                    <div class="ml-auto">
                        @if ($kelas->status)
                            <span class="px-3 py-1 rounded-full text-xs font-bold bg-green-100 text-green-700">Aktif</span>
                        @else
                            <span class="px-3 py-1 rounded-full text-xs font-bold bg-slate-100 text-slate-500">Nonaktif</span>
                        @endif
                    </div>
                </div>

                <hr class="border-slate-100 my-5">

                {{-- Data Fields --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div>
                        <p class="text-xs font-label-medium text-on-surface-variant uppercase tracking-wider">Nama Kelas</p>
                        <p class="mt-1 text-base font-medium text-on-surface">{{ $kelas->nama_kelas }}</p>
                    </div>
                    <div>
                        <p class="text-xs font-label-medium text-on-surface-variant uppercase tracking-wider">Angkatan</p>
                        <p class="mt-1 text-base font-medium text-on-surface">{{ $kelas->angkatan }}</p>
                    </div>
                    <div>
                        <p class="text-xs font-label-medium text-on-surface-variant uppercase tracking-wider">Kapasitas</p>
                        <p class="mt-1 text-base font-medium text-on-surface">{{ $kelas->kapasitas }} <span class="text-sm text-on-surface-variant font-normal">mahasiswa</span></p>
                    </div>
                    <div>
                        <p class="text-xs font-label-medium text-on-surface-variant uppercase tracking-wider">Status</p>
                        <div class="mt-1">
                            @if ($kelas->status)
                                <span class="px-3 py-1 rounded-full text-xs font-bold bg-green-100 text-green-700">Aktif</span>
                            @else
                                <span class="px-3 py-1 rounded-full text-xs font-bold bg-slate-100 text-slate-500">Nonaktif</span>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- Footer Actions --}}
                <div class="flex items-center justify-between mt-8 pt-6 border-t border-slate-100">
                    <a href="{{ route('kelas.index') }}" class="text-on-surface-variant hover:text-primary font-label-medium flex items-center gap-1 transition-colors">
                        <span class="material-symbols-outlined text-[18px]">arrow_back</span>
                        Kembali
                    </a>
                    @if (auth()->user()->isAdmin())
                        <a href="{{ route('kelas.edit', $kelas) }}" class="bg-primary hover:bg-primary-container text-white font-label-medium px-5 py-2.5 rounded-lg flex items-center gap-2 shadow-sm transition-colors">
                            <span class="material-symbols-outlined text-[18px]">edit</span>
                            Edit Data
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
