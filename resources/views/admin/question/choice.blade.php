@extends('admin.template.template', ['title' => 'Tambah Proses Seleksi Baru'])

@section('content')
        <input type="hidden" name="exams_id" value="{{ $exam->id }}">
        <div class="bg-white p-5 rounded-2xl w-full flex flex-col gap-3">
            <div class="flex items-center justify-between gap-3">
                <h1 class="font-sora font-semibold">{{ $exam->name }}</h1>
                <h1 class="font-sora font-semibold">Point : {{ $question->point }}</h1>
            </div>
            <hr>
            <div class="prose text-xs w-full">
                {!! $question->question !!}
            </div>
            <div class="flex flex-col gap-3">
                @foreach ($choices as $item)
                <div class="{{ $item->is_correct ? 'bg-green-100' : 'bg-red-100' }} rounded-md p-3">
                    <div class="flex justify-between items-center">
                        <div class="flex gap-3 items-center">
                            <span class="py-1 px-2 outline outline-1 outline-primary rounded-sm">{{ chr(65 + $loop->index) }}</span>
                            <span>{{ $item->choice }}</span>
                        </div>
                        <form action="{{ route('choices.destroy', $item->id) }}" method="POST" class="delete-choice-form">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:text-red-700">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-trash w-4 h-4" viewBox="0 0 16 16">
                                    <path d="M5.5 5.5a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0v-6a.5.5 0 0 1 .5-.5z"/>
                                    <path d="M8 5.5a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0v-6a.5.5 0 0 1 .5-.5z"/>
                                    <path d="M10.5 5.5a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0v-6a.5.5 0 0 1 .5-.5z"/>
                                    <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4H2.5a1 1 0 0 1-1-1V2h13v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3h11V2h-11v1z"/>
                                </svg>
                            </button>
                        </form>                        
                    </div>
                </div>
                @endforeach
                <!-- Tombol Trigger -->
                <div class="bg-gray-100 rounded-md p-3 text-center cursor-pointer" x-data="{ open: false }"
                    @click="open = true">
                    <span>+ Tambah Pilihan Baru</span>

                    <!-- Modal -->
                    <div x-show="open" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
                        <div @click.away="open = false" class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md">
                            <h2 class="text-lg font-semibold mb-4">Tambah Pilihan</h2>
                            <form method="post" action="{{ route('choices.store') }}">
                                @csrf
                                <input type="hidden" name="questions_id" value="{{ $question->id }}">

                                <div class="mb-4">
                                    <label class="block text-left text-sm font-medium mb-1" for="choice">Pilihan
                                        Jawaban</label>
                                    <input type="text" name="choice" id="choice" required
                                        class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                </div>

                                <div class="mb-4 text-left">
                                    <label class="inline-flex items-center">
                                        <input type="checkbox" name="is_correct" value="1"
                                            class="form-checkbox text-blue-600">
                                        <span class="ml-2">Jawaban Benar</span>
                                    </label>
                                </div>

                                <div class="flex justify-end gap-3">
                                    <button type="button" @click="open = false"
                                        class="px-4 py-2 bg-gray-300 rounded-md hover:bg-gray-400 transition">Batal</button>
                                    <button type="submit"
                                        class="px-4 py-2 bg-primary text-white rounded-md hover:bg-primary-hover transition">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="flex items-center justify-between">
                    <a href="{{ route('exam.show', $exam->id) }}" class="py-3 px-5 text-center bg-gray-200 text-primary font-sora font-semibold rounded-lg">Kembali</a>
                    <a href="{{ route('exam.show', $exam->id) }}" class="py-3 px-5 text-center bg-primary text-white font-sora font-semibold rounded-lg">Simpan</a>
                </div>

            </div>
        </div>

    <script>
        document.getElementById('submitBtn').addEventListener('click', function(e) {
            Swal.fire({
                title: "Apakah Anda yakin?",
                text: "Data akan disimpan!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya, Simpan!",
                cancelButtonText: "Batal"
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('myForm').submit(); // Ganti dengan ID form kamu
                }
            });
        });
    </script>
@endsection
