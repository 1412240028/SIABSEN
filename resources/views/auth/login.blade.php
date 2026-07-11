<x-guest-layout>
    <div class="mb-6 text-center">
        <h2 class="font-headline-xl text-headline-xl font-bold text-on-surface">Selamat Datang</h2>
        <p class="text-on-surface-variant text-body-sm mt-1">Silakan login ke akun SIABSEN Anda.</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-outline-variant text-primary shadow-sm focus:ring-primary/20 bg-white" name="remember">
                <span class="ms-2 text-sm font-label-medium text-on-surface-variant">{{ __('Ingat saya') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm font-label-medium text-on-surface-variant hover:text-primary rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition-colors" href="{{ route('password.request') }}">
                    {{ __('Lupa password?') }}
                </a>
            @endif

            <x-primary-button class="ms-3 w-full sm:w-auto">
                {{ __('Masuk') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
