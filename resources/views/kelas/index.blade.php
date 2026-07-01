<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Data Kelas</h2>
            @if (auth()->user()->isAdmin())
                <a href="{{ route('kelas.create') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 text-white rounded-md text-sm hover:bg-gray-700">+ Tambah Kelas</a>
            @endif
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <form method="GET" action="{{ route('kelas.index') }}" class="mb-4 flex gap-2">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama kelas..." class="border-gray-300 rounded-md shadow-sm w-full sm:w-64 text-sm">
                    <button type="submit" class="px-4 py-2 bg-gray-200 rounded-md text-sm hover:bg-gray-300">Cari</button>
                    @if (request('search'))
                        <a href="{{ route('kelas.index') }}" class="px-4 py-2 text-sm text-gray-500 hover:underline">Reset</a>
                    @endif
                </form>

                <table class="min-w-full text-sm text-left">
                    <thead class="bg-gray-50 border-b">
                        <tr>
                            <th class="px-4 py-2">Nama Kelas</th>
                            <th class="px-4 py-2">Angkatan</th>
                            <th class="px-4 py-2">Kapasitas</th>
                            <th class="px-4 py-2">Status</th>
                            @if (auth()->user()->isAdmin())
                                <th class="px-4 py-2 text-right">Aksi</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($kelas as $item)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="px-4 py-2">{{ $item->nama_kelas }}</td>
                                <td class="px-4 py-2">{{ $item->angkatan }}</td>
                                <td class="px-4 py-2">{{ $item->kapasitas }}</td>
                                <td class="px-4 py-2">
                                    @if ($item->status)
                                        <span class="px-2 py-1 bg-green-100 text-green-700 rounded text-xs">Aktif</span>
                                    @else
                                        <span class="px-2 py-1 bg-gray-100 text-gray-600 rounded text-xs">Nonaktif</span>
                                    @endif
                                </td>
                                @if (auth()->user()->isAdmin())
                                    <td class="px-4 py-2 text-right space-x-2">
                                        <a href="{{ route('kelas.edit', $item) }}" class="text-indigo-600 hover:underline">Edit</a>
                                        <button x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-kelas-deletion-{{ $item->id }}')" class="text-red-600 hover:underline">Hapus</button>

                                        <x-modal name="confirm-kelas-deletion-{{ $item->id }}" focusable>
                                            <form method="POST" action="{{ route('kelas.destroy', $item) }}" class="p-6">
                                                @csrf
                                                @method('DELETE')
                                                <h2 class="text-lg font-medium text-gray-900">Yakin mau hapus kelas "{{ $item->nama_kelas }}"?</h2>
                                                <p class="mt-1 text-sm text-gray-600">Data akan disembunyikan dari daftar (soft delete), tapi tetap tersimpan di database.</p>
                                                <div class="mt-6 flex justify-end">
                                                    <x-secondary-button x-on:click="$dispatch('close')">Batal</x-secondary-button>
                                                    <x-danger-button class="ms-3">Hapus</x-danger-button>
                                                </div>
                                            </form>
                                        </x-modal>
                                    </td>
                                @endif
                            </tr>
                        @empty
                            <tr><td colspan="5" class="px-4 py-6 text-center text-gray-500">Belum ada data kelas.</td></tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="mt-4">{{ $kelas->links() }}</div>
            </div>
        </div>
    </div>
</x-app-layout>