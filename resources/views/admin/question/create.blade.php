@extends('admin.template.template', ['title' => 'Tambah Soal Baru'])

@section('content')

<form action="{{ route('question.store') }}" method="post" id="myForm">
    @csrf
    <input type="hidden" name="exams_id" value="{{ $exam->id }}">
    <div class="bg-white p-5 rounded-2xl w-full">
        <div class="flex flex-col gap-3 mb-3">
            <label for="point" class="font-sora font-semibold">Point</label>
            <input type="number" name="point" placeholder="Point" required
                class="px-4 py-2 border rounded-md outline outline-1 h-10 outline-primary">
            @error('point')
                <div>
                    <small class="text-red-500"><i>{{ $message }}</small>
                </div>
            @enderror
        </div>
        <div class="flex flex-col gap-3 mb-3 md:col-span-2">
            <label for="question" class="font-sora font-semibold">Pertanyaan</label>
            <textarea name="question" id="description" class="block w-full mt-1 text-sm border-gray-300 border-2 p-2 rounded-md"></textarea>
                @error('question')
                    <div>
                        <small class="text-red-500"><i>{{ $message }}</i></small>
                    </div>
                @enderror
        </div>
        <div class="flex flex-col gap-3 mb-3 md:col-span-2">
            <label for="type" class="font-sora font-semibold">Type Soal</label>
            <select name="type" id="type" class="border rounded-md outline outline-1 h-10 outline-primary">
                <option value="pilihan_ganda" selected>Pilihan Ganda</option>
                <option value="jawaban_singkat">Jawaban Singkat</option>
                <option value="esai">Esai</option>
            </select>
            @error('type')
                <div>
                    <small class="text-red-500"><i>{{ $message }}</small>
                </div>
            @enderror
        </div>
        <div class="flex items-center justify-between">
            <a href="{{ route('exam.show', $exam->id) }}" class="py-3 px-5 text-center bg-gray-200 text-primary font-sora font-semibold rounded-lg">Kembali</a>
            <button type="button" id="submitBtn" class="py-3 px-5 text-center bg-primary text-white font-sora font-semibold rounded-lg">Simpan</button>
        </div>
    </div>
</form>

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