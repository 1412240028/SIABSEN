<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Data Dosen</h2>
            @if (auth()->user()->isAdmin())
                <a href="{{ route('dosen.create') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 text-white rounded-md text-sm hover:bg-gray-700">+ Tambah Dosen</a>
            @endif
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form method="GET" action="{{ route('dosen.index') }}" class="mb-4 flex gap-2">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama / NIDN..." class="border-gray-300 rounded-md shadow-sm w-full sm:w-64 text-sm">
                    <button type="submit" class="px-4 py-2 bg-gray-200 rounded-md text-sm hover:bg-gray-300">Cari</button>
                    @if (request('search'))
                        <a href="{{ route('dosen.index') }}" class="px-4 py-2 text-sm text-gray-500 hover:underline">Reset</a>
                    @endif
                </form>

                <table class="min-w-full text-sm text-left">
                    <thead class="bg-gray-50 border-b">
                        <tr>
                            <th class="px-4 py-2">Nama</th>
                            <th class="px-4 py-2">NIDN</th>
                            <th class="px-4 py-2">Email</th>
                            <th class="px-4 py-2">Jenis Kelamin</th>
                            <th class="px-4 py-2 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($dosen as $item)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="px-4 py-2">{{ $item->nama }}</td>
                                <td class="px-4 py-2">{{ $item->nidn }}</td>
                                <td class="px-4 py-2">{{ $item->user->email }}</td>
                                <td class="px-4 py-2">{{ $item->jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                                <td class="px-4 py-2 text-right space-x-2">
                                    <a href="{{ route('dosen.show', $item) }}" class="text-indigo-600 hover:underline">Lihat</a>
                                    @if (auth()->user()->isAdmin())
                                        <a href="{{ route('dosen.edit', $item) }}" class="text-indigo-600 hover:underline">Edit</a>
                                        <button x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-dosen-deletion-{{ $item->id }}')" class="text-red-600 hover:underline">Hapus</button>

                                        <x-modal name="confirm-dosen-deletion-{{ $item->id }}" focusable>
                                            <form method="POST" action="{{ route('dosen.destroy', $item) }}" class="p-6">
                                                @csrf
                                                @method('DELETE')
                                                <h2 class="text-lg font-medium text-gray-900">Yakin mau hapus "{{ $item->nama }}"?</h2>
                                                <p class="mt-1 text-sm text-gray-600">Akun pengguna tidak dihapus agar histori tetap utuh.</p>
                                                <div class="mt-6 flex justify-end">
                                                    <x-secondary-button x-on:click="$dispatch('close')">Batal</x-secondary-button>
                                                    <x-danger-button class="ms-3">Hapus</x-danger-button>
                                                </div>
                                            </form>
                                        </x-modal>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="5" class="px-4 py-6 text-center text-gray-500">Belum ada data dosen.</td></tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="mt-4">{{ $dosen->links() }}</div>
            </div>
        </div>
    </div>
</x-app-layout>
