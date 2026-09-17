@extends('admin.template.template', ['title' => 'Tambah Proses Seleksi Baru'])

@section('content')
    <div class="bg-white p-5 rounded-2xl w-full">
        <div class="flex items-center justify-between gap-3">
            <h1 class="font-sora font-semibold">{{ $exam->name }}</h1>
            <div class="flex items-center gap-3">
                <a href="{{ route('exam.edit', $exam->id) }}"
                    class="px-2 py-1 flex font-thin bg-primary text-white rounded-md">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-pencil-square w-3"
                        viewBox="0 0 16 16">
                        <path
                            d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                        <path fill-rule="evenodd"
                            d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                    </svg>
                    <span class="ml-2">Edit Head</span>
                </a>
                <!-- Tombol Delete -->
                <button type="button" onclick="confirmDelete({{ $exam->id }})"
                    class="px-2 py-1 flex items-center font-thin bg-red-600 hover:bg-red-700 text-white rounded-md">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-trash w-3" viewBox="0 0 16 16">
                        <path
                            d="M5.5 5.5a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0v-6a.5.5 0 0 1 .5-.5zm2.5.5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0v-6zm2.5-.5a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0v-6a.5.5 0 0 1 .5-.5z" />
                        <path fill-rule="evenodd"
                            d="M14.5 3a1 1 0 0 1-1 1H13v9.5A1.5 1.5 0 0 1 11.5 15h-7A1.5 1.5 0 0 1 3 13.5V4h-.5a1 1 0 0 1 0-2H5a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1h1.5a1 1 0 0 1 1 1zm-3.5 1v9.5a.5.5 0 0 0 .5.5h-7a.5.5 0 0 0 .5-.5V4h6z" />
                    </svg>
                    <span class="ml-2">Hapus</span>
                </button>

                <!-- Form tersembunyi untuk dikirim via JS -->
                <form id="delete-form-{{ $exam->id }}" action="{{ route('exam.destroy', $exam->id) }}" method="POST"
                    class="hidden">
                    @csrf
                    @method('DELETE')
                </form>
            </div>
        </div>
        <hr class="my-3">
        <div class="prose my-3 text-xs w-full">
            {!! $exam->description !!}
        </div>
        <hr class="my-3">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
            <div class="p-3 outline outline-1 outline-primary rounded-md text-center flex flex-col gap-2">
                <span>Tanggal Pelaksanaan</span>
                <h1 class="font-sora font-semibold text-2xl">
                    {{ \Carbon\Carbon::parse($exam->start_date)->translatedFormat('d F Y, H:i') }} WIB
                </h1>
            </div>
            <div class="p-3 outline outline-1 outline-primary rounded-md text-center flex flex-col gap-2">
                <span>Durasi Pelaksanaan</span>
                <h1 class="font-sora font-semibold text-2xl">
                    {{ $exam->duration }} Menit</h1>
            </div>
            <div class="p-3 outline outline-1 outline-primary rounded-md text-center flex flex-col gap-2">
                <span>Status</span>
                <h1 class="font-sora font-semibold text-2xl">
                    {{ $exam->status }}</h1>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-2 md:grid-cols-5 gap-5 bg-white p-5 rounded-2xl w-full">
        <div class="p-3 outline outline-1 outline-primary rounded-md text-center flex flex-col gap-2">
            <span>Jumlah Soal</span>
            <h1 class="font-sora font-semibold text-2xl">{{ $totalSoal }}</h1>
        </div>
        <div class="p-3 outline outline-1 outline-primary rounded-md text-center flex flex-col gap-2">
            <span>Jumlah Pilihan Ganda</span>
            <h1 class="font-sora font-semibold text-2xl">{{ $jumlah_pilihan_ganda }}</h1>
        </div>
        <div class="p-3 outline outline-1 outline-primary rounded-md text-center flex flex-col gap-2">
            <span>Jumlah Jawaban Singkat</span>
            <h1 class="font-sora font-semibold text-2xl">{{ $jumlah_jawaban_singkat }}</h1>
        </div>
        <div class="p-3 outline outline-1 outline-primary rounded-md text-center flex flex-col gap-2">
            <span>Jumlah Jawaban Esai</span>
            <h1 class="font-sora font-semibold text-2xl">{{ $jumlah_esai }}</h1>
        </div>
        <div class="p-3 outline outline-1 outline-primary rounded-md text-center flex flex-col gap-2">
            <span>Jumlah Point</span>
            <h1 class="font-sora font-semibold text-2xl">{{ $totalPoint }}</h1>
        </div>
    </div>

    {{-- soal --}}

    @forelse ($questions as $question)
        <div class="bg-white p-5 rounded-2xl w-full flex flex-col gap-3">
            <div class="flex items-center justify-between gap-3">
                <span>Point : {{ $question->point }}</span>
                <div class="flex gap-3">
                    <a href="{{ route('question.edit', $question->id) }}"
                        class="px-2 py-1 flex font-thin bg-primary text-white rounded-md">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-pencil-square w-3"
                            viewBox="0 0 16 16">
                            <path
                                d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                            <path fill-rule="evenodd"
                                d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                        </svg>
                        <span class="ml-2">Edit Soal</span>
                    </a>
                    <form action="{{ route('question.destroy', $question->id) }}" method="POST" class="delete-form">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="px-2 py-1 flex font-thin bg-red-500 text-white rounded-md">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-file-earmark-x w-3"
                                viewBox="0 0 16 16">
                                <path
                                    d="M6.854 7.146a.5.5 0 1 0-.708.708L7.293 9l-1.147 1.146a.5.5 0 0 0 .708.708L8 9.707l1.146 1.147a.5.5 0 0 0 .708-.708L8.707 9l1.147-1.146a.5.5 0 0 0-.708-.708L8 8.293z" />
                                <path
                                    d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2M9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5z" />
                            </svg>
                            <span class="ml-2">Hapus Soal</span>
                        </button>
                    </form>
                </div>
            </div>
            <hr>
            <div class="prose my-3 text-xs w-full">
                {!! $question->question !!}
            </div>
            {{-- Tipe Soal --}}
            @if ($question->type === 'pilihan_ganda')
                {{-- Pilihan Ganda --}}
                <div class="flex flex-col gap-3">
                    @foreach ($choices->where('questions_id', $question->id) as $item)
                        <div class="{{ $item->is_correct ? 'bg-green-100' : 'bg-red-100' }} rounded-md p-3">
                            <div class="flex gap-3 items-center">
                                <span
                                    class="py-1 px-2 outline outline-1 outline-primary rounded-sm">{{ chr(65 + $loop->index) }}</span>
                                <span>{{ $item->choice }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            @elseif ($question->type === 'esai')
                {{-- Esai --}}
                <div class="flex flex-col gap-3">
                    <textarea placeholder="Jawaban" class="px-4 py-2 border rounded-md outline outline-1 h-24 outline-primary resize-none"></textarea>
                </div>
            @elseif ($question->type === 'jawaban_singkat')
                {{-- Jawaban Singkat --}}
                <div class="flex flex-col gap-3">
                    <input type="text" placeholder="Jawaban"
                        class="px-4 py-2 border rounded-md outline outline-1 h-10 outline-primary">
                </div>
            @endif
        </div>
    @empty
        <div class="bg-white p-5 rounded-2xl w-full flex flex-col items-center justify-center">
            <img src="{{ asset('assets/icons/empty_data.svg') }}" class="w-72" alt="empty">
            <h1 class="font-sora font-semibold my-3">Soal belum ada, klik tombol '+ Tambah Soal Baru' untuk menambahkan soal
                baru!</h1>
        </div>
    @endforelse

    <div class="bg-white p-5 rounded-2xl w-full text-center">
        <a href="{{ route('question.create', $exam->id) }}"
            class="bg-primary hover:bg-primary-hover py-2 px-4 text-white font-semibold rounded-md">+ Tambah Soal Baru</a>
    </div>

    <script>
        function confirmDelete(id) {
            Swal.fire({
                title: 'Yakin ingin menghapus?',
                text: "Data tidak bisa dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#e3342f',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + id).submit();
                }
            });
        }
    </script>


@endsection
