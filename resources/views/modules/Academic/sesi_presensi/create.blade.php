<x-app-layout>
    <div class="p-4 md:p-8 overflow-y-auto">
        {{-- Page Header --}}
        <div class="mb-6">
            <a href="{{ route('dosen.sesi_presensi.index') }}" class="inline-flex items-center gap-1 text-sm text-on-surface-variant hover:text-primary transition-colors mb-2">
                <span class="material-symbols-outlined text-[18px]">arrow_back</span>
                Kembali ke Daftar Sesi
            </a>
            <h2 class="font-headline-xl text-headline-xl font-bold text-on-surface">Buat Sesi Presensi Baru</h2>
            <p class="text-sm text-on-surface-variant mt-1">Buat sesi presensi baru untuk kelas Anda.</p>
        </div>

        {{-- Form Card --}}
        <div class="max-w-3xl mx-auto">
            <form method="POST" action="{{ route('dosen.sesi_presensi.store') }}">
                @csrf
                <div class="bg-white rounded-xl border border-slate-200 shadow-soft p-6">

                    {{-- Section 1: Pilih Jadwal --}}
                    <h3 class="font-bold text-on-surface flex items-center gap-2 mb-4">
                        <span class="material-symbols-outlined text-primary">event</span>
                        Pilih Jadwal
                    </h3>
                    <div class="mb-6">
                        <label for="jadwal_id" class="block text-sm font-label-medium text-on-surface-variant mb-1.5">Jadwal Kuliah</label>
                        <select id="jadwal_id" name="jadwal_id" class="w-full px-4 py-2.5 border border-outline-variant rounded-lg text-body-sm font-body-sm focus:border-primary focus:ring-2 focus:ring-primary/20 bg-white transition-colors" required>
                            <option value="">-- Pilih Jadwal --</option>
                            @foreach ($jadwal as $item)
                                <option value="{{ $item->id }}" {{ old('jadwal_id', $selectedJadwalId ?? '') == $item->id ? 'selected' : '' }}>
                                    {{ $item->mataKuliah->nama }} - {{ $item->kelas->nama_kelas }} ({{ $item->hari }} {{ substr($item->jam_mulai, 0, 5) }}-{{ substr($item->jam_selesai, 0, 5) }})
                                </option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('jadwal_id')" class="mt-2" />
                    </div>

                    <hr class="border-slate-100 my-5">

                    {{-- Section 2: Detail Pertemuan --}}
                    <h3 class="font-bold text-on-surface flex items-center gap-2 mb-4">
                        <span class="material-symbols-outlined text-primary">class</span>
                        Detail Pertemuan
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                        <div>
                            <label for="pertemuan_ke" class="block text-sm font-label-medium text-on-surface-variant mb-1.5">Pertemuan ke</label>
                            <input type="number" id="pertemuan_ke" name="pertemuan_ke" value="{{ old('pertemuan_ke', 1) }}" min="1" class="w-full px-4 py-2.5 border border-outline-variant rounded-lg text-body-sm font-body-sm focus:border-primary focus:ring-2 focus:ring-primary/20 bg-white transition-colors" required>
                            <x-input-error :messages="$errors->get('pertemuan_ke')" class="mt-2" />
                        </div>
                        <div>
                            <label for="tanggal" class="block text-sm font-label-medium text-on-surface-variant mb-1.5">Tanggal</label>
                            <input type="date" id="tanggal" name="tanggal" value="{{ old('tanggal', now()->toDateString()) }}" class="w-full px-4 py-2.5 border border-outline-variant rounded-lg text-body-sm font-body-sm focus:border-primary focus:ring-2 focus:ring-primary/20 bg-white transition-colors" required>
                            <x-input-error :messages="$errors->get('tanggal')" class="mt-2" />
                        </div>
                    </div>

                    <hr class="border-slate-100 my-5">

                    {{-- Section 3: Waktu Sesi --}}
                    <h3 class="font-bold text-on-surface flex items-center gap-2 mb-4">
                        <span class="material-symbols-outlined text-primary">schedule</span>
                        Waktu Sesi
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                        <div>
                            <label for="opened_at" class="block text-sm font-label-medium text-on-surface-variant mb-1.5">Waktu Buka</label>
                            <input type="datetime-local" id="opened_at" name="opened_at" value="{{ old('opened_at', now()->format('Y-m-d\TH:i')) }}" class="w-full px-4 py-2.5 border border-outline-variant rounded-lg text-body-sm font-body-sm focus:border-primary focus:ring-2 focus:ring-primary/20 bg-white transition-colors" required>
                            <x-input-error :messages="$errors->get('opened_at')" class="mt-2" />
                        </div>
                        <div>
                            <label for="expired_at" class="block text-sm font-label-medium text-on-surface-variant mb-1.5">Waktu Tutup</label>
                            <input type="datetime-local" id="expired_at" name="expired_at" value="{{ old('expired_at', now()->addHours(2)->format('Y-m-d\TH:i')) }}" class="w-full px-4 py-2.5 border border-outline-variant rounded-lg text-body-sm font-body-sm focus:border-primary focus:ring-2 focus:ring-primary/20 bg-white transition-colors" required>
                            <x-input-error :messages="$errors->get('expired_at')" class="mt-2" />
                        </div>
                    </div>

                    <hr class="border-slate-100 my-5">

                    {{-- Footer Actions --}}
                    <div class="flex justify-end gap-3">
                        <a href="{{ route('dosen.sesi_presensi.index') }}" class="px-5 py-2.5 border border-outline-variant text-on-surface-variant font-label-medium rounded-lg hover:bg-slate-100 transition-colors">
                            Batal
                        </a>
                        <button type="submit" class="bg-primary hover:bg-primary-container text-white font-label-medium px-5 py-2.5 rounded-lg flex items-center gap-2 shadow-sm transition-colors">
                            <span class="material-symbols-outlined text-[18px]">add_circle</span>
                            Buat Sesi
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
