<x-app-layout>
    <div class="p-4 md:p-8 overflow-y-auto pb-24 md:pb-8">
        <!-- Page Header -->
        <div class="mb-8">
            <div class="flex items-center gap-2 mb-2">
                <a href="{{ route('admin.jadwal.index') }}" class="text-slate-400 hover:text-primary transition-colors">
                    <span class="material-symbols-outlined text-[20px]">arrow_back</span>
                </a>
                <h2 class="font-headline-xl text-headline-xl font-bold text-on-surface">Edit Jadwal Kuliah</h2>
            </div>
            <p class="font-body-sm text-body-sm text-on-surface-variant ml-7">Perbarui informasi jadwal perkuliahan mata kuliah {{ $jadwal->mataKuliah->nama }}.</p>
        </div>

        <div class="max-w-4xl">
            <div class="bg-white rounded-xl border border-slate-200 shadow-soft overflow-hidden">
                <form method="POST" action="{{ route('admin.jadwal.update', $jadwal) }}">
                    @csrf
                    @method('PUT')
                    
                    <div class="p-6 space-y-8">
                        
                        <!-- Seksi 1: Informasi Akademik -->
                        <div class="space-y-4">
                            <h3 class="font-headline-sm text-headline-sm font-bold text-on-surface flex items-center gap-2 border-b border-slate-100 pb-2">
                                <span class="material-symbols-outlined text-primary text-xl">school</span>
                                Informasi Akademik
                            </h3>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Mata Kuliah -->
                                <div class="md:col-span-2">
                                    <label for="mata_kuliah_id" class="block font-label-medium text-label-medium text-on-surface mb-2">Mata Kuliah <span class="text-error">*</span></label>
                                    <select id="mata_kuliah_id" name="mata_kuliah_id" class="w-full px-4 py-2 border border-outline-variant rounded-lg text-body-sm focus:border-primary focus:ring-1 focus:ring-primary bg-white transition-colors" required autofocus>
                                        <option value="">-- Pilih Mata Kuliah --</option>
                                        @foreach ($mataKuliah as $mata)
                                            <option value="{{ $mata->id }}" {{ old('mata_kuliah_id', $jadwal->mata_kuliah_id) == $mata->id ? 'selected' : '' }}>{{ $mata->kode }} - {{ $mata->nama }} ({{ $mata->sks }} SKS)</option>
                                        @endforeach
                                    </select>
                                    <x-input-error :messages="$errors->get('mata_kuliah_id')" class="mt-2 text-error text-xs" />
                                </div>

                                <!-- Dosen -->
                                <div>
                                    <label for="dosen_id" class="block font-label-medium text-label-medium text-on-surface mb-2">Dosen Pengampu <span class="text-error">*</span></label>
                                    <select id="dosen_id" name="dosen_id" class="w-full px-4 py-2 border border-outline-variant rounded-lg text-body-sm focus:border-primary focus:ring-1 focus:ring-primary bg-white transition-colors" required>
                                        <option value="">-- Pilih Dosen --</option>
                                        @foreach ($dosens as $dosen)
                                            <option value="{{ $dosen->id }}" {{ old('dosen_id', $jadwal->dosen_id) == $dosen->id ? 'selected' : '' }}>{{ $dosen->nama }}</option>
                                        @endforeach
                                    </select>
                                    <x-input-error :messages="$errors->get('dosen_id')" class="mt-2 text-error text-xs" />
                                </div>

                                <!-- Kelas -->
                                <div>
                                    <label for="kelas_id" class="block font-label-medium text-label-medium text-on-surface mb-2">Kelas <span class="text-error">*</span></label>
                                    <select id="kelas_id" name="kelas_id" class="w-full px-4 py-2 border border-outline-variant rounded-lg text-body-sm focus:border-primary focus:ring-1 focus:ring-primary bg-white transition-colors" required>
                                        <option value="">-- Pilih Kelas --</option>
                                        @foreach ($kelas as $kelasItem)
                                            <option value="{{ $kelasItem->id }}" {{ old('kelas_id', $jadwal->kelas_id) == $kelasItem->id ? 'selected' : '' }}>{{ $kelasItem->nama_kelas }} ({{ $kelasItem->angkatan }})</option>
                                        @endforeach
                                    </select>
                                    <x-input-error :messages="$errors->get('kelas_id')" class="mt-2 text-error text-xs" />
                                </div>
                            </div>
                        </div>

                        <!-- Seksi 2: Waktu & Tempat -->
                        <div class="space-y-4">
                            <h3 class="font-headline-sm text-headline-sm font-bold text-on-surface flex items-center gap-2 border-b border-slate-100 pb-2">
                                <span class="material-symbols-outlined text-primary text-xl">event</span>
                                Waktu & Tempat
                            </h3>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Hari & Ruangan -->
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label for="hari" class="block font-label-medium text-label-medium text-on-surface mb-2">Hari <span class="text-error">*</span></label>
                                        <select id="hari" name="hari" class="w-full px-4 py-2 border border-outline-variant rounded-lg text-body-sm focus:border-primary focus:ring-1 focus:ring-primary bg-white transition-colors" required>
                                            <option value="">-- Hari --</option>
                                            @foreach(['Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'] as $hari)
                                                <option value="{{ $hari }}" {{ old('hari', $jadwal->hari) == $hari ? 'selected' : '' }}>{{ $hari }}</option>
                                            @endforeach
                                        </select>
                                        <x-input-error :messages="$errors->get('hari')" class="mt-2 text-error text-xs" />
                                    </div>
                                    <div>
                                        <label for="ruangan" class="block font-label-medium text-label-medium text-on-surface mb-2">Ruangan <span class="text-error">*</span></label>
                                        <input id="ruangan" name="ruangan" type="text" class="w-full px-4 py-2 border border-outline-variant rounded-lg text-body-sm focus:border-primary focus:ring-1 focus:ring-primary bg-white transition-colors uppercase" value="{{ old('ruangan', $jadwal->ruangan) }}" placeholder="Misal: A101" required />
                                        <x-input-error :messages="$errors->get('ruangan')" class="mt-2 text-error text-xs" />
                                    </div>
                                </div>

                                <!-- Jam Mulai & Selesai -->
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label for="jam_mulai" class="block font-label-medium text-label-medium text-on-surface mb-2">Jam Mulai <span class="text-error">*</span></label>
                                        <input id="jam_mulai" name="jam_mulai" type="time" class="w-full px-4 py-2 border border-outline-variant rounded-lg text-body-sm focus:border-primary focus:ring-1 focus:ring-primary bg-white transition-colors font-numeric-token" value="{{ old('jam_mulai', $jadwal->jam_mulai ? \Carbon\Carbon::parse($jadwal->jam_mulai)->format('H:i') : '') }}" required />
                                        <x-input-error :messages="$errors->get('jam_mulai')" class="mt-2 text-error text-xs" />
                                    </div>
                                    <div>
                                        <label for="jam_selesai" class="block font-label-medium text-label-medium text-on-surface mb-2">Jam Selesai <span class="text-error">*</span></label>
                                        <input id="jam_selesai" name="jam_selesai" type="time" class="w-full px-4 py-2 border border-outline-variant rounded-lg text-body-sm focus:border-primary focus:ring-1 focus:ring-primary bg-white transition-colors font-numeric-token" value="{{ old('jam_selesai', $jadwal->jam_selesai ? \Carbon\Carbon::parse($jadwal->jam_selesai)->format('H:i') : '') }}" required />
                                        <x-input-error :messages="$errors->get('jam_selesai')" class="mt-2 text-error text-xs" />
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Seksi 3: Periode & Status -->
                        <div class="space-y-4">
                            <h3 class="font-headline-sm text-headline-sm font-bold text-on-surface flex items-center gap-2 border-b border-slate-100 pb-2">
                                <span class="material-symbols-outlined text-primary text-xl">settings</span>
                                Periode & Status
                            </h3>
                            
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                <!-- Semester -->
                                <div>
                                    <label for="semester" class="block font-label-medium text-label-medium text-on-surface mb-2">Semester <span class="text-error">*</span></label>
                                    <select id="semester" name="semester" class="w-full px-4 py-2 border border-outline-variant rounded-lg text-body-sm focus:border-primary focus:ring-1 focus:ring-primary bg-white transition-colors" required>
                                        <option value="Ganjil" {{ old('semester', $jadwal->semester) == 'Ganjil' ? 'selected' : '' }}>Ganjil</option>
                                        <option value="Genap" {{ old('semester', $jadwal->semester) == 'Genap' ? 'selected' : '' }}>Genap</option>
                                    </select>
                                    <x-input-error :messages="$errors->get('semester')" class="mt-2 text-error text-xs" />
                                </div>
                                
                                <!-- Tahun Ajaran -->
                                <div>
                                    <label for="tahun_ajaran" class="block font-label-medium text-label-medium text-on-surface mb-2">Tahun Ajaran <span class="text-error">*</span></label>
                                    <input id="tahun_ajaran" name="tahun_ajaran" type="text" class="w-full px-4 py-2 border border-outline-variant rounded-lg text-body-sm focus:border-primary focus:ring-1 focus:ring-primary bg-white transition-colors font-numeric-token" value="{{ old('tahun_ajaran', $jadwal->tahun_ajaran) }}" placeholder="Contoh: 2023/2024" required />
                                    <x-input-error :messages="$errors->get('tahun_ajaran')" class="mt-2 text-error text-xs" />
                                </div>

                                <!-- Status -->
                                <div>
                                    <label for="status" class="block font-label-medium text-label-medium text-on-surface mb-2">Status Jadwal <span class="text-error">*</span></label>
                                    <select id="status" name="status" class="w-full px-4 py-2 border border-outline-variant rounded-lg text-body-sm focus:border-primary focus:ring-1 focus:ring-primary bg-white transition-colors" required>
                                        <option value="1" {{ old('status', $jadwal->status) == '1' ? 'selected' : '' }}>Aktif</option>
                                        <option value="0" {{ old('status', $jadwal->status) == '0' ? 'selected' : '' }}>Nonaktif</option>
                                    </select>
                                    <x-input-error :messages="$errors->get('status')" class="mt-2 text-error text-xs" />
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="px-6 py-4 bg-slate-50 border-t border-slate-200 flex items-center justify-end gap-3">
                        <a href="{{ route('admin.jadwal.index') }}" class="px-5 py-2.5 border border-outline-variant text-on-surface-variant font-label-medium rounded-lg hover:bg-slate-100 transition-colors">
                            Batal
                        </a>
                        <button type="submit" class="px-5 py-2.5 bg-primary text-white font-label-medium rounded-lg hover:bg-primary-container transition-colors shadow-sm flex items-center gap-2">
                            <span class="material-symbols-outlined text-[20px]">save</span>
                            Perbarui Jadwal
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
