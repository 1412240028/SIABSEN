<x-app-layout>
    <div class="p-4 md:p-8 overflow-y-auto pb-24 md:pb-8">
        
        <!-- Page Header -->
        <div class="mb-8">
            <h2 class="font-headline-xl text-headline-xl font-bold text-on-surface">Scan Presensi</h2>
            <p class="font-body-sm text-body-sm text-on-surface-variant mt-1">Gunakan scanner QR atau masukkan token secara manual untuk mencatat kehadiran Anda.</p>
        </div>

        <div class="max-w-5xl mx-auto">
            @if ($errors->any())
                <div class="mb-6 rounded-lg border border-error/20 bg-error-container/30 p-4 text-sm font-label-medium text-error flex items-center gap-3">
                    <span class="material-symbols-outlined text-xl">error</span>
                    <span>{{ $errors->first() }}</span>
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-5 gap-6">
                
                <!-- Left: QR Scanner -->
                <div class="lg:col-span-3 bg-white rounded-xl border border-slate-200 shadow-soft p-6 flex flex-col h-full">
                    <div class="flex flex-col gap-4 sm:flex-row sm:items-center justify-between mb-6">
                        <div>
                            <h3 class="font-headline-sm text-headline-sm font-bold text-on-surface flex items-center gap-2">
                                <span class="material-symbols-outlined text-primary">qr_code_scanner</span>
                                Scanner QR Code
                            </h3>
                            <p class="font-body-sm text-sm text-on-surface-variant mt-1">Arahkan kamera ke QR Code yang ditampilkan oleh dosen.</p>
                        </div>
                        <div class="flex gap-2 shrink-0">
                            <button id="start-camera" type="button" class="bg-primary hover:bg-primary-container text-white font-label-medium text-sm px-4 py-2 rounded-lg flex items-center gap-2 shadow-sm transition-colors">
                                <span class="material-symbols-outlined text-[18px]">photo_camera</span>
                                Mulai Kamera
                            </button>
                            <button id="stop-camera" type="button" class="hidden bg-slate-100 hover:bg-slate-200 text-slate-700 font-label-medium text-sm px-4 py-2 rounded-lg items-center gap-2 transition-colors">
                                <span class="material-symbols-outlined text-[18px]">videocam_off</span>
                                Berhenti
                            </button>
                        </div>
                    </div>

                    <!-- Video Container -->
                    <div class="relative w-full aspect-[4/3] sm:aspect-video bg-slate-900 rounded-xl overflow-hidden border border-slate-200 group flex-grow min-h-[300px]">
                        
                        <!-- Video Feed -->
                        <video id="qr-video" class="w-full h-full object-cover" muted playsinline></video>
                        
                        <!-- Overlay when inactive -->
                        <div id="video-overlay" class="absolute inset-0 flex flex-col items-center justify-center bg-slate-800/80 backdrop-blur-sm text-slate-300">
                            <span class="material-symbols-outlined text-5xl mb-2 opacity-50">qr_code</span>
                            <p class="font-label-medium text-sm">Kamera Belum Aktif</p>
                        </div>

                        <!-- Scanner Guide (Corners) - Only show when active -->
                        <div id="scanner-guide" class="hidden absolute inset-0 pointer-events-none p-8">
                            <div class="w-full h-full border-2 border-primary/50 relative">
                                <div class="absolute -top-1 -left-1 w-8 h-8 border-t-4 border-l-4 border-primary"></div>
                                <div class="absolute -top-1 -right-1 w-8 h-8 border-t-4 border-r-4 border-primary"></div>
                                <div class="absolute -bottom-1 -left-1 w-8 h-8 border-b-4 border-l-4 border-primary"></div>
                                <div class="absolute -bottom-1 -right-1 w-8 h-8 border-b-4 border-r-4 border-primary"></div>
                                <!-- Scan Line Animation -->
                                <div class="absolute w-full h-[2px] bg-primary/80 shadow-[0_0_8px_2px_rgba(var(--color-primary),0.5)] animate-scan-line"></div>
                            </div>
                        </div>
                    </div>

                    <!-- Status Message -->
                    <div id="scanner-status" class="mt-4 rounded-lg border border-slate-200 bg-slate-50 px-4 py-3 text-sm font-label-medium text-slate-600 flex items-center gap-2 transition-colors duration-300">
                        <span class="material-symbols-outlined text-[18px]">info</span>
                        <span id="status-text">Silakan klik "Mulai Kamera" untuk memulai proses scanning.</span>
                    </div>
                </div>

                <!-- Right: Manual Token -->
                <div class="lg:col-span-2 flex flex-col gap-6">
                    
                    <div class="bg-primary-container rounded-xl border border-primary/20 shadow-soft p-6 flex-grow flex flex-col justify-center relative overflow-hidden">
                        <!-- Decorative background -->
                        <span class="material-symbols-outlined absolute -right-6 -bottom-6 text-[120px] text-primary/5 select-none pointer-events-none">password</span>

                        <h3 class="font-headline-sm text-headline-sm font-bold text-on-primary-container flex items-center gap-2 mb-2 relative z-10">
                            <span class="material-symbols-outlined">key</span>
                            Input Token Manual
                        </h3>
                        <p class="text-sm font-body-sm text-on-primary-container/80 mb-6 relative z-10">Gunakan form ini jika kamera tidak dapat membaca QR Code dengan baik.</p>
                        
                        <form id="scan-form" method="POST" action="{{ route('mahasiswa.presensi.scan') }}" class="relative z-10">
                            @csrf
                            
                            <div class="mb-4">
                                <input id="token" name="token" type="text" class="w-full px-4 py-3 border border-primary/30 rounded-lg text-center text-display-sm font-bold tracking-[0.2em] font-numeric-token text-primary focus:border-primary focus:ring-2 focus:ring-primary/20 bg-white shadow-inner uppercase transition-all" value="{{ old('token') }}" placeholder="--- ---" required autocomplete="off" />
                                <x-input-error :messages="$errors->get('token')" class="mt-2 text-error text-xs font-medium" />
                            </div>

                            <button type="submit" class="w-full bg-primary hover:bg-primary/90 text-white font-label-medium text-base px-4 py-3 rounded-lg flex items-center justify-center gap-2 shadow-sm transition-colors mt-6">
                                <span class="material-symbols-outlined text-[20px]">send</span>
                                Submit Token Presensi
                            </button>
                        </form>
                    </div>

                    <!-- Helper Card -->
                    <div class="bg-amber-50/50 rounded-xl border border-amber-200 p-5 shadow-sm text-sm">
                        <h4 class="font-bold text-amber-900 flex items-center gap-2 mb-3">
                            <span class="material-symbols-outlined text-[20px] text-amber-500">lightbulb</span> 
                            Tips Presensi
                        </h4>
                        <div class="space-y-3 font-body-sm text-amber-800">
                            <div class="flex items-start gap-2.5">
                                <span class="material-symbols-outlined text-[16px] text-amber-500 mt-0.5 shrink-0">wb_sunny</span>
                                <p class="leading-relaxed">Pastikan pencahayaan ruangan cukup terang saat memindai QR Code.</p>
                            </div>
                            <div class="flex items-start gap-2.5">
                                <span class="material-symbols-outlined text-[16px] text-amber-500 mt-0.5 shrink-0">keyboard</span>
                                <p class="leading-relaxed">Jika kamera *smartphone* buram, ketik <span class="font-bold">6 digit token</span> secara manual.</p>
                            </div>
                            <div class="flex items-start gap-2.5">
                                <span class="material-symbols-outlined text-[16px] text-amber-500 mt-0.5 shrink-0">history</span>
                                <p class="leading-relaxed">Periksa menu <a href="{{ route('mahasiswa.presensi.history') }}" class="font-bold text-amber-900 hover:underline">Riwayat Kehadiran</a> untuk memastikan presensi Anda tercatat.</p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Add Custom CSS for Scan Line Animation -->
    <style>
        @keyframes scanLine {
            0% { top: 0%; opacity: 0; }
            10% { opacity: 1; }
            90% { opacity: 1; }
            100% { top: 100%; opacity: 0; }
        }
        .animate-scan-line {
            animation: scanLine 2s linear infinite;
        }
    </style>

    <!-- Use HTML5-QRCode Library -->
    <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
    <script>
        (() => {
            const startButton = document.getElementById('start-camera');
            const stopButton = document.getElementById('stop-camera');
            const videoOverlay = document.getElementById('video-overlay');
            const scannerGuide = document.getElementById('scanner-guide');
            const statusBox = document.getElementById('scanner-status');
            const statusText = document.getElementById('status-text');
            const tokenInput = document.getElementById('token');
            const form = document.getElementById('scan-form');

            let html5QrCode = null;
            let scanning = false;

            const setStatus = (message, type = 'neutral', icon = 'info') => {
                const classes = {
                    neutral: 'border-slate-200 bg-slate-50 text-slate-600',
                    success: 'border-green-200 bg-green-50 text-green-700',
                    warning: 'border-amber-200 bg-amber-50 text-amber-700',
                    danger: 'border-error/20 bg-error-container/30 text-error',
                };
                const iconMap = {
                    neutral: 'info',
                    success: 'check_circle',
                    warning: 'warning',
                    danger: 'error'
                };

                statusBox.className = `mt-4 rounded-lg border px-4 py-3 text-sm font-label-medium flex items-center gap-2 transition-colors duration-300 ${classes[type]}`;
                statusBox.innerHTML = `<span class="material-symbols-outlined text-[18px]">${iconMap[type]}</span><span id="status-text">${message}</span>`;
            };

            const stopCamera = async () => {
                if (html5QrCode && scanning) {
                    try {
                        await html5QrCode.stop();
                    } catch (err) {
                        console.error("Failed to stop scanner", err);
                    }
                }
                scanning = false;
                
                startButton.classList.remove('hidden');
                stopButton.classList.add('hidden');
                stopButton.classList.remove('flex');
                
                videoOverlay.classList.remove('hidden');
                videoOverlay.classList.add('flex');
                scannerGuide.classList.add('hidden');
            };

            const onScanSuccess = (decodedText, decodedResult) => {
                if (!scanning) return;
                
                tokenInput.value = decodedText.trim();
                setStatus('QR berhasil terbaca! Mengirim presensi...', 'success');
                stopCamera();
                form.submit();
            };

            startButton.addEventListener('click', async () => {
                try {
                    setStatus('Meminta izin akses kamera...', 'neutral');
                    
                    if (!html5QrCode) {
                        html5QrCode = new Html5Qrcode("qr-video");
                    }

                    // Use facingMode: environment for rear camera
                    await html5QrCode.start(
                        { facingMode: "environment" },
                        {
                            fps: 10,
                            qrbox: { width: 250, height: 250 },
                            aspectRatio: 1.333334,
                            disableFlip: false
                        },
                        onScanSuccess,
                        (errorMessage) => {
                            // parse errors are normal, ignore them.
                        }
                    );

                    scanning = true;
                    
                    startButton.classList.add('hidden');
                    stopButton.classList.remove('hidden');
                    stopButton.classList.add('flex');
                    
                    videoOverlay.classList.add('hidden');
                    videoOverlay.classList.remove('flex');
                    scannerGuide.classList.remove('hidden');
                    
                    setStatus('Kamera aktif. Posisikan QR Code di dalam bingkai layar.', 'success');
                } catch (error) {
                    stopCamera();
                    setStatus('Gagal membuka kamera. Pastikan izin kamera aktif (Allow) dan akses via HTTPS atau localhost.', 'danger');
                    console.error(error);
                }
            });

            stopButton.addEventListener('click', () => {
                stopCamera();
                setStatus('Kamera dihentikan. Silakan klik "Mulai Kamera" untuk memindai.', 'neutral');
            });

            // Format token input with hyphens if desired, or just uppercase
            tokenInput.addEventListener('input', (e) => {
                e.target.value = e.target.value.toUpperCase().replace(/[^A-Z0-9]/g, '');
            });

            window.addEventListener('beforeunload', () => {
                if (scanning) {
                    html5QrCode.stop().catch(err => console.error(err));
                }
            });
        })();
    </script>
</x-app-layout>
