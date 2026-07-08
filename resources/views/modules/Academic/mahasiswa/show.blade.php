<x-app-layout>
    <div class="p-4 md:p-8 overflow-y-auto">
        {{-- Page Header --}}
        <div class="mb-6">
            <a href="{{ route('mahasiswa.index') }}" class="inline-flex items-center gap-1 text-sm text-on-surface-variant hover:text-primary transition-colors mb-2">
                <span class="material-symbols-outlined text-[18px]">arrow_back</span>
                Kembali ke Daftar Mahasiswa
            </a>
            <h2 class="font-headline-xl text-headline-xl font-bold text-on-surface">Detail Mahasiswa</h2>
            <p class="text-sm text-on-surface-variant mt-1">Informasi lengkap mengenai data mahasiswa.</p>
        </div>

        {{-- Detail Card --}}
        <div class="max-w-3xl mx-auto">
            <div class="bg-white rounded-xl border border-slate-200 shadow-soft p-6">

                {{-- Header with Avatar --}}
                <div class="flex items-center gap-4 mb-6">
                    <div class="w-16 h-16 rounded-full bg-secondary-fixed-dim/20 text-on-secondary-container font-bold flex items-center justify-center text-xl">
                        {{ strtoupper(substr($mahasiswa->nama, 0, 2)) }}
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-on-surface">{{ $mahasiswa->nama }}</h3>
                        <p class="text-sm text-on-surface-variant font-mono">NIM: {{ $mahasiswa->nim }}</p>
                    </div>
                </div>

                <hr class="border-slate-100 my-5">

                {{-- Data Fields --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div>
                        <p class="text-xs font-label-medium text-on-surface-variant uppercase tracking-wider">Nama Lengkap</p>
                        <p class="mt-1 text-base font-medium text-on-surface">{{ $mahasiswa->nama }}</p>
                    </div>
                    <div>
                        <p class="text-xs font-label-medium text-on-surface-variant uppercase tracking-wider">NIM</p>
                        <p class="mt-1 text-base font-medium text-on-surface font-mono">{{ $mahasiswa->nim }}</p>
                    </div>
                    <div>
                        <p class="text-xs font-label-medium text-on-surface-variant uppercase tracking-wider">Email</p>
                        <p class="mt-1 text-base font-medium text-on-surface">{{ $mahasiswa->user->email }}</p>
                    </div>
                    <div>
                        <p class="text-xs font-label-medium text-on-surface-variant uppercase tracking-wider">Kelas</p>
                        <p class="mt-1 text-base font-medium text-on-surface">{{ $mahasiswa->kelas->nama_kelas ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-xs font-label-medium text-on-surface-variant uppercase tracking-wider">Angkatan</p>
                        <p class="mt-1 text-base font-medium text-on-surface">{{ $mahasiswa->angkatan }}</p>
                    </div>
                    <div>
                        <p class="text-xs font-label-medium text-on-surface-variant uppercase tracking-wider">Jenis Kelamin</p>
                        <p class="mt-1 text-base font-medium text-on-surface">{{ $mahasiswa->jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan' }}</p>
                    </div>
                    <div>
                        <p class="text-xs font-label-medium text-on-surface-variant uppercase tracking-wider">Tanggal Lahir</p>
                        <p class="mt-1 text-base font-medium text-on-surface">{{ $mahasiswa->tanggal_lahir?->format('d M Y') ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-xs font-label-medium text-on-surface-variant uppercase tracking-wider">No. HP</p>
                        <p class="mt-1 text-base font-medium text-on-surface">{{ $mahasiswa->no_hp ?? '-' }}</p>
                    </div>
                    <div class="sm:col-span-2">
                        <p class="text-xs font-label-medium text-on-surface-variant uppercase tracking-wider">Alamat</p>
                        <p class="mt-1 text-base font-medium text-on-surface">{{ $mahasiswa->alamat ?? '-' }}</p>
                    </div>
                </div>

                {{-- Footer Actions --}}
                <div class="flex items-center justify-between mt-8 pt-6 border-t border-slate-100">
                    <a href="{{ route('mahasiswa.index') }}" class="text-on-surface-variant hover:text-primary font-label-medium flex items-center gap-1 transition-colors">
                        <span class="material-symbols-outlined text-[18px]">arrow_back</span>
                        Kembali
                    </a>
                    @if (auth()->user()->isAdmin())
                        <a href="{{ route('mahasiswa.edit', $mahasiswa) }}" class="bg-primary hover:bg-primary-container text-white font-label-medium px-5 py-2.5 rounded-lg flex items-center gap-2 shadow-sm transition-colors">
                            <span class="material-symbols-outlined text-[18px]">edit</span>
                            Edit Data
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

