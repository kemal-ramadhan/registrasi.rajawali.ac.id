@extends('auth.template', ['title' => 'Registration', 'headline' => 'Yuk, Jadi bagian dari Universitas Bakti Tunas Husada!', 'subheadline' => 'Daftarkan dirimu sekarang dan mulai perjalanan serumu sebagai mahasiswa Universitas-BTH!'])

@section('content')
<div class="w-full">
    <form action="{{ route('register') }}" method="post" class="mt-10">
        @csrf
        <div class="flex flex-col mb-3">
            <label for="name" class="font-sora font-semibold">Nama Lengkap</label>
            <input type="text" name="name" placeholder="Full name" class="py-4 md:py-3 px-5 border border-gray-500 w-full inline rounded-md my-2 bg-transparent">
            @error('name')
            <div>
                <small class="text-red-500"><i>{{ $message }}</small>
            </div>
            @enderror
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-3 mb-3">
            <div class="flex flex-col">
                <label for="phone" class="font-sora font-semibold">Nomor Telepon / Whatsapp</label>
                <input type="text" name="phone" placeholder="Phone Number/WhatsApp" class="py-4 md:py-3 px-5 border border-gray-500 w-full inline rounded-md my-2 bg-transparent">
                @error('phone')
                <small class="text-red-500"><i>{{ $message }}</i></small>
                @enderror
            </div>
            <div class="flex flex-col">
                <label for="email" class="font-sora font-semibold">Alamat Email</label>
                <input type="email" name="email" placeholder="Email Address" class="py-4 md:py-3 px-5 border border-gray-500 w-full inline rounded-md my-2 bg-transparent">
                @error('email')
                <small class="text-red-500"><i>{{ $message }}</i></small>
                @enderror
            </div>
            <div class="flex flex-col mb-3 relative">
                <label for="password" class="font-sora font-semibold">Password</label>
                <div class="relative">
                    <input id="password" type="password" name="password" placeholder="Password" required
                        class="py-4 md:py-3 px-5 border border-gray-500 w-full inline rounded-md my-2 bg-transparent pr-12">
            
                    <button type="button" onclick="togglePassword()" class="absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-600" id="togglePasswordBtn">
                        <!-- Eye open (default) -->
                        <svg id="eyeOpen" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
            
                        <!-- Eye closed (hidden by default) -->
                        <svg id="eyeClosed" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 hidden" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.269-2.943-9.543-7a9.956 9.956 0 012.164-3.356m3.304-2.382A9.956 9.956 0 0112 5c4.478 0 8.269 2.943 9.543 7a9.966 9.966 0 01-4.293 5.318M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 3l18 18" />
                        </svg>
                    </button>
                </div>
                @error('password')
                    <div>
                        <small class="text-red-500"><i>{{ $message }}</i></small>
                    </div>
                @enderror
            </div>
            <div class="flex flex-col">
                <label for="confpassword" class="font-sora font-semibold">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" placeholder="Confirm Password" class="py-4 md:py-3 px-5 border border-gray-500 w-full inline rounded-md my-2 bg-transparent">
                @error('password_confirmation')
                <small class="text-red-500"><i>{{ $message }}</i></small>
                @enderror
            </div>
        </div>
        <div class="flex flex-col mb-10">
            <button id="submit-btn" class="py-4 md:py-3 w-full text-center bg-primary hover:bg-primary-hover text-white font-sora font-semibold rounded-md flex justify-center items-center gap-2" type="submit">
                <span id="btn-text">DAFTAR SEKARANG / REGISTER NOW</span>
                <svg id="loading-spinner" class="hidden animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
                </svg>
            </button>  
        </div>
        <div class="flex items-center my-6">
            <div class="flex-grow border-t border-gray-400"></div>
                <span class="mx-4 font-sora"><i>Sudah memiliki akun!</i></span>
            <div class="flex-grow border-t border-gray-400"></div>
        </div>
        <div class="flex flex-col mb-3 text-center">
            <a class="py-4 md:py-3 w-full text-center outline outline-1 outline-primary hover:bg-primary text-primary hover:text-white font-sora font-semibold rounded-md flex justify-center items-center gap-2" href="{{ route('login') }}">
                <span id="btn-text">Login Disini</span>
            </a>
        </div>
    </form>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const form = document.querySelector("form");
        const submitBtn = document.getElementById("submit-btn");
        const btnText = document.getElementById("btn-text");
        const loadingSpinner = document.getElementById("loading-spinner");

        form.addEventListener("submit", function () {
            submitBtn.disabled = true; // Nonaktifkan tombol
            btnText.textContent = "Loading..."; // Ubah teks tombol
            loadingSpinner.classList.remove("hidden"); // Tampilkan spinner
        });
    });
</script>
<script>
    function togglePassword() {
        const passwordInput = document.getElementById("password");
        const eyeOpen = document.getElementById("eyeOpen");
        const eyeClosed = document.getElementById("eyeClosed");

        if (passwordInput.type === "password") {
            passwordInput.type = "text";
            eyeOpen.classList.add("hidden");
            eyeClosed.classList.remove("hidden");
        } else {
            passwordInput.type = "password";
            eyeOpen.classList.remove("hidden");
            eyeClosed.classList.add("hidden");
        }
    }
</script>
@endsection