@extends('admin.template.template', ['title' => 'Jalur Pendaftaran'])

@section('content')
    <div class="w-full mx-auto p-6 bg-white rounded-xl shadow-md border border-gray-200">
        <div class="flex items-center justify-between gap-3">
            <div class="flex items-center gap-3">
                <a href="{{ route('particimant.index', $exam->id) }}" class="bg-gray-100 hover:bg-gray-200 p-2 rounded-md">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-arrow-left w-3" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8" />
                    </svg>
                </a>
                <h1 class="font-sora font-semibold text-gray-800 text-lg">Hasil {{ $exam->name }}</h1>
            </div>
        </div>

        <hr class="my-5">

        {{-- Ringkasan Nilai --}}
        <div class="bg-gray-50 border-l-8 border-primary p-5 rounded-lg shadow-inner mb-6">
            <p class="text-lg font-semibold">Skor Anda: {{ $totalPoint }} / {{ $maxPoint }}</p>
            <p class="text-gray-700 mt-2">Anda menjawab benar <strong>{{ $correctAnswers }}</strong> dari
                <strong>{{ $totalQuestions }}</strong> soal.
            </p>
        </div>

        {{-- Detail Jawaban --}}
        <div class="space-y-4 text-xs">
            @foreach ($answers as $answer)
                <div
                    class="p-4 border rounded-md @if ($answer->is_correct) bg-green-50 border-green-300 @else bg-red-50 border-red-300 @endif">
                    <div class="text-xs text-gray-500 mb-2">Soal ke-{{ $loop->iteration }}</div>
                    <p class="text-gray-800 mb-2">{!! $answer->question->question !!}</p>
                    <p class="text-xs">
                        Jawaban Anda:
                        <span class="font-semibold">
                            @if ($answer->question->type === 'pilihan_ganda')
                                {{ $answer->choice->choice ?? 'N/A' }}
                            @else
                                {{ $answer->answer }}
                            @endif
                        </span>
                        @if ($answer->is_correct)
                            <span class="text-green-600 ml-2">✓ Benar</span>
                        @else
                            <span class="text-red-600 ml-2">✗ Salah</span>
                        @endif
                    </p>
                    <div class="flex items-center gap-3 mt-3">
                        <form id="toggle-answer-{{ $answer->id }}" action="{{ route('result.update', $answer->id) }}"
                            method="post">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="is_correct" value="{{ $answer->is_correct }}">
                            <input type="hidden" name="exams_id" value="{{ $exam->id }}">
                            <input type="hidden" name="question_id" value="{{ $answer->question->id }}">
                            <input type="hidden" name="user_id" value="{{ $participant->user_id }}">
                            @if ($answer->is_correct)
                                <button type="button" onclick="confirmToggle({{ $answer->id }})"
                                    class="py-2 px-3 rounded-md bg-red-500 hover:bg-red-600 text-white">Salahkan</button>
                            @else
                                <button type="button" onclick="confirmToggle({{ $answer->id }})"
                                    class="py-2 px-3 rounded-md bg-primary hover:bg-primary-hover text-white">Benarkan</button>
                            @endif
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <script>
        function confirmToggle(answerId) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Jawaban peserta akan diubah.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, ubah!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('toggle-answer-' + answerId).submit();
                }
            });
        }
    </script>
@endsection
