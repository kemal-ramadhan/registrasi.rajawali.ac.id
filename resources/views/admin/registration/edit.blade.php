@extends('admin.template.template', ['title' => 'Edit Jalur Pendaftaran'])

@section('content')
    <div class="bg-white p-5 rounded-2xl flex flex-col gap-5">
        <form action="{{ route('registration.update', $registrationPath->id) }}" method="post" id="myForm"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-1 md:grid-cols-3 gap-5 my-5">
                <div class="flex flex-col gap-3 mb-3">
                    <label for="code" class="font-sora font-semibold">Jenis Pendaftaran</label>

                    <select name="code" required
                        class="px-4 py-2 border rounded-xl outline outline-1 h-10 outline-primary bg-white">
                        <option value="1" {{ $registrationPath->code == 1 ? 'selected' : '' }}>Mahasiswa Baru</option>
                        <option value="2" {{ $registrationPath->code == 2 ? 'selected' : '' }}>Mahasiswa RPL</option>
                    </select>

                    @error('code')
                        <div>
                            <small class="text-red-500"><i>{{ $message }}</i></small>
                        </div>
                    @enderror
                </div>

                <div class="flex flex-col gap-3 mb-3">
                    <label for="code_year" class="font-sora font-semibold">Tahun Ajaran / Tahun Masuk</label>
                    <input type="text" name="code_year" placeholder="Example : 2024/2025" required
                        class="px-4 py-2 border rounded-xl outline outline-1 h-10 outline-primary"
                        value="{{ $registrationPath->code_year }}">
                    @error('code_year')
                        <div>
                            <small class="text-red-500"><i>{{ $message }}</small>
                        </div>
                    @enderror
                </div>
                <div class="flex flex-col gap-3 mb-3">
                    <label for="name" class="font-sora font-semibold">Gelombang</label>
                    <input type="text" name="name" placeholder="Example : Gelombang 1" required
                        class="px-4 py-2 border rounded-xl outline outline-1 h-10 outline-primary"
                        value="{{ $registrationPath->name }}">
                    @error('name')
                        <div>
                            <small class="text-red-500"><i>{{ $message }}</small>
                        </div>
                    @enderror
                </div>
                <div class="flex flex-col gap-3 mb-3 md:col-span-2">
                    <label for="name" class="font-sora font-semibold">Nama Jalur</label>
                    <input type="text" name="title" placeholder="Example : PMDK" required
                        class="px-4 py-2 border rounded-xl outline outline-1 h-10 outline-primary"
                        value="{{ $registrationPath->title }}">
                    @error('title')
                        <div>
                            <small class="text-red-500"><i>{{ $message }}</small>
                        </div>
                    @enderror
                </div>
                <div class="flex flex-col gap-3 mb-3">
                    <label for="name" class="font-sora font-semibold">Status</label>
                    <select name="status" id="status" class="border rounded-xl outline outline-1 h-10 outline-primary">
                        <option value="{{ $registrationPath->status }}" selected>{{ $registrationPath->status }}</option>
                        <option value="open">open</option>
                        <option value="close">close</option>
                    </select>
                    @error('status')
                        <div>
                            <small class="text-red-500"><i>{{ $message }}</small>
                        </div>
                    @enderror
                </div>
                <div class="flex flex-col gap-3 mb-3">
                    <label for="name" class="font-sora font-semibold">Priode Awal</label>
                    <input type="date" name="start_date" required
                        class="px-4 py-2 border rounded-xl outline outline-1 h-10 outline-primary"
                        value="{{ $registrationPath->start_date }}">
                    @error('start_date')
                        <div>
                            <small class="text-red-500"><i>{{ $message }}</small>
                        </div>
                    @enderror
                </div>
                <div class="flex flex-col gap-3 mb-3">
                    <label for="name" class="font-sora font-semibold">Priode Akhir</label>
                    <input type="date" name="end_date" required
                        class="px-4 py-2 border rounded-xl outline outline-1 h-10 outline-primary"
                        value="{{ $registrationPath->end_date }}">
                    @error('end_date')
                        <div>
                            <small class="text-red-500"><i>{{ $message }}</small>
                        </div>
                    @enderror
                </div>
                <div class="flex flex-col gap-3 mb-3">
                    <label for="name" class="font-sora font-semibold">Biaya Pendaftaran</label>
                    <input type="text" name="amount" placeholder="300000" required
                        class="px-4 py-2 border rounded-xl outline outline-1 h-10 outline-primary"
                        value="{{ $registrationPath->amount }}">
                    @error('amount')
                        <div>
                            <small class="text-red-500"><i>{{ $message }}</small>
                        </div>
                    @enderror
                </div>
                <div class="flex flex-col gap-3 mb-3">
                    <label for="name" class="font-sora font-semibold">Link Grup Whastapp / Telegram</label>
                    <input type="text" name="link_grup" placeholder="Link Grup WhatsApp / Telegram" required
                        class="px-4 py-2 border rounded-xl outline outline-1 h-10 outline-primary"
                        value="{{ $registrationPath->link_grup }}">
                    @error('link_grup')
                        <div>
                            <small class="text-red-500"><i>{{ $message }}</small>
                        </div>
                    @enderror
                </div>
                <div class="flex flex-col gap-3 mb-3 col-span-1 md:col-span-3">
                    <label for="name" class="font-sora font-semibold">Deskripsi</label>
                    <textarea name="description" id="editor" cols="30" rows="10"
                        class="p-5 border rounded-3xl outline outline-1 outline-primary">{{ $registrationPath->description }}</textarea>
                    @error('description')
                        <div>
                            <small class="text-red-500"><i>{{ $message }}</small>
                        </div>
                    @enderror
                </div>
                <div class="flex flex-col gap-3 mb-3">
                    <label for="image" class="font-sora font-semibold">Image</label>

                    <input type="file" name="image" id="image-input" accept="image/*"
                        class="px-4 py-2 border rounded-xl outline outline-1 h-10 outline-primary">

                    {{-- Pratinjau Gambar --}}
                    <img id="preview-image"
                        src="{{ isset($registrationPath->image) ? asset('storage/' . $registrationPath->image) : '#' }}"
                        alt="Preview"
                        class="w-32 h-32 object-cover rounded-lg border mt-2 {{ isset($registrationPath->image) ? '' : 'hidden' }}">

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
