<x-guest-layout>
    <div class="mb-6 text-center">
        <h2 class="font-headline-xl text-headline-xl font-bold text-on-surface">Lupa Password?</h2>
        <p class="text-on-surface-variant text-body-sm mt-1">
            {{ __('Masukkan alamat email Anda dan kami akan mengirimkan tautan untuk mereset password.') }}
        </p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm font-label-medium text-on-surface-variant hover:text-primary rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition-colors mr-4" href="{{ route('login') }}">
                {{ __('Batal') }}
            </a>
            <x-primary-button>
                {{ __('Kirim Link Reset') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
