@extends('auth.template', ['title' => 'Reset Password', 'headline' => 'Silahkan Konfirmasi dan reset password baru kamu', 'subheadline' => 'Please confirm and reset your new password.'])

@section('content')
<div class="w-full">
    @if (session('status'))
        <div class="bg-green-400 p-3 rounded-lg bg-opacity-40 mb-10" role="alert">
            {{ session('status') }}
        </div>
    @endif
    <form action="{{ route('password.update') }}" method="post" class="mt-10">
        @csrf

        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <div class="flex flex-col mb-3">
            <label for="name" class="font-sora font-semibold">Alamat Email</label>
            <small class="font-sora"><i>Email Address</i></small>
            <input type="text" name="email" required class="py-4 md:py-3 px-5 border border-gray-500 w-full inline rounded-md my-2 bg-transparent @error('email') is-invalid @enderror" name="email" value="{{ $request->email ?? old('email') }}" required autocomplete="email" autofocus placeholder="Masukkan Alamat Elamil">
            @error('email')
                <div>
                    <small class="text-red-500"><i>{{ $message }}</small>
                </div>
            @enderror
        </div>
        <div class="flex flex-col mb-3 relative">
            <label for="password" class="font-sora font-semibold">Password</label>
            <small class="font-sora"><i>Password</i></small>
            <div class="relative">
                <input id="password" type="password" name="password" required
                    class="py-4 md:py-3 px-5 border border-gray-500 w-full inline rounded-md my-2 bg-transparent pr-12 @error('password') is-invalid @enderror" autocomplete="new-password" placeholder="Masukkan Password Baru">
        
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
        <div class="flex flex-col mb-3">
            <label for="confpassword" class="font-sora font-semibold">Konfirmasi Password</label>
            <small class="font-sora"><i>Confirm Password</i></small>
            <input type="password" id="password-confirm" name="password_confirmation" placeholder="Confirm Password" class="py-4 md:py-3 px-5 border border-gray-500 w-full inline rounded-md my-2 bg-transparent" autocomplete="new-password">
            @error('password_confirmation')
            <small class="text-red-500"><i>{{ $message }}</i></small>
            @enderror
        </div>
        <div class="flex flex-col mb-3">
            <button id="submit-btn" class="py-3 w-full text-center bg-primary hover:bg-primary-hover text-white font-sora font-semibold rounded-md flex justify-center items-center gap-2" type="submit">
                <span id="btn-text">Reset Password</span>
                <svg id="loading-spinner" class="hidden animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
                </svg>
            </button>            
        </div>
        <div class="flex flex-col mb-3 justify-center items-center">
            <h1 class="font-sora font-semibold flex gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-arrow-left w-4"
                    viewBox="0 0 16 16">
                    <path fill-rule="evenodd"
                        d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8" />
                </svg>
                <a href="{{ route('login') }}">Kembali Ke Login</a>
            </h1>
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