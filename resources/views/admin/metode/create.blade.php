@extends('admin.template.template', ['title' => 'Tambah Metode Pmbayarab'])

@section('content')
<div class="bg-white p-5 rounded-2xl flex flex-col gap-5">
    <div class="flex items-center justify-between">
        <h1 class="font-sora font-bold text-lg my-5">Tambah Metode Pembayaran</h1>
        <div x-data="{ open: false }">
            <!-- Tombol untuk membuka modal -->
            <button @click="open = true" class="p-3 bg-primary rounded-xl flex gap-2 items-center w-fit hover:bg-gray-900 text-white">
                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-folder-plus w-3" viewBox="0 0 16 16">
                    <path d="m.5 3 .04.87a2 2 0 0 0-.342 1.311l.637 7A2 2 0 0 0 2.826 14H9v-1H2.826a1 1 0 0 1-.995-.91l-.637-7A1 1 0 0 1 2.19 4h11.62a1 1 0 0 1 .996 1.09L14.54 8h1.005l.256-2.819A2 2 0 0 0 13.81 3H9.828a2 2 0 0 1-1.414-.586l-.828-.828A2 2 0 0 0 6.172 1H2.5a2 2 0 0 0-2 2m5.672-1a1 1 0 0 1 .707.293L7.586 3H2.19q-.362.002-.683.12L1.5 2.98a1 1 0 0 1 1-.98z"/>
                    <path d="M13.5 9a.5.5 0 0 1 .5.5V11h1.5a.5.5 0 1 1 0 1H14v1.5a.5.5 0 1 1-1 0V12h-1.5a.5.5 0 0 1 0-1H13V9.5a.5.5 0 0 1 .5-.5"/>
                  </svg>
                  <span class="hidden md:flex">Tambah Kategori Pembayaran</span>
            </button>
        
            <!-- Modal -->
            <div x-show="open" class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50" id="modal">
                <div class="bg-white p-6 rounded-lg shadow-lg w-96">
                    <h2 class="text-xl font-bold mb-4">Tambah Kategori Pembayaran</h2>
        
                    <!-- Form -->
                    <form action="{{ route('metode.storeKategori') }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label class="block text-gray-700 mb-3">Program Studi</label>
                            <input type="text" class="outline outline-1 outline-primary p-3 rounded-xl w-full" name="kategori">
                        </div>
        
                        <div class="flex justify-end">
                            <button type="button" @click="open = false" class="mr-2 px-4 py-2 bg-gray-400 text-white rounded-lg">
                                Batal
                            </button>
                            <button type="submit" class="px-4 py-2 bg-primary text-white rounded-lg">
                                Tambahkan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div> 
    </div>
    
    <form action="{{ route('metode.store') }}" method="post" id="myForm" enctype="multipart/form-data">
        @csrf
    <div class="grid grid-cols-1 md:grid-cols-3 gap-5 my-5">
        <div class="flex flex-col gap-3 mb-3">
            <label for="name" class="font-sora font-semibold">Kategori</label>
            <select name="paymant_method_kategori_id" id="paymant_method_kategori_id" class="border rounded-xl outline outline-1 h-10 outline-primary">
                @foreach ($kategoris as $kategori)
                <option value="{{ $kategori->id }}">{{ $kategori->name }}</option>
                @endforeach
            </select>
            @error('paymant_method_kategori_id')
                <div>
                    <small class="text-red-500"><i>{{ $message }}</small>
                </div>
            @enderror
        </div>
        <div class="flex flex-col gap-3 mb-3">
            <label for="methode" class="font-sora font-semibold">Metode</label>
            <input type="text" name="methode" placeholder="Example : Bank BCA" required class="px-4 py-2 border rounded-xl outline outline-1 h-10 outline-primary">
            @error('methode')
                <div>
                    <small class="text-red-500"><i>{{ $message }}</small>
                </div>
            @enderror
        </div>
        <div class="flex flex-col gap-3 mb-3">
            <label for="methode_initial" class="font-sora font-semibold">Initial Metode / Kode Metode</label>
            <input type="text" name="methode_initial" placeholder="Example : Bank BCA" required class="px-4 py-2 border rounded-xl outline outline-1 h-10 outline-primary">
            @error('methode_initial')
                <div>
                    <small class="text-red-500"><i>{{ $message }}</small>
                </div>
            @enderror
        </div>
        <div class="flex flex-col gap-3 mb-3">
            <label for="biaya_admin" class="font-sora font-semibold">Biaya Admin</label>
            <input type="text" name="biaya_admin" placeholder="Example : Bank BCA" required class="px-4 py-2 border rounded-xl outline outline-1 h-10 outline-primary">
            @error('biaya_admin')
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
        <div class="flex flex-col gap-3 mb-3">
            <label for="image" class="font-sora font-semibold">Image</label>
            <input type="file" name="image" id="image-input" accept="image/*" required class="px-4 py-2 border rounded-xl outline outline-1 h-10 outline-primary">
            
            {{-- Pratinjau Gambar --}}
            <img id="preview-image" src="#" alt="Preview" class="hidden w-32 object-cover rounded-lg border mt-2">
            
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
        <button type="button" id="submitBtn" class="py-3 px-5 text-center bg-primary text-white font-sora font-semibold rounded-lg">Simpan</button>
    </div>
    </form>
</div>


<script>
    document.getElementById('submitBtn').addEventListener('click', function (e) {
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