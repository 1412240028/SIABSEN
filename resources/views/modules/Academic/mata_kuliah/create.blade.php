<x-app-layout>
    <div class="p-4 md:p-8 overflow-y-auto pb-24 md:pb-8">
        <!-- Page Header -->
        <div class="mb-8">
            <div class="flex items-center gap-2 mb-2">
                <a href="{{ route('mata_kuliah.index') }}" class="text-slate-400 hover:text-primary transition-colors">
                    <span class="material-symbols-outlined text-[20px]">arrow_back</span>
                </a>
                <h2 class="font-headline-xl text-headline-xl font-bold text-on-surface">Tambah Mata Kuliah</h2>
            </div>
            <p class="font-body-sm text-body-sm text-on-surface-variant ml-7">Daftarkan mata kuliah baru ke dalam sistem akademik.</p>
        </div>

        <div class="max-w-3xl">
            <div class="bg-white rounded-xl border border-slate-200 shadow-soft overflow-hidden">
                <form method="POST" action="{{ route('mata_kuliah.store') }}">
                    @csrf
                    
                    <div class="p-6 space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Kode Mata Kuliah -->
                            <div>
                                <label for="kode" class="block font-label-medium text-label-medium text-on-surface mb-2">Kode Mata Kuliah <span class="text-error">*</span></label>
                                <input id="kode" name="kode" type="text" class="w-full px-4 py-2 border border-outline-variant rounded-lg text-body-sm focus:border-primary focus:ring-1 focus:ring-primary bg-white transition-colors uppercase font-numeric-token" value="{{ old('kode') }}" placeholder="Contoh: IF201" required autofocus />
                                <x-input-error :messages="$errors->get('kode')" class="mt-2 text-error text-xs" />
                            </div>
                            
                            <!-- SKS -->
                            <div>
                                <label for="sks" class="block font-label-medium text-label-medium text-on-surface mb-2">Bobot SKS <span class="text-error">*</span></label>
                                <input id="sks" name="sks" type="number" class="w-full px-4 py-2 border border-outline-variant rounded-lg text-body-sm focus:border-primary focus:ring-1 focus:ring-primary bg-white transition-colors" value="{{ old('sks', 3) }}" required min="1" max="6" />
                                <x-input-error :messages="$errors->get('sks')" class="mt-2 text-error text-xs" />
                            </div>
                        </div>

                        <!-- Nama Mata Kuliah -->
                        <div>
                            <label for="nama" class="block font-label-medium text-label-medium text-on-surface mb-2">Nama Mata Kuliah <span class="text-error">*</span></label>
                            <input id="nama" name="nama" type="text" class="w-full px-4 py-2 border border-outline-variant rounded-lg text-body-sm focus:border-primary focus:ring-1 focus:ring-primary bg-white transition-colors" value="{{ old('nama') }}" placeholder="Contoh: Pemrograman Web Lanjut" required />
                            <x-input-error :messages="$errors->get('nama')" class="mt-2 text-error text-xs" />
                        </div>
                        
                        <!-- Status -->
                        <div>
                            <label for="status" class="block font-label-medium text-label-medium text-on-surface mb-2">Status Mata Kuliah <span class="text-error">*</span></label>
                            <select id="status" name="status" class="w-full px-4 py-2 border border-outline-variant rounded-lg text-body-sm focus:border-primary focus:ring-1 focus:ring-primary bg-white transition-colors">
                                <option value="1" selected>Aktif</option>
                                <option value="0">Nonaktif</option>
                            </select>
                            <x-input-error :messages="$errors->get('status')" class="mt-2 text-error text-xs" />
                        </div>
                    </div>

                    <div class="px-6 py-4 bg-slate-50 border-t border-slate-200 flex items-center justify-end gap-3">
                        <a href="{{ route('mata_kuliah.index') }}" class="px-5 py-2.5 border border-outline-variant text-on-surface-variant font-label-medium rounded-lg hover:bg-slate-100 transition-colors">
                            Batal
                        </a>
                        <button type="submit" class="px-5 py-2.5 bg-primary text-white font-label-medium rounded-lg hover:bg-primary-container transition-colors shadow-sm flex items-center gap-2">
                            <span class="material-symbols-outlined text-[20px]">save</span>
                            Simpan Mata Kuliah
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>