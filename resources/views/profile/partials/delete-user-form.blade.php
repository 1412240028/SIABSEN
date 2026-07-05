<section class="space-y-6">
    <header>
        <h3 class="font-bold text-error flex items-center gap-2">
            <span class="material-symbols-outlined">warning</span>
            Zona Berbahaya
        </h3>
        <p class="text-sm text-on-surface-variant mt-1">Setelah akun dihapus, semua data dan resource akan hilang secara permanen. Pastikan Anda telah mengunduh data yang diperlukan sebelum menghapus akun.</p>
    </header>

    <hr class="border-slate-100 my-5">

    <button
        type="button"
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        class="bg-error hover:bg-error/90 text-white font-label-medium px-5 py-2.5 rounded-lg flex items-center gap-2 shadow-sm transition-colors"
    >
        <span class="material-symbols-outlined text-[18px]">delete_forever</span>
        Hapus Akun Saya
    </button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
            @csrf
            @method('delete')

            <h2 class="text-lg font-bold text-on-surface">
                Konfirmasi Penghapusan Akun
            </h2>

            <p class="mt-2 text-sm text-on-surface-variant">
                Setelah akun Anda dihapus, semua data akan hilang secara permanen. Masukkan password Anda untuk mengkonfirmasi bahwa Anda ingin menghapus akun secara permanen.
            </p>

            <div class="mt-4">
                <label for="password" class="sr-only">Password</label>
                <input
                    id="password"
                    name="password"
                    type="password"
                    class="w-full px-4 py-2.5 border border-outline-variant rounded-lg text-body-sm font-body-sm focus:border-error focus:ring-2 focus:ring-error/20 bg-white transition-colors"
                    placeholder="Masukkan password Anda"
                />
                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="mt-6 flex justify-end gap-3">
                <button type="button" x-on:click="$dispatch('close')" class="px-5 py-2.5 border border-outline-variant text-on-surface-variant font-label-medium rounded-lg hover:bg-slate-100 transition-colors">
                    Batal
                </button>
                <button type="submit" class="bg-error hover:bg-error/90 text-white font-label-medium px-5 py-2.5 rounded-lg flex items-center gap-2 shadow-sm transition-colors">
                    <span class="material-symbols-outlined text-[18px]">delete_forever</span>
                    Hapus Akun
                </button>
            </div>
        </form>
    </x-modal>
</section>
