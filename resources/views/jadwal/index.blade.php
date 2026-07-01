<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Data Jadwal</h2>
            <a href="{{ route('admin.jadwal.create') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 text-white rounded-md text-sm hover:bg-gray-700">+ Tambah Jadwal</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form method="GET" action="{{ route('admin.jadwal.index') }}" class="mb-4 flex gap-2">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari mata kuliah, dosen, kelas..." class="border-gray-300 rounded-md shadow-sm w-full sm:w-64 text-sm">
                    <button type="submit" class="px-4 py-2 bg-gray-200 rounded-md text-sm hover:bg-gray-300">Cari</button>
                    @if (request('search'))
                        <a href="{{ route('admin.jadwal.index') }}" class="px-4 py-2 text-sm text-gray-500 hover:underline">Reset</a>
                    @endif
                </form>

                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm text-left">
                        <thead class="bg-gray-50 border-b">
                            <tr>
                                <th class="px-4 py-2">Mata Kuliah</th>
                                <th class="px-4 py-2">Dosen</th>
                                <th class="px-4 py-2">Kelas</th>
                                <th class="px-4 py-2">Hari</th>
                                <th class="px-4 py-2">Jam</th>
                                <th class="px-4 py-2">Status</th>
                                <th class="px-4 py-2 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($jadwal as $item)
                                <tr class="border-b hover:bg-gray-50">
                                    <td class="px-4 py-2">{{ $item->mataKuliah->nama }}</td>
                                    <td class="px-4 py-2">{{ $item->dosen->nama }}</td>
                                    <td class="px-4 py-2">{{ $item->kelas->nama_kelas }}</td>
                                    <td class="px-4 py-2">{{ $item->hari }}</td>
                                    <td class="px-4 py-2">{{ $item->jam_mulai }} - {{ $item->jam_selesai }}</td>
                                    <td class="px-4 py-2">
                                        @if ($item->status)
                                            <span class="px-2 py-1 bg-green-100 text-green-700 rounded text-xs">Aktif</span>
                                        @else
                                            <span class="px-2 py-1 bg-gray-100 text-gray-600 rounded text-xs">Nonaktif</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-2 text-right space-x-2">
                                        <a href="{{ route('admin.jadwal.show', $item) }}" class="text-indigo-600 hover:underline">Lihat</a>
                                        <a href="{{ route('admin.jadwal.edit', $item) }}" class="text-indigo-600 hover:underline">Edit</a>
                                        <form method="POST" action="{{ route('admin.jadwal.destroy', $item) }}" class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="7" class="px-4 py-6 text-center text-gray-500">Belum ada jadwal.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">{{ $jadwal->links() }}</div>
            </div>
        </div>
    </div>
</x-app-layout>
