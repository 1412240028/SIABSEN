<x-app-layout>
    <div class="p-4 md:p-8 overflow-y-auto">
        <div class="flex items-center gap-3 mb-6">
            <a href="{{ route('dashboard') }}" class="text-on-surface-variant hover:text-primary transition-colors">
                <span class="material-symbols-outlined">arrow_back</span>
            </a>
            <h2 class="font-headline-xl text-headline-xl font-bold text-on-surface">Komplain Presensi</h2>
        </div>

        <div class="max-w-2xl bg-white rounded-xl border border-outline-variant shadow-soft p-6">
            <form action="{{ route('komplain.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                <div>
                    <label class="block text-sm font-label-medium text-on-surface-variant mb-1.5">Pilih Sesi Presensi</label>
                    <select name="sesi_presensi_id" required class="w-full px-4 py-2.5 border border-outline-variant rounded-lg text-body-sm focus:border-primary focus:ring-2 focus:ring-primary/20 bg-white transition-colors">
                        <option value="">-- Pilih Sesi --</option>
                        @foreach($sesi as $s)
                            <option value="{{ $s->id }}">{{ $s->jadwal->mataKuliah->nama }} - {{ \Carbon\Carbon::parse($s->tanggal)->format('d M Y') }}</option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('sesi_presensi_id')" class="mt-1 text-xs" />
                </div>

                <div>
                    <label class="block text-sm font-label-medium text-on-surface-variant mb-1.5">Alasan Komplain</label>
                    <textarea name="alasan" rows="4" required placeholder="Jelaskan alasan komplain (contoh: Saya sudah hadir di kelas tetapi lupa scan QR...)" class="w-full px-4 py-2.5 border border-outline-variant rounded-lg text-body-sm focus:border-primary focus:ring-2 focus:ring-primary/20 bg-white"></textarea>
                    <x-input-error :messages="$errors->get('alasan')" class="mt-1 text-xs" />
                </div>

                <div>
                    <label class="block text-sm font-label-medium text-on-surface-variant mb-1.5">Upload Bukti (Opsional)</label>
                    <input type="file" name="bukti" accept=".jpg,.jpeg,.png,.pdf" class="w-full px-4 py-2.5 border border-outline-variant rounded-lg text-body-sm focus:border-primary focus:ring-2 focus:ring-primary/20 bg-white">
                    <p class="text-xs text-on-surface-variant mt-1">Lampirkan foto/screenshot jika ada (Max 2MB).</p>
                    <x-input-error :messages="$errors->get('bukti')" class="mt-1 text-xs" />
                </div>

                <div class="pt-4 flex justify-end gap-3 border-t border-outline-variant">
                    <a href="{{ route('dashboard') }}" class="px-5 py-2.5 border border-outline-variant text-on-surface-variant font-label-medium rounded-lg hover:bg-slate-100 transition-colors">Batal</a>
                    <button type="submit" class="bg-primary hover:bg-primary-container text-white font-label-medium px-5 py-2.5 rounded-lg flex items-center gap-2 shadow-sm transition-colors">
                        <span class="material-symbols-outlined">send</span> Kirim Komplain
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
