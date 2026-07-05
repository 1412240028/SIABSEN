<section>
    <header>
        <h3 class="font-bold text-on-surface flex items-center gap-2">
            <span class="material-symbols-outlined text-primary">lock</span>
            Ubah Password
        </h3>
        <p class="text-sm text-on-surface-variant mt-1">Pastikan akun Anda menggunakan password yang panjang dan acak agar tetap aman.</p>
    </header>

    <hr class="border-slate-100 my-5">

    <form method="post" action="{{ route('password.update') }}" class="space-y-5">
        @csrf
        @method('put')

        <div>
            <label for="update_password_current_password" class="block text-sm font-label-medium text-on-surface-variant mb-1.5">Password Saat Ini</label>
            <input id="update_password_current_password" name="current_password" type="password" class="w-full px-4 py-2.5 border border-outline-variant rounded-lg text-body-sm font-body-sm focus:border-primary focus:ring-2 focus:ring-primary/20 bg-white transition-colors" autocomplete="current-password" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <div>
            <label for="update_password_password" class="block text-sm font-label-medium text-on-surface-variant mb-1.5">Password Baru</label>
            <input id="update_password_password" name="password" type="password" class="w-full px-4 py-2.5 border border-outline-variant rounded-lg text-body-sm font-body-sm focus:border-primary focus:ring-2 focus:ring-primary/20 bg-white transition-colors" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <div>
            <label for="update_password_password_confirmation" class="block text-sm font-label-medium text-on-surface-variant mb-1.5">Konfirmasi Password</label>
            <input id="update_password_password_confirmation" name="password_confirmation" type="password" class="w-full px-4 py-2.5 border border-outline-variant rounded-lg text-body-sm font-body-sm focus:border-primary focus:ring-2 focus:ring-primary/20 bg-white transition-colors" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4 pt-2">
            <button type="submit" class="bg-primary hover:bg-primary-container text-white font-label-medium px-5 py-2.5 rounded-lg flex items-center gap-2 shadow-sm transition-colors">
                <span class="material-symbols-outlined text-[18px]">save</span>
                Simpan Password
            </button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-green-600 font-medium"
                >{{ __('Tersimpan.') }}</p>
            @endif
        </div>
    </form>
</section>
