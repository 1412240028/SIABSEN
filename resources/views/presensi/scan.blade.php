<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Scan Presensi</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form method="POST" action="{{ route('mahasiswa.presensi.scan') }}">
                    @csrf

                    <div class="mb-4">
                        <x-input-label for="token" value="Token Presensi" />
                        <x-text-input id="token" name="token" type="text" class="mt-1 block w-full" value="{{ old('token') }}" required autofocus />
                        <x-input-error :messages="$errors->get('token')" class="mt-2" />
                    </div>

                    <div class="flex justify-end gap-2">
                        <a href="{{ route('mahasiswa.presensi.history') }}" class="px-4 py-2 text-sm text-gray-600 hover:underline">Kembali</a>
                        <x-primary-button>Scan</x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
