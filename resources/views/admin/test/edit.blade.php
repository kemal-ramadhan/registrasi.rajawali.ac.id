@extends('admin.template.template', ['title' => 'Edit Registration Test'])

@section('content')

<form action="{{ route('registration-test.update', $registrationTest->id) }}" method="post" id="myForm" enctype="multipart/form-data">
    @csrf
    @method('PUT') <!-- Menambahkan method PUT untuk form edit -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-5 my-5">
    <div class="flex flex-col gap-3 mb-3">
        <label for="registration_path_id" class="font-sora font-semibold">Jalur Pendaftaran</label>
        <select name="registration_path_id" id="registration_path_id" class="border rounded-xl outline outline-1 h-10 outline-primary">
            @foreach ($registrations as $registration)
            <option value="{{ $registration->id }}" {{ $registration->id == $registrationTest->registration_path_id ? 'selected' : '' }}>
                {{ $registration->name }} - {{ $registration->title }}
            </option>
            @endforeach
        </select>
        @error('registration_path_id')
            <div>
                <small class="text-red-500"><i>{{ $message }}</i></small>
            </div>
        @enderror
    </div>
    <div class="flex flex-col gap-3 mb-3">
        <label for="name" class="font-sora font-semibold">Nama Test</label>
        <input type="text" name="name" placeholder="Example : Test Komputer" value="{{ old('name', $registrationTest->name) }}" required class="px-4 py-2 border rounded-xl outline outline-1 h-10 outline-primary">
        @error('name')
            <div>
                <small class="text-red-500"><i>{{ $message }}</i></small>
            </div>
        @enderror
    </div>
    <div class="flex flex-col gap-3 mb-3">
        <label for="status" class="font-sora font-semibold">Status</label>
        <select name="status" id="status" class="border rounded-xl outline outline-1 h-10 outline-primary">
            <option value="active" {{ $registrationTest->status == 'active' ? 'selected' : '' }}>Active</option>
            <option value="non-active" {{ $registrationTest->status == 'non-active' ? 'selected' : '' }}>Non-active</option>
        </select>
        @error('status')
            <div>
                <small class="text-red-500"><i>{{ $message }}</i></small>
            </div>
        @enderror
    </div>
    <div class="flex flex-col gap-3 mb-3">
        <label for="start_date" class="font-sora font-semibold">Tanggal Mulai</label>
        <input type="datetime-local" name="start_date" value="{{ old('start_date', $registrationTest->start_date) }}" required class="px-4 py-2 border rounded-xl outline outline-1 h-10 outline-primary">
        @error('start_date')
            <div>
                <small class="text-red-500"><i>{{ $message }}</i></small>
            </div>
        @enderror
    </div>
    <div class="flex flex-col gap-3 mb-3">
        <label for="end_date" class="font-sora font-semibold">Tanggal Akhir</label>
        <input type="datetime-local" name="end_date" value="{{ old('end_date', $registrationTest->end_date) }}" required class="px-4 py-2 border rounded-xl outline outline-1 h-10 outline-primary">
        @error('end_date')
            <div>
                <small class="text-red-500"><i>{{ $message }}</i></small>
            </div>
        @enderror
    </div>
    <div class="flex flex-col gap-3 mb-3">
        <label for="link_grup" class="font-sora font-semibold">Link Grup Informasi</label>
        <input type="text" name="link_grup" value="{{ old('link_grup', $registrationTest->link_grup) }}" class="px-4 py-2 border rounded-xl outline outline-1 h-10 outline-primary">
        @error('link_grup')
            <div>
                <small class="text-red-500"><i>{{ $message }}</i></small>
            </div>
        @enderror
    </div>
    <div class="flex flex-col gap-3 mb-3 col-span-2">
        <label for="description" class="font-sora font-semibold">Deskripsi Fakultas</label>
        <textarea name="description" id="description" cols="30" rows="10" class="px-4 py-2 border rounded-xl outline outline-1 outline-primary">{{ old('description', $registrationTest->description) }}</textarea>
        @error('description')
            <div>
                <small class="text-red-500"><i>{{ $message }}</i></small>
            </div>
        @enderror
    </div>
    <div class="flex flex-col gap-3 mb-3">
        <label for="image" class="font-sora font-semibold">Image</label>
        <input type="file" name="image" id="image-input" accept="image/*" class="px-4 py-2 border rounded-xl outline outline-1 h-10 outline-primary">
        
        {{-- Pratinjau Gambar --}}
        <img id="preview-image" src="{{ $registrationTest->image ? asset('storage/' . $registrationTest->image) : '#' }}" alt="Preview" class="w-32 h-32 object-cover rounded-lg border mt-2 {{ $registrationTest->image ? '' : 'hidden' }}">
        
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
    <button type="submit" class="py-3 px-5 text-center bg-primary text-white font-sora font-semibold rounded-lg">Simpan</button>
</div>
</form>

@endsection