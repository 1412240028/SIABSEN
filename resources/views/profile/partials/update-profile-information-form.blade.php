<section>
    <header>
        <h3 class="font-bold text-on-surface flex items-center gap-2">
            <span class="material-symbols-outlined text-primary">person</span>
            Informasi Profil
        </h3>
        <p class="text-sm text-on-surface-variant mt-1">Perbarui nama dan alamat email akun Anda.</p>
    </header>

    <hr class="border-slate-100 my-5">

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="space-y-5">
        @csrf
        @method('patch')

        <div>
            <label for="name" class="block text-sm font-label-medium text-on-surface-variant mb-1.5">{{ __('Nama') }}</label>
            <input id="name" name="name" type="text" class="w-full px-4 py-2.5 border border-outline-variant rounded-lg text-body-sm font-body-sm focus:border-primary focus:ring-2 focus:ring-primary/20 bg-white transition-colors" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <label for="email" class="block text-sm font-label-medium text-on-surface-variant mb-1.5">{{ __('Email') }}</label>
            <input id="email" name="email" type="email" class="w-full px-4 py-2.5 border border-outline-variant rounded-lg text-body-sm font-body-sm focus:border-primary focus:ring-2 focus:ring-primary/20 bg-white transition-colors" value="{{ old('email', $user->email) }}" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-on-surface-variant">
                        {{ __('Alamat email Anda belum terverifikasi.') }}
                        <button form="send-verification" class="underline text-sm text-primary hover:text-primary-container rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition-colors">
                            {{ __('Klik di sini untuk mengirim ulang email verifikasi.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('Link verifikasi baru telah dikirim ke alamat email Anda.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4 pt-2">
            <button type="submit" class="bg-primary hover:bg-primary-container text-white font-label-medium px-5 py-2.5 rounded-lg flex items-center gap-2 shadow-sm transition-colors">
                <span class="material-symbols-outlined text-[18px]">save</span>
                Simpan Perubahan
            </button>

            @if (session('status') === 'profile-updated')
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
