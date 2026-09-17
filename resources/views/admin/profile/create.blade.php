@extends('admin.template.template', ['title' => 'Tambah Admin'])

@section('content')

<div class="w-full">
    <form action="{{ route('admin.store') }}" method="post" class="mt-10" id="myForm">
        @csrf
        <div class="flex flex-col mb-3">
            <label for="name" class="font-sora font-semibold">Nama Lengkap</label>
            <small class="font-sora"><i>Full Name</i></small>
            <input type="text" name="name" placeholder="Full name" class="py-2 px-5 border border-gray-500 w-full inline rounded-full my-2 bg-white">
            @error('name')
            <div>
                <small class="text-red-500"><i>{{ $message }}</small>
            </div>
            @enderror
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-3 mb-3">
            <div class="flex flex-col">
                <label for="phone" class="font-sora font-semibold">Nomor Telepon / Whatsapp</label>
                <small class="font-sora"><i>Phone Number/WhatsApp</i></small>
                <input type="text" name="phone" placeholder="Phone Number/WhatsApp" class="py-2 px-5 border border-gray-500 w-full inline rounded-full my-2 bg-white">
                @error('phone')
                <div>
                    <small class="text-red-500"><i>{{ $message }}</small>
                </div>
                @enderror
            </div>
            <div class="flex flex-col">
                <label for="email" class="font-sora font-semibold">Alamat Email</label>
                <small class="font-sora"><i>Email Address</i></small>
                <input type="email" name="email" placeholder="Email Address" class="py-2 px-5 border border-gray-500 w-full inline rounded-full my-2 bg-white">
                @error('email')
                <div>
                    <small class="text-red-500"><i>{{ $message }}</small>
                </div>
                @enderror
            </div>
            <div class="flex flex-col">
                <label for="password" class="font-sora font-semibold">Password</label>
                <small class="font-sora"><i>Password</i></small>
                <input type="password" name="password" placeholder="Password" class="py-2 px-5 border border-gray-500 w-full inline rounded-full my-2 bg-white">
                @error('password')
                <div>
                    <small class="text-red-500"><i>{{ $message }}</small>
                </div>
                @enderror
            </div>
            <div class="flex flex-col">
                <label for="confpassword" class="font-sora font-semibold">Konfirmasi Password</label>
                <small class="font-sora"><i>Confirm Password</i></small>
                <input type="password" name="password_confirmation" placeholder="Confirm Password" class="py-2 px-5 border border-gray-500 w-full inline rounded-full my-2 bg-white">
                @error('password_confirmation')
            <div>
                <small class="text-red-500"><i>{{ $message }}</small>
            </div>
            @enderror
            </div>
        </div>
        <div class="flex flex-col mb-10 w-full md:w-1/4 mx-auto">
            <button id="submitBtn" class="py-3 w-full text-center bg-primary hover:bg-primary text-white font-sora font-semibold rounded-full flex justify-center items-center gap-2" type="button">
                <span id="btn-text">Daftarkan</span>
                <svg id="loading-spinner" class="hidden animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
                </svg>
            </button>  
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