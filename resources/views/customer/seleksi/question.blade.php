@extends('customer.seleksi.template', ['title' => 'Seleksi'])

@section('content')
    <form method="post" action="{{ route('test.answer.store', [$id, $questionNumber]) }}" id="formSoal">
        @csrf
        <input type="hidden" name="question_id" value="{{ $currentQuestion->id }}">
        <div class="grid grid-cols-1 md:grid-cols-8 gap-5 items-start">
            <div class="md:col-span-6">
                <div class="w-full bg-white md:flex items-center p-5 rounded-2xl outline outline-1 outline-gray-200 mb-3">
                    <div class="flex gap-2">
                        <small class="font-sora font-semibold flex gap-2">
                            Soal {{ $questionNumber }}
                        </small>
                    </div>
                </div>
                <div class="w-full bg-white md:flex flex-col gap-5 p-5 rounded-2xl outline outline-1 outline-gray-200">
                    <div class="flex flex-col gap-3 prose text-xs mb-5 md:mb-0">
                        {!! $currentQuestion->question !!}
                    </div>
                    <div class="flex flex-col gap-3 mb-5 md:mb-0">
                        {{-- Tipe Soal --}}
                        @if ($currentQuestion->type === 'pilihan_ganda')
                            {{-- Pilihan Ganda --}}
                            <div class="flex flex-col">
                                @foreach ($choices->where('questions_id', $currentQuestion->id) as $item)
                                    <label class="rounded-md p-3 block cursor-pointer">
                                        <div class="flex gap-3 items-center">
                                            <input type="radio" name="answer" value="{{ $item->id }}"
                                                class="hidden peer" @if ($userAnswer && $userAnswer->answer == $item->id) checked @endif />
                                            <span
                                                class="py-1 px-2 outline outline-1 outline-primary rounded-sm peer-checked:bg-primary peer-checked:text-white">
                                                {{ chr(65 + $loop->index) }}
                                            </span>
                                            <span>{{ $item->choice }}</span>
                                        </div>
                                    </label>
                                @endforeach
                            </div>
                        @elseif ($currentQuestion->type === 'esai')
                            {{-- Esai --}}
                            <div class="flex flex-col gap-3">
                                <textarea placeholder="Jawaban" name="answer"
                                    class="px-4 py-2 border rounded-md outline outline-1 h-24 outline-primary resize-none">{{ $userAnswer->answer ?? '' }}</textarea>
                            </div>
                        @elseif ($currentQuestion->type === 'jawaban_singkat')
                            {{-- Jawaban Singkat --}}
                            <div class="flex flex-col gap-3">
                                <input type="text" placeholder="Jawaban" name="answer"
                                    class="px-4 py-2 border rounded-md outline outline-1 h-10 outline-primary"
                                    value="{{ $userAnswer->answer ?? '' }}">
                            </div>
                        @endif
                    </div>
                    <div class="flex items-center justify-between gap-5">
                        @if ($questionNumber > 1)
                            <a href="{{ route('test.question', [$id, $questionNumber - 1]) }}"
                                class="bg-gray-200 py-2 px-3 rounded-md">Sebelumnya</a>
                        @else
                            <span class="bg-gray-100 py-2 px-3 rounded-md text-gray-400">Sebelumnya</span>
                        @endif

                        <button id="submit-btn"
                            class="bg-primary hover:bg-primary-hover text-white py-2 px-3 rounded-md flex items-center gap-2 justify-center"
                            type="submit">
                            <span id="btn-text">Selanjutnya</span>
                            <svg id="loading-spinner" class="hidden animate-spin h-5 w-5 text-white"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                    stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z">
                                </path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
    </form>
    <div class="bg-white rounded-2xl p-5 md:col-span-2 flex flex-col gap-5">
        <div class="bg-primary text-white p-5 rounded-md">
            <h2 class="font-semibold mb-4">Waktu Tersisa</h2>
            <div id="countdown" class="text-3xl font-semibold">
                00:00:00
            </div>
        </div>
        <hr>
        <div class="grid grid-cols-5 gap-3 items-start">
            @foreach ($questionLists as $index => $questionList)
                <a href="{{ route('test.question', [$id, $index + 1]) }}"
                    class="outline outline-1 outline-primary hover:bg-primary hover:text-white p-2 text-center rounded-sm
                        {{ $index + 1 == $questionNumber ? 'bg-primary text-white' : '' }}">
                    {{ $index + 1 }}
                </a>
            @endforeach
        </div>
        <hr>
        <div class="flex flex-col gap-3">
            <form action="{{ route('test.finish') }}" method="post" id="finishForm">
                @csrf
                <input type="hidden" name="exams_id" value="{{ $exam->id }}">
                <button id="confirmFinish" type="button"
                    class="bg-primary py-2 text-center rounded-md text-white w-full hover:bg-primary-hover">Selesaikan
                    Ujian</button>
                <small class="text-red-500">* Klik tombol ini jika merasa sudah yakin dan sudah terisi semua
                    pertanyaan</small>
            </form>
        </div>
    </div>
    </div>


    <script>
        // Ambil data dari backend
        const startDate = new Date("{{ \Carbon\Carbon::parse($startDate)->format('Y-m-d H:i:s') }}").getTime();
        const durationMinutes = {{ $durationMinutes }};

        // Hitung endDate
        const endDate = startDate + (durationMinutes * 60 * 1000);
    </script>

    <script>
        // Update countdown setiap 1 detik
        let x = setInterval(function() {
            let now = new Date().getTime();
            let distance = endDate - now;

            if (distance < 0) {
                clearInterval(x);
                document.getElementById("countdown").innerHTML = "Waktu Habis";
                return;
            }

            let hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            let minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            let seconds = Math.floor((distance % (1000 * 60)) / 1000);

            document.getElementById("countdown").innerHTML =
                hours.toString().padStart(2, '0') + ":" +
                minutes.toString().padStart(2, '0') + ":" +
                seconds.toString().padStart(2, '0');
        }, 1000);
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const form = document.querySelector("form");
            const submitBtn = document.getElementById("submit-btn");
            const btnText = document.getElementById("btn-text");
            const loadingSpinner = document.getElementById("loading-spinner");

            form.addEventListener("submit", function() {
                submitBtn.disabled = true; // Nonaktifkan tombol
                btnText.textContent = "Loading..."; // Ubah teks tombol
                loadingSpinner.classList.remove("hidden"); // Tampilkan spinner
            });
        });
    </script>

    <script>
        document.getElementById('confirmFinish').addEventListener('click', function(e) {
            Swal.fire({
                title: 'Selesai?',
                text: "Apakah Anda yakin semua soal sudah diisi?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Selesaikan!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    localStorage.setItem('screen', 'no');
                    document.getElementById('finishForm').submit();
                }
            });
        });
    </script>

    <script>
        // Fungsi untuk membekukan interaksi halaman
        function freezePageFor(durationInMs) {
            // Buat overlay di seluruh halaman
            const overlay = document.createElement('div');
            overlay.id = 'freezeOverlay';
            overlay.style.position = 'fixed';
            overlay.style.top = 0;
            overlay.style.left = 0;
            overlay.style.width = '100vw';
            overlay.style.height = '100vh';
            overlay.style.backgroundColor = 'rgba(0, 0, 0, 0.7)';
            overlay.style.zIndex = 9999;
            overlay.style.cursor = 'not-allowed';
            document.body.appendChild(overlay);

            // Tampilkan SweetAlert dengan countdown
            let countdown = durationInMs / 1000;
            Swal.fire({
                title: 'Pelanggaran Terdeteksi!',
                html: `Anda melakukan pelanggaran.<br>Harap tunggu <b><span id="countdown">${countdown}</span></b> detik.`,
                icon: 'error',
                allowOutsideClick: false,
                allowEscapeKey: false,
                didOpen: () => {
                    const countdownEl = Swal.getHtmlContainer().querySelector('#countdown');
                    const timer = setInterval(() => {
                        countdown--;
                        countdownEl.textContent = countdown;
                        if (countdown <= 0) {
                            clearInterval(timer);
                            Swal.close();
                            overlay.remove();
                        }
                    }, 1000);
                }
            });
        }

        // 🔒 Deteksi pindah tab
        let lastHiddenTime = 0;
        document.addEventListener('visibilitychange', () => {
            if (document.hidden) {
                lastHiddenTime = Date.now();
            } else {
                if (Date.now() - lastHiddenTime > 1000) {
                    freezePageFor(60000); // freeze 1 menit
                }
            }
        });

        // 🔒 Cegah copy, cut, paste, klik kanan
        ['copy', 'cut', 'paste', 'contextmenu'].forEach(eventType => {
            document.addEventListener(eventType, e => {
                e.preventDefault();
                freezePageFor(60000); // freeze 1 menit
            });
        });

        // 🔒 Cegah Ctrl+C, Ctrl+X, Ctrl+V
        document.addEventListener('keydown', e => {
            if ((e.ctrlKey || e.metaKey) && ['c', 'x', 'v'].includes(e.key.toLowerCase())) {
                e.preventDefault();
                freezePageFor(60000); // freeze 1 menit
            }
        });
    </script>


@endsection
