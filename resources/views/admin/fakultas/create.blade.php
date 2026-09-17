@extends('admin.template.template', ['title' => 'Tambah Fakultas'])

@section('content')
    <div class="bg-white p-5 rounded-2xl flex flex-col gap-5">
        <form action="{{ route('fakultas.store') }}" method="post" id="myForm" enctype="multipart/form-data">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5 my-5">
                <div class="flex flex-col gap-3 mb-3">
                    <label for="code" class="font-sora font-semibold">Code Fakultas</label>
                    <input type="text" name="code" placeholder="Example : 2" required
                        class="px-4 py-2 border rounded-xl outline outline-1 h-10 outline-primary">
                    @error('code')
                        <div>
                            <small class="text-red-500"><i>{{ $message }}</small>
                        </div>
                    @enderror
                </div>
                <div class="flex flex-col gap-3 mb-3">
                    <label for="name" class="font-sora font-semibold">Nama Fakultas</label>
                    <input type="text" name="name" placeholder="Example : Fakultas Teknologi Informasi" required
                        class="px-4 py-2 border rounded-xl outline outline-1 h-10 outline-primary">
                    @error('name')
                        <div>
                            <small class="text-red-500"><i>{{ $message }}</small>
                        </div>
                    @enderror
                </div>
                <div class="flex flex-col gap-3 mb-3">
                    <label for="name" class="font-sora font-semibold">Program Level</label>
                    <select name="program_level_id" id="program_level_id"
                        class="border rounded-xl outline outline-1 h-10 outline-primary">
                        @foreach ($programLevels as $programLevel)
                            <option value="{{ $programLevel->id }}">{{ $programLevel->title }}</option>
                        @endforeach
                    </select>
                    @error('program_level_id')
                        <div>
                            <small class="text-red-500"><i>{{ $message }}</small>
                        </div>
                    @enderror
                </div>
                <div class="flex flex-col gap-3 mb-3">
                    <label for="name" class="font-sora font-semibold">Status</label>
                    <select name="status" id="status" class="border rounded-xl outline outline-1 h-10 outline-primary">
                        <option value="active" selected>active</option>
                        <option value="non-active">non active</option>
                    </select>
                    @error('status')
                        <div>
                            <small class="text-red-500"><i>{{ $message }}</small>
                        </div>
                    @enderror
                </div>
                <div class="flex flex-col gap-3 mb-3 col-span-2">
                    <label for="name" class="font-sora font-semibold">Deskripsi Fakultas</label>
                    <textarea name="description" id="description" cols="30" rows="10"
                        class="px-4 py-2 border rounded-xl outline outline-1 outline-primary"></textarea>
                    @error('description')
                        <div>
                            <small class="text-red-500"><i>{{ $message }}</small>
                        </div>
                    @enderror
                </div>
                <div class="flex flex-col gap-3 mb-3">
                    <label for="image" class="font-sora font-semibold">Image</label>
                    <input type="file" name="image" id="image-input" accept="image/*" required
                        class="px-4 py-2 border rounded-xl outline outline-1 h-10 outline-primary">

                    {{-- Pratinjau Gambar --}}
                    <img id="preview-image" src="#" alt="Preview"
                        class="hidden w-32 h-32 object-cover rounded-lg border mt-2">

                    @error('image')
                        <div>
                            <small class="text-red-500"><i>{{ $message }}</i></small>
                        </div>
                    @enderror
                </div>

                {{-- Script untuk Preview Gambar --}}
                <script>
                    document.getElementById('image-input').addEventListener('change', function(event) {
                        const file = event.target.files[0];
                        if (file) {
                            const reader = new FileReader();
                            reader.onload = function(e) {
                                const previewImage = document.getElementById('preview-image');
                                previewImage.src = e.target.result;
                                previewImage.classList.remove('hidden');
                            }
                            reader.readAsDataURL(file);
                        }
                    });
                </script>

            </div>
            <div class="flex items-center justify-end gap-3">
                <button type="button" id="submitBtn"
                    class="py-3 px-5 text-center bg-primary text-white font-sora font-semibold rounded-lg">Simpan</button>
            </div>
        </form>
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
