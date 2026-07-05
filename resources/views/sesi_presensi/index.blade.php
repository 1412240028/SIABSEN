<x-app-layout>
    <div class="p-4 md:p-8 overflow-y-auto pb-24 md:pb-8">
        
        <!-- Page Header -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
            <div>
                <h2 class="font-headline-xl text-headline-xl font-bold text-on-surface">Riwayat Sesi Presensi</h2>
                <p class="font-body-sm text-body-sm text-on-surface-variant mt-1">Daftar seluruh sesi pertemuan perkuliahan yang telah dan sedang berjalan.</p>
            </div>
            <a href="{{ route('dosen.sesi_presensi.create') }}" class="bg-primary hover:bg-primary-container text-white font-label-medium text-label-medium px-5 py-2.5 rounded-lg flex items-center gap-2 shadow-sm transition-colors">
                <span class="material-symbols-outlined text-[20px]">add</span>
                Buat Sesi Baru
            </a>
        </div>

        @php
            $statusClasses = [
                'OPEN' => 'bg-amber-100 text-amber-800 border-amber-200',
                'CLOSED' => 'bg-green-100 text-green-800 border-green-200',
                'CANCELLED' => 'bg-slate-100 text-slate-600 border-slate-200',
            ];
            
            $statusLabels = [
                'OPEN' => 'Berjalan',
                'CLOSED' => 'Selesai',
                'CANCELLED' => 'Dibatalkan',
            ];
        @endphp

        <!-- Main Content Card -->
        <div class="bg-white rounded-xl border border-slate-200 shadow-soft flex flex-col">
            
            <!-- Toolbar (Filters - Placeholder for future) -->
            <div class="p-4 md:p-5 border-b border-slate-200 bg-slate-50/50 flex justify-end">
                 <!-- Di sini bisa ditambahkan filter tanggal atau kelas jika diperlukan -->
                 <span class="text-sm font-label-medium text-slate-400">Total: {{ $sesi->total() }} Sesi</span>
            </div>

            <!-- Table -->
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50 border-b border-slate-200 font-label-xs text-label-xs text-slate-500 uppercase tracking-wider">
                            <th class="px-6 py-4 font-medium">Mata Kuliah & Kelas</th>
                            <th class="px-6 py-4 font-medium">Pertemuan</th>
                            <th class="px-6 py-4 font-medium">Tanggal</th>
                            <th class="px-6 py-4 font-medium">Status</th>
                            <th class="px-6 py-4 font-medium text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 font-body-sm text-body-sm text-on-surface">
                        @forelse ($sesi as $item)
                            <tr class="hover:bg-slate-50/80 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="font-bold text-on-surface">{{ $item->jadwal->mataKuliah->nama }}</div>
                                    <div class="text-xs text-slate-500 mt-0.5">
                                        Kelas: <span class="font-bold text-slate-700">{{ $item->jadwal->kelas->nama_kelas }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-slate-100 text-slate-700 font-numeric-token text-sm font-bold border border-slate-200">
                                        {{ $item->pertemuan_ke }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="font-label-medium text-label-medium font-bold text-on-surface">
                                        {{ $item->tanggal->format('d M Y') }}
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md font-label-xs text-label-xs font-bold border {{ $statusClasses[$item->status] ?? 'bg-slate-100 text-slate-700 border-slate-200' }}">
                                        @if($item->status == 'OPEN')
                                            <span class="w-1.5 h-1.5 rounded-full bg-amber-500 animate-pulse"></span>
                                        @endif
                                        {{ $statusLabels[$item->status] ?? $item->status }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <a href="{{ route('dosen.sesi_presensi.show', $item) }}" class="inline-flex items-center justify-center w-8 h-8 rounded-lg text-slate-400 hover:text-primary hover:bg-primary/10 transition-colors" title="Kelola Sesi">
                                        <span class="material-symbols-outlined text-[20px]">chevron_right</span>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center text-slate-500">
                                    <span class="material-symbols-outlined text-4xl mb-2 text-slate-300">history</span>
                                    <p class="font-body-sm">Belum ada riwayat sesi presensi yang dibuat.</p>
                                    <a href="{{ route('dosen.sesi_presensi.create') }}" class="inline-block mt-3 text-primary hover:underline font-label-medium text-sm">
                                        Buat Sesi Pertama
                                    </a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination -->
            @if ($sesi->hasPages())
                <div class="p-4 border-t border-slate-200 bg-slate-50">
                    {{ $sesi->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
