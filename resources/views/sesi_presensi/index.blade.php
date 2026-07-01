<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Daftar Sesi Presensi</h2>
            <a href="{{ route('dosen.sesi_presensi.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded-md text-sm hover:bg-indigo-700">Buat Sesi Baru</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm text-left">
                        <thead class="bg-gray-50 border-b">
                            <tr>
                                <th class="px-4 py-2">Mata Kuliah</th>
                                <th class="px-4 py-2">Kelas</th>
                                <th class="px-4 py-2">Pertemuan</th>
                                <th class="px-4 py-2">Tanggal</th>
                                <th class="px-4 py-2">Status</th>
                                <th class="px-4 py-2 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($sesi as $item)
                                <tr class="border-b hover:bg-gray-50">
                                    <td class="px-4 py-2">{{ $item->jadwal->mataKuliah->nama }}</td>
                                    <td class="px-4 py-2">{{ $item->jadwal->kelas->nama_kelas }}</td>
                                    <td class="px-4 py-2">{{ $item->pertemuan_ke }}</td>
                                    <td class="px-4 py-2">{{ $item->tanggal->format('d M Y') }}</td>
                                    <td class="px-4 py-2">{{ $item->status }}</td>
                                    <td class="px-4 py-2 text-right">
                                        <a href="{{ route('dosen.sesi_presensi.show', $item) }}" class="text-indigo-600 hover:underline">Lihat</a>
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="6" class="px-4 py-6 text-center text-gray-500">Belum ada sesi presensi.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">{{ $sesi->links() }}</div>
            </div>
        </div>
    </div>
</x-app-layout>
