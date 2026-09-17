<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="shortcut icon" href="{{ asset('assets/icons/bth.png') }}" type="image/x-icon">
    <title>403 Akses Tidak Diizinkan</title>
</head>
<body class="text-xs">
    <div class="font-sora flex flex-col items-center justify-center h-screen p-5 gap-5">
        <div class="flex items-center gap-3">
            <img src="{{ asset('assets/icons/bth-logo.svg') }}" alt="ubth" style="width: 50px">
            <div class="flex flex-col">
                <h1 class="text-lg font-sora font-bold drop-shadow-[0_2px_2px_rgba(255,255,255,0.7)]">Universitas Bakti Tunas Husada</h1>
                <small class="font-sora font-semibold drop-shadow-[0_1px_1px_rgba(255,255,255,0.7)]"><i>Transforming New Generation</i></small>
            </div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5 w-3/4">
            <div class="flex flex-col gap-5 items-start justify-center text-center">
                <h1 class="font-sora text-5xl font-bold">Ups!</h1>
                <h1 class="font-sora text-9xl font-bold text-primary">419</h1>
                <h1 class="font-sora text-3xl font-bold">Maaf Sesi anda telah kadaluarsa.</h1>
                <span>Muat ulang halaman dan coba lagi untuk mendapatkan formulir baru.</span>
                <a href="javascript:history.back()" class="flex gap-1 py-2 px-3 outline outline-1 outline-primary rounded-full text-primary hover:bg-primary hover:text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-arrow-left w-4" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8"/>
                      </svg>
                      Kembali
                </a>
            </div>
            <div>
                <img src="{{ asset('assets/icons/419.svg') }}" alt="419">
            </div>
        </div>
    </div>
</body>
</html>