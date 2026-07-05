<x-app-layout>
    <div class="p-4 md:p-8 overflow-y-auto pb-24 md:pb-8">
        <!-- Page Header -->
        <div class="mb-8">
            <div class="flex items-center gap-2 mb-2">
                <a href="{{ route('mahasiswa.index') }}" class="text-slate-400 hover:text-primary transition-colors">
                    <span class="material-symbols-outlined text-[20px]">arrow_back</span>
                </a>
                <h2 class="font-headline-xl text-headline-xl font-bold text-on-surface">Edit Mahasiswa</h2>
            </div>
            <p class="font-body-sm text-body-sm text-on-surface-variant ml-7">Perbarui profil dan data akademik mahasiswa {{ $mahasiswa->nama }}.</p>
        </div>

        <div class="max-w-4xl">
            <div class="bg-white rounded-xl border border-slate-200 shadow-soft overflow-hidden">
                <form method="POST" action="{{ route('mahasiswa.update', $mahasiswa) }}">
                    @csrf
                    @method('PUT')
                    
                    <div class="p-6 space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            
                            <!-- Bagian Kiri: Akun & Akademik -->
                            <div class="space-y-6">
                                <h3 class="font-headline-lg text-headline-lg font-bold text-on-surface border-b border-slate-200 pb-2 flex items-center gap-2">
                                    <span class="material-symbols-outlined text-primary">school</span>
                                    Data Akademik & Akun
                                </h3>
                                
                                <!-- Email -->
                                <div>
                                    <label for="email" class="block font-label-medium text-label-medium text-on-surface mb-2">Email SSO <span class="text-error">*</span></label>
                                    <input id="email" name="email" type="email" class="w-full px-4 py-2 border border-outline-variant rounded-lg text-body-sm focus:border-primary focus:ring-1 focus:ring-primary bg-white transition-colors" value="{{ old('email', $mahasiswa->user->email) }}" required />
                                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-error text-xs" />
                                </div>

                                <!-- Password (Opsional) -->
                                <div>
                                    <label for="password" class="block font-label-medium text-label-medium text-on-surface mb-2">Password Baru <span class="text-slate-400 font-normal">(Opsional)</span></label>
                                    <input id="password" name="password" type="password" class="w-full px-4 py-2 border border-outline-variant rounded-lg text-body-sm focus:border-primary focus:ring-1 focus:ring-primary bg-white transition-colors" placeholder="Kosongkan jika tidak ingin mengubah password" />
                                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-error text-xs" />
                                </div>

                                <!-- NIM -->
                                <div>
                                    <label for="nim" class="block font-label-medium text-label-medium text-on-surface mb-2">NIM (Nomor Induk Mahasiswa) <span class="text-error">*</span></label>
                                    <input id="nim" name="nim" type="text" class="w-full px-4 py-2 border border-outline-variant rounded-lg text-body-sm focus:border-primary focus:ring-1 focus:ring-primary bg-white transition-colors font-numeric-token" value="{{ old('nim', $mahasiswa->nim) }}" required />
                                    <x-input-error :messages="$errors->get('nim')" class="mt-2 text-error text-xs" />
                                </div>

                                <div class="grid grid-cols-2 gap-4">
                                    <!-- Kelas -->
                                    <div>
                                        <label for="kelas_id" class="block font-label-medium text-label-medium text-on-surface mb-2">Pilih Kelas <span class="text-error">*</span></label>
                                        <select id="kelas_id" name="kelas_id" class="w-full px-4 py-2 border border-outline-variant rounded-lg text-body-sm focus:border-primary focus:ring-1 focus:ring-primary bg-white transition-colors" required>
                                            <option value="">-- Pilih Kelas --</option>
                                            @foreach ($kelas as $item)
                                                <option value="{{ $item->id }}" {{ old('kelas_id', $mahasiswa->kelas_id) == $item->id ? 'selected' : '' }}>{{ $item->nama_kelas }} ({{ $item->angkatan }})</option>
                                            @endforeach
                                        </select>
                                        <x-input-error :messages="$errors->get('kelas_id')" class="mt-2 text-error text-xs" />
                                    </div>
                                    
                                    <!-- Angkatan -->
                                    <div>
                                        <label for="angkatan" class="block font-label-medium text-label-medium text-on-surface mb-2">Angkatan <span class="text-error">*</span></label>
                                        <input id="angkatan" name="angkatan" type="number" class="w-full px-4 py-2 border border-outline-variant rounded-lg text-body-sm focus:border-primary focus:ring-1 focus:ring-primary bg-white transition-colors font-numeric-token" value="{{ old('angkatan', $mahasiswa->angkatan) }}" required />
                                        <x-input-error :messages="$errors->get('angkatan')" class="mt-2 text-error text-xs" />
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Bagian Kanan: Biodata Pribadi -->
                            <div class="space-y-6">
                                <h3 class="font-headline-lg text-headline-lg font-bold text-on-surface border-b border-slate-200 pb-2 flex items-center gap-2">
                                    <span class="material-symbols-outlined text-primary">person</span>
                                    Biodata Pribadi
                                </h3>
                                
                                <!-- Nama -->
                                <div>
                                    <label for="name" class="block font-label-medium text-label-medium text-on-surface mb-2">Nama Lengkap <span class="text-error">*</span></label>
                                    <input id="name" name="name" type="text" class="w-full px-4 py-2 border border-outline-variant rounded-lg text-body-sm focus:border-primary focus:ring-1 focus:ring-primary bg-white transition-colors" value="{{ old('name', $mahasiswa->nama) }}" required autofocus />
                                    <x-input-error :messages="$errors->get('name')" class="mt-2 text-error text-xs" />
                                </div>

                                <div class="grid grid-cols-2 gap-4">
                                    <!-- Jenis Kelamin -->
                                    <div>
                                        <label for="jenis_kelamin" class="block font-label-medium text-label-medium text-on-surface mb-2">Jenis Kelamin <span class="text-error">*</span></label>
                                        <select id="jenis_kelamin" name="jenis_kelamin" class="w-full px-4 py-2 border border-outline-variant rounded-lg text-body-sm focus:border-primary focus:ring-1 focus:ring-primary bg-white transition-colors" required>
                                            <option value="L" {{ old('jenis_kelamin', $mahasiswa->jenis_kelamin) === 'L' ? 'selected' : '' }}>Laki-laki</option>
                                            <option value="P" {{ old('jenis_kelamin', $mahasiswa->jenis_kelamin) === 'P' ? 'selected' : '' }}>Perempuan</option>
                                        </select>
                                        <x-input-error :messages="$errors->get('jenis_kelamin')" class="mt-2 text-error text-xs" />
                                    </div>

                                    <!-- Tanggal Lahir -->
                                    <div>
                                        <label for="tanggal_lahir" class="block font-label-medium text-label-medium text-on-surface mb-2">Tanggal Lahir</label>
                                        <input id="tanggal_lahir" name="tanggal_lahir" type="date" class="w-full px-4 py-2 border border-outline-variant rounded-lg text-body-sm focus:border-primary focus:ring-1 focus:ring-primary bg-white transition-colors" value="{{ old('tanggal_lahir', $mahasiswa->tanggal_lahir ? \Carbon\Carbon::parse($mahasiswa->tanggal_lahir)->format('Y-m-d') : '') }}" />
                                        <x-input-error :messages="$errors->get('tanggal_lahir')" class="mt-2 text-error text-xs" />
                                    </div>
                                </div>

                                <!-- No HP -->
                                <div>
                                    <label for="no_hp" class="block font-label-medium text-label-medium text-on-surface mb-2">No. Handphone</label>
                                    <input id="no_hp" name="no_hp" type="tel" class="w-full px-4 py-2 border border-outline-variant rounded-lg text-body-sm focus:border-primary focus:ring-1 focus:ring-primary bg-white transition-colors font-numeric-token" value="{{ old('no_hp', $mahasiswa->no_hp) }}" />
                                    <x-input-error :messages="$errors->get('no_hp')" class="mt-2 text-error text-xs" />
                                </div>

                                <!-- Alamat -->
                                <div>
                                    <label for="alamat" class="block font-label-medium text-label-medium text-on-surface mb-2">Alamat Domisili</label>
                                    <textarea id="alamat" name="alamat" rows="3" class="w-full px-4 py-2 border border-outline-variant rounded-lg text-body-sm focus:border-primary focus:ring-1 focus:ring-primary bg-white transition-colors">{{ old('alamat', $mahasiswa->alamat) }}</textarea>
                                    <x-input-error :messages="$errors->get('alamat')" class="mt-2 text-error text-xs" />
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="px-6 py-4 bg-slate-50 border-t border-slate-200 flex items-center justify-end gap-3">
                        <a href="{{ route('mahasiswa.index') }}" class="px-5 py-2.5 border border-outline-variant text-on-surface-variant font-label-medium rounded-lg hover:bg-slate-100 transition-colors">
                            Batal
                        </a>
                        <button type="submit" class="px-5 py-2.5 bg-primary text-white font-label-medium rounded-lg hover:bg-primary-container transition-colors shadow-sm flex items-center gap-2">
                            <span class="material-symbols-outlined text-[20px]">save</span>
                            Perbarui Mahasiswa
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
