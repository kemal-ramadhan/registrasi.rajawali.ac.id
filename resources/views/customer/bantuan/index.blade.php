@extends('customer.template.template', ['title' => 'Personal Data', 'menu' => 'profile'])

@section('content')
    <div class="relative left-1/2 right-1/2 -mx-[50vw] w-screen p-5 md:hidden grid grid-cols-1 gap-5 mb-12">

        {{-- Profile Section --}}
        <div class="border-b border-gray-200 bg-white p-3 rounded-lg">
            <div class="flex items-center gap-4">
                <div class="flex-1">
                    <h2 class="font-semibold text-lg">{{ auth()->user()->name }}</h2>
                    <p class="text-sm text-gray-500">{{ auth()->user()->name }}</p>
                </div>
                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </div>
        </div>

        {{-- Menu Items --}}
        <div class="bg-white p-3 rounded-lg">
            {{-- Akun Section --}}
            <div class="px-4 py-2">
                <h3 class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Akun</h3>
            </div>

            <a href="{{ route('personal.data.index') }}"
                class="flex items-center gap-4 px-4 py-4 hover:bg-gray-50 active:bg-gray-100">
                <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center">
                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </div>
                <div class="flex-1">
                    <h4 class="font-medium">Edit Profile</h4>
                    <p class="text-sm text-gray-500">Ubah foto, nama, dan bio</p>
                </div>
                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </a>

            {{-- Lainnya Section --}}
            <div class="px-4 py-2 mt-4">
                <h3 class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Lainnya</h3>
            </div>

            <a href="{{ route('jalur.pendaftaran') }}"
                class="flex items-center gap-4 px-4 py-4 hover:bg-gray-50 active:bg-gray-100">
                <div class="w-10 h-10 bg-gray-100 rounded-full flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-journals w-3"
                        viewBox="0 0 16 16">
                        <path
                            d="M5 0h8a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2 2 2 0 0 1-2 2H3a2 2 0 0 1-2-2h1a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1H1a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v9a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H5a1 1 0 0 0-1 1H3a2 2 0 0 1 2-2" />
                        <path
                            d="M1 6v-.5a.5.5 0 0 1 1 0V6h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1zm0 3v-.5a.5.5 0 0 1 1 0V9h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1zm0 2.5v.5H.5a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1H2v-.5a.5.5 0 0 0-1 0" />
                    </svg>
                </div>
                <div class="flex-1">
                    <h4 class="font-medium">Pendaftaran Saya</h4>
                    <p class="text-sm text-gray-500">List Pendaftaran Saya</p>
                </div>
                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </a>

            <a href="{{ route('test.index') }}"
                class="flex items-center gap-4 px-4 py-4 hover:bg-gray-50 active:bg-gray-100">
                <div class="w-10 h-10 bg-gray-100 rounded-full flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-clipboard2-pulse w-4"
                        viewBox="0 0 16 16">
                        <path
                            d="M9.5 0a.5.5 0 0 1 .5.5.5.5 0 0 0 .5.5.5.5 0 0 1 .5.5V2a.5.5 0 0 1-.5.5h-5A.5.5 0 0 1 5 2v-.5a.5.5 0 0 1 .5-.5.5.5 0 0 0 .5-.5.5.5 0 0 1 .5-.5z" />
                        <path
                            d="M3 2.5a.5.5 0 0 1 .5-.5H4a.5.5 0 0 0 0-1h-.5A1.5 1.5 0 0 0 2 2.5v12A1.5 1.5 0 0 0 3.5 16h9a1.5 1.5 0 0 0 1.5-1.5v-12A1.5 1.5 0 0 0 12.5 1H12a.5.5 0 0 0 0 1h.5a.5.5 0 0 1 .5.5v12a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5z" />
                        <path
                            d="M9.979 5.356a.5.5 0 0 0-.968.04L7.92 10.49l-.94-3.135a.5.5 0 0 0-.926-.08L4.69 10H4.5a.5.5 0 0 0 0 1H5a.5.5 0 0 0 .447-.276l.936-1.873 1.138 3.793a.5.5 0 0 0 .968-.04L9.58 7.51l.94 3.135A.5.5 0 0 0 11 11h.5a.5.5 0 0 0 0-1h-.128z" />
                    </svg>
                </div>
                <div class="flex-1">
                    <h4 class="font-medium">Seleksi Saya</h4>
                    <p class="text-sm text-gray-500">Daftar Seleksi Saya</p>
                </div>
                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </a>

            {{-- Pembayaran --}}
            <div class="px-4 py-2 mt-4">
                <h3 class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Pembayaran</h3>
            </div>

            <a href="{{ route('paymant.index') }}"
                class="flex items-center gap-4 px-4 py-4 hover:bg-gray-50 active:bg-gray-100">
                <div class="w-10 h-10 bg-gray-100 rounded-full flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-credit-card-2-front w-4"
                        viewBox="0 0 16 16">
                        <path
                            d="M14 3a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1zM2 2a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2z" />
                        <path
                            d="M2 5.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5zm0 3a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5m3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5m3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5m3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5" />
                    </svg>
                </div>
                <div class="flex-1">
                    <h4 class="font-medium">Daftar Ulang</h4>
                    <p class="text-sm text-gray-500">Daftar Ulang</p>
                </div>
                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </a>
        </div>

        {{-- Keluar --}}
        <div class="border-b border-gray-200 bg-white p-3 rounded-lg">
            <form id="logout-form" method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" id="logout-btn"
                    class="flex items-center justify-between w-full gap-4 px-4 py-4 hover:bg-gray-50 active:bg-gray-100">
                    <div class="w-10 h-10 bg-gray-100 rounded-full flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-box-arrow-left" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                d="M6 12.5a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v2a.5.5 0 0 1-1 0v-2A1.5 1.5 0 0 1 6.5 2h8A1.5 1.5 0 0 1 16 3.5v9a1.5 1.5 0 0 1-1.5 1.5h-8A1.5 1.5 0 0 1 5 12.5v-2a.5.5 0 0 1 1 0z" />
                            <path fill-rule="evenodd"
                                d="M.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L1.707 7.5H10.5a.5.5 0 0 1 0 1H1.707l2.147 2.146a.5.5 0 0 1-.708.708z" />
                        </svg>
                    </div>
                    <div class="flex-1">
                        <h4 class="font-medium">Keluar</h4>
                        <p class="text-sm text-gray-500">Keluar Dari Akun</p>
                    </div>
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </button>
            </form>
        </div>

    </div>

    {{-- dekstop preview --}}
    <div class="hidden md:grid grid-cols-1 gap-5">
        <div class="w-full bg-white md:flex items-center p-5 rounded-2xl outline outline-1 outline-gray-200">
            <div class="flex gap-2">
                <small class="font-sora flex gap-2">
                    <span>
                        <a href="{{ route('bantuan.customer') }}" class="font-bold">Bantuan</a>
                </small>
            </div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <div class="bg-white rounded-xl p-5 flex flex-col items-center justify-center gap-5 hover:shadow-lg">
                <img src="{{ asset('assets/icons/programer.svg') }}" alt="teknis" class="w-44">
                <div class="flex flex-col gap-3 items-start">
                    <h1 class="font-sora text-lg mx-auto">Bantuan Teknis</h1>
                    <span class="text-center">Pantau dan tangani laporan kendala teknis dari calon pendaftar, seperti error
                        sistem, halaman tidak tampil, atau masalah login. Pastikan respons cepat agar proses pendaftaran
                        berjalan lancar.</span>
                    <a href="https://wa.me/6285691422220?text=Halo%20tim%20teknis%2C%20ada%20permintaan%20bantuan%20yang%20perlu%20ditangani%20terkait%20kendala%20pada%20sistem.%20Mohon%20diperiksa.%20Terima%20kasih."
                        class="py-2 px-3 rounded-md bg-primary text-white mx-auto">Chat Teknisi</a>
                </div>
            </div>
            <div class="bg-white rounded-xl p-5 flex flex-col items-center justify-center gap-5 hover:shadow-lg">
                <img src="{{ asset('assets/icons/umum.svg') }}" alt="teknis" class="w-44">
                <div class="flex flex-col gap-3 items-start">
                    <h1 class="font-sora text-lg mx-auto">Bantuan Umum</h1>
                    <span class="text-center">Kelola pertanyaan umum seputar jadwal, alur pendaftaran, atau informasi
                        program
                        studi. Berikan informasi yang jelas dan tepat kepada calon mahasiswa.</span>
                    <a href="https://wa.me/6285691422220?text=Halo%20tim%20bantuan%20umum%2C%20terdapat%20pertanyaan%20yang%20perlu%20ditanggapi%20terkait%20informasi%20pendaftaran.%20Mohon%20diperiksa.%20Terima%20kasih."
                        class="py-2 px-3 rounded-md bg-primary text-white mx-auto">Chat Admin</a>
                </div>
            </div>
        </div>
        <div
            class="bg-white rounded-2xl p-6 shadow-md w-full max-w-sm mx-auto hover:shadow-xl transition-shadow duration-300 lg:hidden mb-20 md:mb-0">
            <form id="logout-form" method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="button" id="logout-btn"
                    class="flex items-center gap-4 w-full py-3 px-4 text-red-600 font-semibold text-sm rounded-lg border border-red-200 hover:bg-red-500 hover:text-white transition duration-300 ease-in-out">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                        class="w-5 h-5 transition-transform duration-300 group-hover:translate-x-1" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0z" />
                        <path fill-rule="evenodd"
                            d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708z" />
                    </svg>
                    <span>Keluar dari Akun</span>
                </button>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('logout-btn').addEventListener('click', function() {
            Swal.fire({
                title: "Konfirmasi Logout",
                text: "Apakah Anda yakin ingin keluar?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Ya, Keluar",
                cancelButtonText: "Batal"
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('logout-form').submit();
                }
            });
        });
    </script>
@endsection
