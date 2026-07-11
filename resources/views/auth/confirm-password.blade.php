<x-guest-layout>
    <div class="mb-6 text-center">
        <h2 class="font-headline-xl text-headline-xl font-bold text-on-surface">Konfirmasi Password</h2>
        <p class="text-on-surface-variant text-body-sm mt-1">
            {{ __('Ini adalah area aman dari aplikasi. Harap konfirmasi password Anda sebelum melanjutkan.') }}
        </p>
    </div>

    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="flex justify-end mt-4">
            <x-primary-button>
                {{ __('Konfirmasi') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
