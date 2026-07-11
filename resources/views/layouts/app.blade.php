<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'SIABSEN') }}</title>

        <!-- Fonts & Icons -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.googleapis.com/css2?family=Figtree:wght@400;500;600;700&family=JetBrains+Mono:wght@500&display=swap" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet" />

        <style>
            .material-symbols-outlined {
                font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
            }
            .material-symbols-outlined[data-weight="fill"] {
                font-variation-settings: 'FILL' 1;
            }
            
            /* Subtle scrollbar */
            ::-webkit-scrollbar {
                width: 6px;
                height: 6px;
            }
            ::-webkit-scrollbar-track {
                background: transparent;
            }
            ::-webkit-scrollbar-thumb {
                background: #cbd5e1;
                border-radius: 10px;
            }
            ::-webkit-scrollbar-thumb:hover {
                background: #94a3b8;
            }
        </style>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-slate-50 text-on-surface font-body-base overflow-x-hidden antialiased">
        <div x-data="{ sidebarOpen: false }" class="flex min-h-screen w-full">
            
            {{-- Mobile Sidebar Overlay --}}
            <div x-show="sidebarOpen" 
                 x-transition:enter="transition-opacity ease-linear duration-300"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 x-transition:leave="transition-opacity ease-linear duration-300"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"
                 class="fixed inset-0 bg-slate-900/50 z-40 md:hidden backdrop-blur-sm" 
                 @click="sidebarOpen = false" 
                 style="display: none;"></div>
            
            {{-- SideNavBar --}}
            <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'" class="h-screen w-sidebar-expanded fixed left-0 top-0 bg-slate-900 border-r border-slate-800 z-50 flex flex-col p-4 transition-transform duration-300 ease-in-out md:translate-x-0">
                {{-- Header/Brand --}}
                <div class="flex items-center gap-3 mb-8 px-2 mt-2">
                    <div class="w-10 h-10 rounded-lg bg-primary-container flex items-center justify-center shrink-0">
                        <span class="material-symbols-outlined text-white" data-weight="fill">school</span>
                    </div>
                    <div>
                        <h1 class="font-headline-2xl text-headline-2xl font-bold text-white tracking-tight">SIABSEN</h1>
                        <p class="font-label-xs text-label-xs text-slate-400">Portal Akademik</p>
                    </div>
                </div>

                {{-- Navigation Links --}}
                <nav class="flex-1 space-y-1 overflow-y-auto pr-1">
                    @php
                        $role = auth()->user()->role;
                        $dashboardRoute = route('dashboard');
                    @endphp

                    {{-- Dashboard --}}
                    <a href="{{ $dashboardRoute }}" class="{{ request()->routeIs('dashboard') || request()->routeIs('admin.dashboard') || request()->routeIs('dosen.dashboard') || request()->routeIs('mahasiswa.dashboard') ? 'bg-primary text-white' : 'text-slate-400 hover:text-white hover:bg-slate-800 transition-colors' }} flex items-center gap-3 px-4 py-3 rounded-lg font-label-medium text-label-medium">
                        <span class="material-symbols-outlined" data-weight="fill">dashboard</span>
                        Dashboard
                    </a>

                    @if (auth()->user()->isAdmin())
                        <a href="{{ route('kelas.index') }}" class="{{ request()->routeIs('kelas.*') ? 'bg-primary text-white' : 'text-slate-400 hover:text-white hover:bg-slate-800 transition-colors' }} flex items-center gap-3 px-4 py-3 rounded-lg font-label-medium text-label-medium">
                            <span class="material-symbols-outlined">school</span>
                            Manajemen Kelas
                        </a>
                        <a href="{{ route('mata_kuliah.index') }}" class="{{ request()->routeIs('mata_kuliah.*') ? 'bg-primary text-white' : 'text-slate-400 hover:text-white hover:bg-slate-800 transition-colors' }} flex items-center gap-3 px-4 py-3 rounded-lg font-label-medium text-label-medium">
                            <span class="material-symbols-outlined">menu_book</span>
                            Mata Kuliah
                        </a>
                        <a href="{{ route('dosen.index') }}" class="{{ request()->routeIs('dosen.*') && !request()->routeIs('dosen.dashboard') && !request()->routeIs('dosen.sesi_presensi.*') ? 'bg-primary text-white' : 'text-slate-400 hover:text-white hover:bg-slate-800 transition-colors' }} flex items-center gap-3 px-4 py-3 rounded-lg font-label-medium text-label-medium">
                            <span class="material-symbols-outlined">person_4</span>
                            Dosen
                        </a>
                        <a href="{{ route('mahasiswa.index') }}" class="{{ request()->routeIs('mahasiswa.*') && !request()->routeIs('mahasiswa.dashboard') && !request()->routeIs('mahasiswa.presensi.*') ? 'bg-primary text-white' : 'text-slate-400 hover:text-white hover:bg-slate-800 transition-colors' }} flex items-center gap-3 px-4 py-3 rounded-lg font-label-medium text-label-medium">
                            <span class="material-symbols-outlined">group</span>
                            Mahasiswa
                        </a>
                        <a href="{{ route('admin.jadwal.index') }}" class="{{ request()->routeIs('admin.jadwal.*') ? 'bg-primary text-white' : 'text-slate-400 hover:text-white hover:bg-slate-800 transition-colors' }} flex items-center gap-3 px-4 py-3 rounded-lg font-label-medium text-label-medium">
                            <span class="material-symbols-outlined">event</span>
                            Jadwal Kuliah
                        </a>
                    @elseif (auth()->user()->isDosen())
                        <a href="{{ route('kelas.index') }}" class="{{ request()->routeIs('kelas.*') ? 'bg-primary text-white' : 'text-slate-400 hover:text-white hover:bg-slate-800 transition-colors' }} flex items-center gap-3 px-4 py-3 rounded-lg font-label-medium text-label-medium">
                            <span class="material-symbols-outlined">school</span>
                            Manajemen Kelas
                        </a>
                        <a href="{{ route('dosen.sesi_presensi.index') }}" class="{{ request()->routeIs('dosen.sesi_presensi.*') ? 'bg-primary text-white' : 'text-slate-400 hover:text-white hover:bg-slate-800 transition-colors' }} flex items-center gap-3 px-4 py-3 rounded-lg font-label-medium text-label-medium">
                            <span class="material-symbols-outlined">co_present</span>
                            Sesi Presensi
                        </a>
                    @endif

                    {{-- Laporan Riwayat --}}
                    @if (auth()->user()->isAdmin())
                        <a href="{{ route('admin.presensi.rekap') }}" class="{{ request()->routeIs('admin.presensi.rekap') ? 'bg-primary text-white' : 'text-slate-400 hover:text-white hover:bg-slate-800 transition-colors' }} flex items-center gap-3 px-4 py-3 rounded-lg font-label-medium text-label-medium">
                            <span class="material-symbols-outlined">history_edu</span>
                            Laporan Riwayat
                        </a>
                    @elseif (auth()->user()->isDosen())
                        <a href="{{ route('dosen.sesi_presensi.index') }}" class="text-slate-400 hover:text-white hover:bg-slate-800 transition-colors flex items-center gap-3 px-4 py-3 rounded-lg font-label-medium text-label-medium">
                            <span class="material-symbols-outlined">history_edu</span>
                            Laporan Riwayat
                        </a>
                    @elseif (auth()->user()->isMahasiswa())
                        <a href="{{ route('mahasiswa.presensi.history') }}" class="{{ request()->routeIs('mahasiswa.presensi.history') ? 'bg-primary text-white' : 'text-slate-400 hover:text-white hover:bg-slate-800 transition-colors' }} flex items-center gap-3 px-4 py-3 rounded-lg font-label-medium text-label-medium">
                            <span class="material-symbols-outlined">history_edu</span>
                            Laporan Riwayat
                        </a>
                    @endif

                    @if (auth()->user()->isAdmin())
                        {{-- Kalender Akademik (dummy) --}}
                        <a href="{{ route('admin.kalender.index') }}" class="{{ request()->routeIs('admin.kalender.*') ? 'bg-primary text-white' : 'text-slate-400 hover:text-white hover:bg-slate-800 transition-colors' }} flex items-center gap-3 px-4 py-3 rounded-lg transition-colors font-label-medium text-label-medium">
                            <span class="material-symbols-outlined">calendar_month</span>
                            Kalender Akademik
                        </a>
                    @endif
                    
                    {{-- Pengaturan --}}
                    <a href="{{ route('profile.edit') }}" class="{{ request()->routeIs('profile.*') ? 'bg-primary text-white' : 'text-slate-400 hover:text-white hover:bg-slate-800 transition-colors' }} flex items-center gap-3 px-4 py-3 rounded-lg font-label-medium text-label-medium">
                        <span class="material-symbols-outlined">settings</span>
                        Pengaturan
                    </a>
                </nav>

                {{-- User Profile (Bottom of Sidebar) --}}
                <div class="mt-auto pt-4 border-t border-slate-800">
                    <form method="POST" action="{{ route('logout') }}" id="logout-form">
                        @csrf
                        <div onclick="document.getElementById('logout-form').submit();" class="flex items-center gap-3 px-2 py-2 hover:bg-slate-800 rounded-lg cursor-pointer transition-colors group relative">
                            @if (auth()->user()->avatar)
                                <img class="w-8 h-8 rounded-full object-cover" src="{{ asset('storage/' . auth()->user()->avatar) }}" alt="Avatar" />
                            @else
                                <div class="w-8 h-8 rounded-full bg-primary text-white font-bold flex items-center justify-center text-xs flex-shrink-0">
                                    {{ substr(auth()->user()->name, 0, 2) }}
                                </div>
                            @endif
                            <div class="flex-1 min-w-0">
                                <p class="font-label-medium text-label-medium text-white truncate">{{ auth()->user()->name }}</p>
                                <p class="font-label-xs text-label-xs text-slate-400 truncate">{{ auth()->user()->email }}</p>
                            </div>
                            <span class="material-symbols-outlined text-slate-500 group-hover:text-error transition-colors absolute right-2 opacity-0 group-hover:opacity-100">logout</span>
                        </div>
                    </form>
                </div>
            </aside>

            {{-- Main Content Canvas --}}
            <main class="flex-1 flex flex-col md:ml-sidebar-expanded min-h-screen pt-navbar-height bg-background">
                
                {{-- TopNavBar --}}
                <header class="bg-surface dark:bg-on-background border-b border-outline-variant shadow-soft h-navbar-height flex items-center justify-between px-4 md:px-8 z-30 fixed top-0 left-0 right-0 md:left-sidebar-expanded">
                    {{-- Mobile Menu Trigger --}}
                    <button @click="sidebarOpen = true" class="md:hidden p-2 -ml-2 text-on-surface-variant hover:text-primary transition-colors cursor-pointer active:opacity-80">
                        <span class="material-symbols-outlined">menu</span>
                    </button>

                    <div class="hidden md:block">
                        <!-- Left side of header (Empty for now) -->
                    </div>

                    {{-- Right Actions --}}
                    <div class="flex items-center gap-4">
                        <div class="relative hidden sm:block">
                            <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-outline text-sm">search</span>
                            <input class="pl-10 pr-4 py-2 border border-outline-variant rounded-lg text-body-sm font-body-sm focus:outline-none focus:ring-2 focus:ring-primary-container focus:border-transparent w-64 bg-transparent" placeholder="Cari data..." type="text" />
                        </div>
                        <button class="p-2 text-on-surface-variant hover:text-primary transition-colors cursor-pointer active:opacity-80 relative">
                            <span class="material-symbols-outlined">notifications</span>
                            <span class="absolute top-1.5 right-1.5 w-2 h-2 bg-error rounded-full"></span>
                        </button>
                        <button class="p-2 text-on-surface-variant hover:text-primary transition-colors cursor-pointer active:opacity-80 hidden sm:block">
                            <span class="material-symbols-outlined">help</span>
                        </button>
                    </div>
                </header>

                {{-- Dashboard Content Area --}}
                <div class="flex-1 flex flex-col">
                    {{-- Flash Messages --}}
                    <div class="p-4 md:p-8 md:pb-0 pb-0 space-y-2">
                        @if (session('success'))
                            <div class="bg-green-50 border border-green-200 text-status-hadir px-4 py-3 rounded-lg relative flex items-center gap-2 shadow-sm" role="alert">
                                <span class="material-symbols-outlined">check_circle</span>
                                <span class="font-medium text-sm">{{ session('success') }}</span>
                            </div>
                        @endif
                        @if (session('info'))
                            <div class="bg-blue-50 border border-blue-200 text-status-izin px-4 py-3 rounded-lg relative flex items-center gap-2 shadow-sm" role="alert">
                                <span class="material-symbols-outlined">info</span>
                                <span class="font-medium text-sm">{{ session('info') }}</span>
                            </div>
                        @endif
                        @if (session('error') || session('danger'))
                            <div class="bg-red-50 border border-red-200 text-error px-4 py-3 rounded-lg relative flex items-center gap-2 shadow-sm" role="alert">
                                <span class="material-symbols-outlined">error</span>
                                <span class="font-medium text-sm">{{ session('error') ?: session('danger') }}</span>
                            </div>
                        @endif
                    </div>

                    {{ $slot }}
                </div>
            </main>
        </div>
    </body>
</html>
