<x-app-layout>
    <div class="p-4 md:p-8 overflow-y-auto">
        <div class="flex items-center justify-between mb-8">
            <div>
                <a href="{{ route('admin.dashboard') }}" class="text-on-surface-variant hover:text-primary font-label-medium flex items-center gap-1 transition-colors mb-2">
                    <span class="material-symbols-outlined text-[18px]">arrow_back</span> Dashboard
                </a>
                <h2 class="font-headline-xl text-headline-xl font-bold text-on-surface">Manajemen Pengumuman</h2>
                <p class="text-on-surface-variant mt-1 text-body-lg">Kelola pengumuman untuk seluruh mahasiswa.</p>
            </div>
            <a href="{{ route('admin.pengumuman.create') }}" class="bg-primary hover:bg-primary-container text-white font-label-medium px-5 py-2.5 rounded-lg flex items-center gap-2 shadow-sm transition-colors">
                <span class="material-symbols-outlined text-[18px]">add</span> Tambah Pengumuman
            </a>
        </div>

        <div class="bg-white rounded-xl border border-outline-variant shadow-soft overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-surface-variant/30 border-b border-outline-variant">
                            <th class="px-6 py-4 text-sm font-label-medium text-on-surface-variant uppercase tracking-wider">TANGGAL</th>
                            <th class="px-6 py-4 text-sm font-label-medium text-on-surface-variant uppercase tracking-wider">JUDUL</th>
                            <th class="px-6 py-4 text-sm font-label-medium text-on-surface-variant uppercase tracking-wider">KATEGORI</th>
                            <th class="px-6 py-4 text-sm font-label-medium text-on-surface-variant uppercase tracking-wider">STATUS</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-outline-variant">
                        @forelse($pengumuman as $p)
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="px-6 py-4 text-body-sm font-medium text-on-surface whitespace-nowrap">{{ $p->created_at->format('d M Y') }}</td>
                            <td class="px-6 py-4 text-body-sm text-on-surface">{{ $p->judul }}</td>
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 rounded-full text-xs font-bold
                                    @if($p->kategori == 'Penting') bg-error/10 text-error
                                    @elseif($p->kategori == 'Akademik') bg-primary/10 text-primary
                                    @else bg-slate-100 text-slate-600 @endif">
                                    {{ $p->kategori }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 rounded-full text-xs font-bold {{ $p->is_active ? 'bg-green-100 text-green-700' : 'bg-slate-100 text-slate-500' }}">
                                    {{ $p->is_active ? 'Aktif' : 'Tidak Aktif' }}
                                </span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-6 py-8 text-center text-on-surface-variant">Belum ada pengumuman.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
