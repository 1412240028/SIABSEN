<x-app-layout>
    <div class="p-4 md:p-8 overflow-y-auto pb-24 md:pb-8">
        
        <!-- Page Header -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
            <div>
                <h2 class="font-headline-xl text-headline-xl font-bold text-on-surface">Data Kelas</h2>
                <p class="font-body-sm text-body-sm text-on-surface-variant mt-1">Kelola data kelas perkuliahan beserta kapasitasnya.</p>
            </div>
            @if (auth()->user()->isAdmin())
                <a href="{{ route('kelas.create') }}" class="bg-primary hover:bg-primary-container text-white font-label-medium text-label-medium px-5 py-2.5 rounded-lg flex items-center gap-2 shadow-sm transition-colors">
                    <span class="material-symbols-outlined text-[20px]">add</span>
                    Tambah Kelas
                </a>
            @endif
        </div>

        <!-- Main Content Card -->
        <div class="bg-white rounded-xl border border-slate-200 shadow-soft flex flex-col">
            
            <!-- Toolbar (Search & Filter) -->
            <div class="p-4 md:p-5 border-b border-slate-200 flex flex-col sm:flex-row justify-between items-center gap-4 bg-slate-50/50">
                <form method="GET" action="{{ route('kelas.index') }}" class="w-full sm:w-auto flex flex-col sm:flex-row gap-3">
                    <div class="relative w-full sm:w-72">
                        <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-outline text-sm">search</span>
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama kelas..." class="w-full pl-9 pr-4 py-2 border border-outline-variant rounded-lg text-body-sm focus:border-primary focus:ring-1 focus:ring-primary bg-white transition-colors">
                    </div>
                    <div class="flex gap-2">
                        <button type="submit" class="px-4 py-2 bg-white border border-outline-variant rounded-lg text-body-sm font-label-medium hover:bg-slate-50 transition-colors shadow-sm">Cari</button>
                        @if (request('search'))
                            <a href="{{ route('kelas.index') }}" class="px-4 py-2 text-error hover:bg-error-container/50 rounded-lg text-body-sm font-label-medium transition-colors">Reset</a>
                        @endif
                    </div>
                </form>
            </div>

            <!-- Table -->
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50 border-b border-slate-200 font-label-xs text-label-xs text-slate-500 uppercase tracking-wider">
                            <th class="px-6 py-4 font-medium">Nama Kelas</th>
                            <th class="px-6 py-4 font-medium">Angkatan</th>
                            <th class="px-6 py-4 font-medium">Kapasitas</th>
                            <th class="px-6 py-4 font-medium">Status</th>
                            <th class="px-6 py-4 font-medium text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 font-body-sm text-body-sm text-on-surface">
                        @forelse ($kelas as $item)
                            <tr class="hover:bg-slate-50/80 transition-colors">
                                <td class="px-6 py-4 font-bold text-on-surface">{{ $item->nama_kelas }}</td>
                                <td class="px-6 py-4">{{ $item->angkatan }}</td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-2 text-slate-600">
                                        <span class="material-symbols-outlined text-[16px]">groups</span>
                                        <span class="font-numeric-token">{{ $item->kapasitas }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    @if ($item->status)
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-md bg-status-hadir/10 text-status-hadir font-label-xs text-label-xs font-bold border border-status-hadir/20">
                                            Aktif
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-md bg-slate-100 text-slate-500 font-label-xs text-label-xs font-bold border border-slate-200">
                                            Nonaktif
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-right space-x-1">
                                    <a href="{{ route('kelas.show', $item) }}" class="inline-flex items-center justify-center w-8 h-8 rounded-lg text-slate-400 hover:text-primary hover:bg-primary/10 transition-colors" title="Lihat">
                                        <span class="material-symbols-outlined text-[20px]">visibility</span>
                                    </a>
                                    @if (auth()->user()->isAdmin())
                                        <a href="{{ route('kelas.edit', $item) }}" class="inline-flex items-center justify-center w-8 h-8 rounded-lg text-slate-400 hover:text-amber-600 hover:bg-amber-50 transition-colors" title="Edit">
                                            <span class="material-symbols-outlined text-[20px]">edit</span>
                                        </a>
                                        <button x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-kelas-deletion-{{ $item->id }}')" class="inline-flex items-center justify-center w-8 h-8 rounded-lg text-slate-400 hover:text-error hover:bg-error-container/50 transition-colors" title="Hapus">
                                            <span class="material-symbols-outlined text-[20px]">delete</span>
                                        </button>

                                        <!-- Delete Confirmation Modal -->
                                        <x-modal name="confirm-kelas-deletion-{{ $item->id }}" focusable>
                                            <form method="POST" action="{{ route('kelas.destroy', $item) }}" class="p-6">
                                                @csrf
                                                @method('DELETE')
                                                <div class="flex items-center gap-4 mb-4">
                                                    <div class="w-12 h-12 rounded-full bg-error-container/30 flex items-center justify-center text-error shrink-0">
                                                        <span class="material-symbols-outlined text-[24px]">warning</span>
                                                    </div>
                                                    <div>
                                                        <h2 class="text-lg font-headline-lg font-bold text-on-surface">Yakin mau hapus kelas "{{ $item->nama_kelas }}"?</h2>
                                                        <p class="mt-1 text-sm font-body-sm text-on-surface-variant">Data kelas ini akan disembunyikan (soft delete) namun tetap tersimpan di database.</p>
                                                    </div>
                                                </div>
                                                <div class="mt-6 flex justify-end gap-3">
                                                    <button type="button" x-on:click="$dispatch('close')" class="px-4 py-2 border border-outline-variant text-on-surface-variant font-label-medium rounded-lg hover:bg-slate-50 transition-colors">
                                                        Batal
                                                    </button>
                                                    <button type="submit" class="px-4 py-2 bg-error text-white font-label-medium rounded-lg hover:bg-on-error-container transition-colors shadow-sm">
                                                        Hapus Kelas
                                                    </button>
                                                </div>
                                            </form>
                                        </x-modal>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center text-slate-500">
                                    <span class="material-symbols-outlined text-4xl mb-2 text-slate-300">school</span>
                                    <p class="font-body-sm">Belum ada data kelas yang terdaftar.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination -->
            @if ($kelas->hasPages())
                <div class="p-4 border-t border-slate-200 bg-slate-50">
                    {{ $kelas->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>

