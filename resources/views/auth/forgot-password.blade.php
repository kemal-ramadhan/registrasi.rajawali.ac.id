@extends('auth.template', ['title' => 'Lupas Password', 'headline' => 'Lupa Password', 'subheadline' => 'Jangan Khawatir, kita akan mengirim link reset password.'])

@section('content')
    <div class="w-full">
        @if (session('status'))
            <div class="bg-green-400 p-3 rounded-lg bg-opacity-40 mb-10" role="alert">
                {{ session('status') }}
            </div>
        @endif
        <form action="{{ route('password.email') }}" method="post" class="mt-10">
            @csrf
            <div class="flex flex-col mb-3">
                <label for="name" class="font-sora font-semibold">Alamat Email</label>
                <small class="font-sora"><i>Email Address</i></small>
                <input type="text" name="email" placeholder="Masukan Alamat Email" required
                    class="py-4 md:py-3 px-5 border border-gray-500 w-full inline rounded-md my-2 bg-transparent @error('email') is-invalid @enderror"
                    value="{{ old('email') }}" required autocomplete="email" autofocus>
                @error('email')
                    <div>
                        <small class="text-red-500"><i>{{ $message }}</small>
                    </div>
                @enderror
            </div>
            <div class="flex flex-col mb-10">
                <button id="submit-btn"
                    class="py-4 md:py-3 w-full text-center bg-primary hover:bg-primary-hover text-white font-sora font-semibold rounded-md flex justify-center items-center gap-2"
                    type="submit">
                    <span id="btn-text">Reset Password</span>
                    <svg id="loading-spinner" class="hidden animate-spin h-5 w-5 text-white"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                            stroke-width="4"></circle>
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
        document.addEventListener("DOMContentLoaded", function() {
            const form = document.querySelector("form");
            const submitBtn = document.getElementById("submit-btn");
            const btnText = document.getElementById("btn-text");
            const loadingSpinner = document.getElementById("loading-spinner");

            form.addEventListener("submit", function() {
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
