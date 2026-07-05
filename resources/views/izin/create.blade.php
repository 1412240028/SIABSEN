<x-app-layout>
    <div class="p-4 md:p-8 overflow-y-auto">
        <div class="flex items-center gap-3 mb-6">
            <a href="{{ route('dashboard') }}" class="text-on-surface-variant hover:text-primary transition-colors">
                <span class="material-symbols-outlined">arrow_back</span>
            </a>
            <h2 class="font-headline-xl text-headline-xl font-bold text-on-surface">Pengajuan Izin / Sakit</h2>
        </div>

        <div class="max-w-2xl bg-white rounded-xl border border-outline-variant shadow-soft p-6">
            <form action="{{ route('izin.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                <div>
                    <label class="block text-sm font-label-medium text-on-surface-variant mb-1.5">Pilih Jadwal (Opsional)</label>
                    <select name="jadwal_id" class="w-full px-4 py-2.5 border border-outline-variant rounded-lg text-body-sm focus:border-primary focus:ring-2 focus:ring-primary/20 bg-white transition-colors">
                        <option value="">-- Izin Seharian --</option>
                        @foreach($jadwal as $j)
                            <option value="{{ $j->id }}">{{ $j->mataKuliah->nama }} - {{ $j->hari }}</option>
                        @endforeach
                    </select>
                </div>
                
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-label-medium text-on-surface-variant mb-1.5">Tanggal</label>
                        <input type="date" name="tanggal" value="{{ old('tanggal', now()->toDateString()) }}" required class="w-full px-4 py-2.5 border border-outline-variant rounded-lg text-body-sm focus:border-primary focus:ring-2 focus:ring-primary/20 bg-white">
                    </div>
                    <div>
                        <label class="block text-sm font-label-medium text-on-surface-variant mb-1.5">Jenis</label>
                        <select name="jenis" required class="w-full px-4 py-2.5 border border-outline-variant rounded-lg text-body-sm focus:border-primary focus:ring-2 focus:ring-primary/20 bg-white">
                            <option value="SAKIT">Sakit</option>
                            <option value="IZIN">Izin</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-label-medium text-on-surface-variant mb-1.5">Keterangan</label>
                    <textarea name="keterangan" rows="3" required class="w-full px-4 py-2.5 border border-outline-variant rounded-lg text-body-sm focus:border-primary focus:ring-2 focus:ring-primary/20 bg-white"></textarea>
                </div>

                <div>
                    <label class="block text-sm font-label-medium text-on-surface-variant mb-1.5">Upload Bukti (Opsional)</label>
                    <input type="file" name="file_bukti" accept=".jpg,.jpeg,.png,.pdf" class="w-full px-4 py-2.5 border border-outline-variant rounded-lg text-body-sm focus:border-primary focus:ring-2 focus:ring-primary/20 bg-white">
                </div>

                <div class="pt-4 flex justify-end gap-3 border-t border-outline-variant">
                    <a href="{{ route('dashboard') }}" class="px-5 py-2.5 border border-outline-variant text-on-surface-variant font-label-medium rounded-lg hover:bg-slate-100 transition-colors">Batal</a>
                    <button type="submit" class="bg-primary hover:bg-primary-container text-white font-label-medium px-5 py-2.5 rounded-lg flex items-center gap-2 shadow-sm transition-colors">
                        <span class="material-symbols-outlined">send</span> Ajukan Izin
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
