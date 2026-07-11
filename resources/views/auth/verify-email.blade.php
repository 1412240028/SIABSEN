<x-guest-layout>
    <div class="mb-6 text-center">
        <h2 class="font-headline-xl text-headline-xl font-bold text-on-surface">Verifikasi Email</h2>
        <p class="text-on-surface-variant text-body-sm mt-1">
            {{ __('Terima kasih telah mendaftar! Sebelum memulai, mohon verifikasi alamat email Anda dengan mengklik tautan yang baru saja kami kirimkan. Jika Anda tidak menerima email tersebut, klik tombol di bawah untuk mengirim ulang.') }}
        </p>
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-6 font-medium text-sm text-status-hadir bg-green-50 p-3 rounded-lg border border-green-200">
            {{ __('Tautan verifikasi baru telah dikirim ke alamat email yang Anda berikan saat pendaftaran.') }}
        </div>
    @endif

    <div class="mt-4 flex items-center justify-between">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf

            <div>
                <x-primary-button>
                    {{ __('Kirim Ulang Email Verifikasi') }}
                </x-primary-button>
            </div>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button type="submit" class="underline text-sm font-label-medium text-on-surface-variant hover:text-primary rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition-colors">
                {{ __('Logout') }}
            </button>
        </form>
    </div>
</x-guest-layout>
