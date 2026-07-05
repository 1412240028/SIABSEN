<x-app-layout>
    <div class="p-4 md:p-8 overflow-y-auto">
        {{-- Page Header --}}
        <div class="mb-8">
            <h2 class="font-headline-xl text-headline-xl font-bold text-on-surface flex items-center gap-2">
                <span class="material-symbols-outlined text-primary">settings</span>
                Pengaturan Akun
            </h2>
            <p class="text-sm text-on-surface-variant mt-1">Kelola informasi profil, keamanan, dan preferensi akun Anda.</p>
        </div>

        <div class="max-w-3xl mx-auto space-y-6">
            {{-- Profile Information --}}
            <div class="bg-white rounded-xl border border-slate-200 shadow-soft p-6">
                @include('profile.partials.update-profile-information-form')
            </div>

            {{-- Update Password --}}
            <div class="bg-white rounded-xl border border-slate-200 shadow-soft p-6">
                @include('profile.partials.update-password-form')
            </div>

            {{-- Delete Account (Danger Zone) --}}
            <div class="bg-white rounded-xl border border-error/20 shadow-soft p-6">
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>
</x-app-layout>
