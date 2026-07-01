<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Rekap Presensi</h2>
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
                                <th class="px-4 py-2">Mahasiswa</th>
                                <th class="px-4 py-2">Status</th>
                                <th class="px-4 py-2">Metode</th>
                                <th class="px-4 py-2">Waktu</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($rekap as $item)
                                <tr class="border-b hover:bg-gray-50">
                                    <td class="px-4 py-2">{{ $item->sesiPresensi->jadwal->mataKuliah->nama }}</td>
                                    <td class="px-4 py-2">{{ $item->sesiPresensi->jadwal->kelas->nama_kelas }}</td>
                                    <td class="px-4 py-2">{{ $item->mahasiswa->nama }}</td>
                                    <td class="px-4 py-2">{{ $item->status }}</td>
                                    <td class="px-4 py-2">{{ $item->metode }}</td>
                                    <td class="px-4 py-2">{{ $item->waktu_presensi->format('d M Y H:i') }}</td>
                                </tr>
                            @empty
                                <tr><td colspan="6" class="px-4 py-6 text-center text-gray-500">Belum ada data presensi.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">{{ $rekap->links() }}</div>
            </div>
        </div>
    </div>
</x-app-layout>
