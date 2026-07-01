<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-1">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Scan Presensi</h2>
            <p class="text-sm text-gray-500">Arahkan kamera ke QR presensi atau masukkan token secara manual.</p>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-3xl mx-auto space-y-6 px-4 sm:px-6 lg:px-8">
            <section class="rounded-lg border border-gray-200 bg-white p-6 shadow-sm">
                <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900">Scanner QR</h3>
                        <p class="mt-1 text-sm text-gray-500">Scanner akan otomatis mengirim token setelah QR terbaca.</p>
                    </div>
                    <div class="flex gap-2">
                        <button id="start-camera" type="button" class="inline-flex items-center justify-center rounded-md bg-indigo-600 px-4 py-2 text-sm font-medium text-white hover:bg-indigo-700">
                            Mulai Kamera
                        </button>
                        <button id="stop-camera" type="button" class="hidden inline-flex items-center justify-center rounded-md border border-gray-300 px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">
                            Berhenti
                        </button>
                    </div>
                </div>

                <div class="mt-5 overflow-hidden rounded-lg border border-gray-200 bg-gray-950">
                    <video id="qr-video" class="aspect-video w-full bg-gray-950 object-cover" muted playsinline></video>
                </div>

                <div id="scanner-status" class="mt-4 rounded-md border border-gray-200 bg-gray-50 px-4 py-3 text-sm text-gray-600">
                    Kamera belum aktif.
                </div>
            </section>

            <section class="rounded-lg border border-gray-200 bg-white p-6 shadow-sm">
                <h3 class="text-lg font-semibold text-gray-900">Input Token Manual</h3>
                <p class="mt-1 text-sm text-gray-500">Gunakan ini kalau kamera tidak tersedia atau QR sulit terbaca.</p>

                <form id="scan-form" method="POST" action="{{ route('mahasiswa.presensi.scan') }}" class="mt-5">
                    @csrf

                    <div>
                        <x-input-label for="token" value="Token Presensi" />
                        <x-text-input id="token" name="token" type="text" class="mt-1 block w-full uppercase tracking-wide" value="{{ old('token') }}" required autofocus />
                        <x-input-error :messages="$errors->get('token')" class="mt-2" />
                    </div>

                    <div class="mt-6 flex justify-end gap-2">
                        <a href="{{ route('mahasiswa.presensi.history') }}" class="inline-flex items-center justify-center rounded-md border border-gray-300 px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">
                            Kembali
                        </a>
                        <x-primary-button>Submit Token</x-primary-button>
                    </div>
                </form>
            </section>
        </div>
    </div>

    <script>
        (() => {
            const startButton = document.getElementById('start-camera');
            const stopButton = document.getElementById('stop-camera');
            const video = document.getElementById('qr-video');
            const statusBox = document.getElementById('scanner-status');
            const tokenInput = document.getElementById('token');
            const form = document.getElementById('scan-form');

            let stream = null;
            let detector = null;
            let scanning = false;
            let submitted = false;

            const setStatus = (message, type = 'neutral') => {
                const classes = {
                    neutral: 'border-gray-200 bg-gray-50 text-gray-600',
                    success: 'border-green-200 bg-green-50 text-green-700',
                    warning: 'border-amber-200 bg-amber-50 text-amber-700',
                    danger: 'border-red-200 bg-red-50 text-red-700',
                };

                statusBox.className = `mt-4 rounded-md border px-4 py-3 text-sm ${classes[type]}`;
                statusBox.textContent = message;
            };

            const stopCamera = () => {
                scanning = false;

                if (stream) {
                    stream.getTracks().forEach((track) => track.stop());
                    stream = null;
                }

                video.srcObject = null;
                startButton.classList.remove('hidden');
                stopButton.classList.add('hidden');
            };

            const scanFrame = async () => {
                if (! scanning || submitted || ! detector) {
                    return;
                }

                try {
                    const codes = await detector.detect(video);

                    if (codes.length > 0) {
                        submitted = true;
                        const token = (codes[0].rawValue || '').trim();

                        if (token) {
                            tokenInput.value = token;
                            setStatus('QR terbaca. Mengirim presensi...', 'success');
                            stopCamera();
                            form.submit();
                            return;
                        }
                    }
                } catch (error) {
                    setStatus('Scanner belum bisa membaca frame kamera. Coba arahkan QR lebih jelas.', 'warning');
                }

                requestAnimationFrame(scanFrame);
            };

            startButton.addEventListener('click', async () => {
                if (! ('mediaDevices' in navigator) || ! navigator.mediaDevices.getUserMedia) {
                    setStatus('Browser tidak mendukung akses kamera. Masukkan token secara manual.', 'danger');
                    return;
                }

                if (! ('BarcodeDetector' in window)) {
                    setStatus('Browser belum mendukung scanner QR bawaan. Masukkan token secara manual.', 'warning');
                    return;
                }

                try {
                    detector = new BarcodeDetector({ formats: ['qr_code'] });
                    stream = await navigator.mediaDevices.getUserMedia({
                        video: {
                            facingMode: { ideal: 'environment' },
                        },
                        audio: false,
                    });

                    video.srcObject = stream;
                    await video.play();

                    scanning = true;
                    submitted = false;
                    startButton.classList.add('hidden');
                    stopButton.classList.remove('hidden');
                    setStatus('Kamera aktif. Arahkan QR ke area video.', 'success');
                    requestAnimationFrame(scanFrame);
                } catch (error) {
                    stopCamera();
                    setStatus('Kamera tidak bisa dibuka. Pastikan izin kamera aktif dan akses melalui HTTPS atau localhost.', 'danger');
                }
            });

            stopButton.addEventListener('click', () => {
                stopCamera();
                setStatus('Kamera dihentikan.', 'neutral');
            });

            tokenInput.addEventListener('input', () => {
                tokenInput.value = tokenInput.value.toUpperCase();
            });

            window.addEventListener('beforeunload', stopCamera);
        })();
    </script>
</x-app-layout>
