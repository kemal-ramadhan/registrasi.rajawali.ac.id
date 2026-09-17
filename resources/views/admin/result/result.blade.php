@extends('admin.template.template', ['title' => 'Jalur Pendaftaran'])

@section('content')
    <div class="w-full mx-auto p-6 bg-white rounded-xl shadow-md border border-gray-200">
        <div class="flex items-center justify-between gap-3">
            <div class="flex items-center gap-3">
                <a href="{{ route('particimant.index', $exam->id) }}" class="bg-gray-100 hover:bg-gray-200 p-2 rounded-md">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-arrow-left w-3"
                        viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8" />
                    </svg>
                </a>
                <h1 class="font-sora font-semibold text-gray-800 text-lg">Hasil {{ $exam->name }}</h1>
            </div>
        </div>

        <hr class="my-5">

        <div class="grid grid-cols-1 md:grid-cols-4 gap-5 mb-5">
            <div class="flex flex-col gap-2">
                <span class="font-sora font-semibold">Nama</span>
                <span>{{ $participant->user->name }}</span>
            </div>
            <div class="flex flex-col gap-2">
                <span class="font-sora font-semibold">Email</span>
                <span>{{ $participant->user->email }}</span>
            </div>
            <div class="flex flex-col gap-2">
                <span class="font-sora font-semibold">Phone</span>
                <span>{{ $participant->user->phone }}</span>
            </div>
            <div class="flex flex-col gap-2">
                <span class="font-sora font-semibold">Ujian</span>
                <span>{{ $exam->name }}</span>
            </div>
        </div>

        <div class="grid grid-cols-1 gap-5">
            <div>
                <form action="{{ route('hasil.store') }}" method="post" id="myResult">
                    @csrf
                    <input type="hidden" name="exam_participants_id" value="{{ $participant->id }}">
                    <input type="hidden" name="email" value="{{ $participant->user->email }}">
                    <div class="flex flex-col gap-3 mb-3">
                        <label for="score" class="font-sora font-semibold">Score</label>
                        <input type="number" name="score" placeholder="score" required value="{{ $result->score ?? '' }}"
                            class="px-4 py-2 border rounded-md outline outline-1 h-10 outline-primary">
                        @error('score')
                            <div>
                                <small class="text-red-500"><i>{{ $message }}</small>
                            </div>
                        @enderror
                    </div>
                    <div class="flex flex-col gap-3 mb-3 md:col-span-2">
                        <label for="description" class="font-sora font-semibold">Deskripsi</label>
                        <textarea name="description" id="description" class="block w-full mt-1 text-sm border-gray-300 border-2 p-2 rounded-md">{{ $result->description ?? '' }}</textarea>
                        @error('description')
                            <div>
                                <small class="text-red-500"><i>{{ $message }}</i></small>
                            </div>
                        @enderror
                    </div>
                    <div class="flex flex-col gap-3 mb-3 md:col-span-2">
                        <label for="status" class="font-sora font-semibold">Status</label>
                        @php
                            $currentStatus = $result->status ?? '';
                        @endphp

                        <select name="status" id="status"
                            class="border rounded-md outline outline-1 h-10 outline-primary">

                            {{-- Tampilkan status sekarang jika ada --}}
                            @if ($currentStatus)
                                <option value="{{ $currentStatus }}" selected>{{ $currentStatus }}</option>
                            @else
                                <option value="" selected>Pilih status</option>
                            @endif

                            {{-- Hanya tampilkan opsi yang berbeda dari yang sedang aktif --}}
                            @foreach (['Lulus', 'Gagal'] as $status)
                                @if ($status !== $currentStatus)
                                    <option value="{{ $status }}">{{ $status }}</option>
                                @endif
                            @endforeach

                        </select>
                        @error('status')
                            <div>
                                <small class="text-red-500"><i>{{ $message }}</small>
                            </div>
                        @enderror
                    </div>
                    <div class="flex items-center justify-end gap-3">
                        <button type="button" id="submitBtn"
                            class="py-3 px-5 text-center bg-primary text-white font-sora font-semibold rounded-lg">Simpan dan Generate NIM</button>
                    </div>
                </form>
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
                    document.getElementById('myResult').submit(); // Ganti dengan ID form kamu
                }
            });
        });
    </script>
@endsection
