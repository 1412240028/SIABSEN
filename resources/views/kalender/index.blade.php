<x-app-layout>
    <div class="p-4 md:p-8 overflow-y-auto">
        <div class="flex items-center justify-between mb-8">
            <div>
                <a href="{{ route('admin.dashboard') }}" class="text-on-surface-variant hover:text-primary font-label-medium flex items-center gap-1 transition-colors mb-2">
                    <span class="material-symbols-outlined text-[18px]">arrow_back</span> Dashboard
                </a>
                <h2 class="font-headline-xl text-headline-xl font-bold text-on-surface">Kalender Akademik</h2>
                <p class="text-on-surface-variant mt-1 text-body-lg">Jadwal kegiatan akademik universitas.</p>
            </div>
            @if(auth()->user()->role === 'admin')
            <a href="{{ route('admin.kalender.create') }}" class="bg-primary hover:bg-primary-container text-white font-label-medium px-5 py-2.5 rounded-lg flex items-center gap-2 shadow-sm transition-colors">
                <span class="material-symbols-outlined text-[18px]">add</span> Tambah Kegiatan
            </a>
            @endif
        </div>

        <div class="bg-white rounded-xl border border-outline-variant shadow-soft overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-surface-variant/30 border-b border-outline-variant">
                            <th class="px-6 py-4 text-sm font-label-medium text-on-surface-variant uppercase tracking-wider">TANGGAL</th>
                            <th class="px-6 py-4 text-sm font-label-medium text-on-surface-variant uppercase tracking-wider">KEGIATAN</th>
                            <th class="px-6 py-4 text-sm font-label-medium text-on-surface-variant uppercase tracking-wider">JENIS</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-outline-variant">
                        @forelse($kalender as $k)
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="px-6 py-4 text-body-sm font-medium text-on-surface whitespace-nowrap">
                                {{ \Carbon\Carbon::parse($k->tanggal_mulai)->format('d M Y') }}
                                @if($k->tanggal_mulai != $k->tanggal_selesai)
                                    - {{ \Carbon\Carbon::parse($k->tanggal_selesai)->format('d M Y') }}
                                @endif
                            </td>
                            <td class="px-6 py-4 text-body-sm text-on-surface">{{ $k->kegiatan }}</td>
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 rounded-full text-xs font-bold bg-slate-100 text-slate-700">
                                    {{ $k->jenis }}
                                </span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="px-6 py-8 text-center text-on-surface-variant">Belum ada kegiatan akademik.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
