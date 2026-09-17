@extends('customer.template.template', ['title' => 'Menu Utama', 'menu' => 'seleksi'])

@section('content')
    <div class="w-full">
        <div class="w-full bg-white hidden md:flex items-center p-5 rounded-2xl outline outline-1 outline-gray-200 mb-5">
            <div class="">
                <div class="flex gap-2">
                    <small class="font-sora flex gap-2">
                        <span>
                            <a href="{{ route('jalur.pendaftaran') }}" class="font-bold">Jalur Pendaftaran</a>
                        </span>
                    </small>
                </div>
            </div>
        </div>
        <div class="md:col-span-6 p-5 bg-white outline outline-1 outline-gray-200 rounded-3xl">
            <h1 class="font-sora font-semibold">Informasi Seleksi</h1>
            <hr class="my-3">
            <div class="flex flex-col gap-5">
                @forelse ($programOptions as $programOption)
                    <div
                        class="border border-gray-200 p-5 rounded-2xl shadow-sm bg-white hover:shadow-md transition duration-200 ease-in-out w-full space-y-3">
                        <div class="flex flex-col gap-2">
                            <h1 class="font-sora font-semibold text-gray-800 text-lg">Informasi Seleksi</h1>
                            <span>Perhatian Bagi Calon Mahasiswa Baru Universitas Bakti Tunas Husada! Group WA Wajib Diikuti, semua informasi penting
                                disalurkan melalui grup.</span>
                        </div>

                        <hr class="my-3">
                        <h1 class="font-sora font-semibold text-gray-800">Program Pilihan :
                            {{ $programOption->departement_name }}</h1>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                            <div class="flex items-center gap-3 bg-opacity-10 bg-primary shadow-sm p-2 rounded-md">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                    class="bi bi-exclamation-circle w-3 h-3" viewBox="0 0 16 16">
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16" />
                                    <path
                                        d="M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0M7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0z" />
                                </svg>
                                <span class="font-sora text-xs">{{ $programOption->registration_name }} -
                                    {{ $programOption->title }}</span>
                            </div>

                            <div class="flex items-center gap-3 bg-opacity-10 bg-primary shadow-sm p-2 rounded-md">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                    class="bi bi-calendar-week w-3 h-3" viewBox="0 0 16 16">
                                    <path
                                        d="M11 6.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm-3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm-5 3a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5z" />
                                    <path
                                        d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5M1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4z" />
                                </svg>
                                @php
                                    $start = date('d F Y', strtotime($programOption->start_date));
                                    $end = date('d F Y', strtotime($programOption->end_date));
                                @endphp

                                <span class="font-sora text-xs">{{ $start }} s.d {{ $end }}</span>
                            </div>

                            <div class="flex items-center gap-3 bg-opacity-10 bg-primary shadow-sm p-2 rounded-md">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                    class="bi bi-hourglass-split w-3 h-3" viewBox="0 0 16 16">
                                    <path
                                        d="M2.5 15a.5.5 0 1 1 0-1h1v-1a4.5 4.5 0 0 1 2.557-4.06c.29-.139.443-.377.443-.59v-.7c0-.213-.154-.451-.443-.59A4.5 4.5 0 0 1 3.5 3V2h-1a.5.5 0 0 1 0-1h11a.5.5 0 0 1 0 1h-1v1a4.5 4.5 0 0 1-2.557 4.06c-.29.139-.443.377-.443.59v.7c0 .213.154.451.443.59A4.5 4.5 0 0 1 12.5 13v1h1a.5.5 0 0 1 0 1zm2-13v1c0 .537.12 1.045.337 1.5h6.326c.216-.455.337-.963.337-1.5V2zm3 6.35c0 .701-.478 1.236-1.011 1.492A3.5 3.5 0 0 0 4.5 13s.866-1.299 3-1.48zm1 0v3.17c2.134.181 3 1.48 3 1.48a3.5 3.5 0 0 0-1.989-3.158C8.978 9.586 8.5 9.052 8.5 8.351z" />
                                </svg>
                                <span class="font-sora text-xs">
                                    Status Pendaftaran:
                                    <span
                                        class="inline-block px-2 py-0.5 rounded-md text-xs font-semibold 
                                    {{ $programOption->status === 'Aktif' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                        {{ $programOption->status }}
                                    </span>
                                </span>
                            </div>
                        </div>
                        <hr class="my-3">
                        <div class="grid grid-cols-2 md:grid-cols-5 gap-5">
                            @if ($programOption->status == 'Proses Seleksi' || $programOption->status == 'Lulus' || $programOption->status == 'Verifikasi Dokumen' || $programOption->status == 'Revisi Dokumen')
                            <a href="{{ $programOption->link_grup }}" target="_blank"
                                class="bg-primary text-white py-2 px-3 rounded-md text-center">Gabung Grup</a>
                                <a href="{{ route('seleksi.calon', $programOption->registration_path_id) }}"
                                    class="bg-primary text-white py-2 px-3 rounded-md text-center">Lihat Daftar Seleksi</a>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="flex flex-col gap-3 items-center justify-center h-full">
                        <img src="{{ asset('assets/icons/empty_data.svg') }}" alt="empty" class="w-40">
                        <div class="text-center gap-2 flex flex-col items-center justify-center mb-5">
                            <h1 class="font-sora font-semibold text-lg">Kamu belum memilih satupun jalur pendaftaran
                            </h1>
                            <small class="font-sora font-semibold">Silahkan pilih jalur terlebih dahulu!</small>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>


    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const tabs = document.querySelectorAll(".tab-link");
            const contents = document.querySelectorAll(".tab-content");

            tabs.forEach(tab => {
                tab.addEventListener("click", function() {
                    tabs.forEach(t => t.classList.remove("border-primary", "text-blue-500"));
                    contents.forEach(c => c.classList.add("hidden"));

                    this.classList.add("border-primary", "text-blue-500");
                    document.getElementById(this.dataset.tab).classList.remove("hidden");
                });
            });
        });
    </script>
@endsection
