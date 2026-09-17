@extends('customer.template.template', ['title' => 'Menu Utama', 'menu' => 'pendaftaran'])

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
        <div class="w-full mx-auto">
            <div class="md:col-span-6 p-5 bg-white outline outline-1 outline-gray-200 rounded-2xl">
                <div class="p-4">
                    <div id="tab1" class="tab-content">
                        @if (!empty($missingData))
                            <div class="flex flex-col gap-3 items-center justify-center h-full">
                                <img src="{{ asset('assets/icons/empty_data.svg') }}" alt="empty" class="w-40">
                                <div class="text-center gap-2 flex flex-col items-center justify-center">
                                    <h1 class="font-sora font-semibold text-lg">Kamu belum Melengkapi Data Personal</h1>
                                    <small class="font-sora font-semibold">Silahkan lengkapi terlebih dahulu data
                                        kamu</small>
                                    <a href="{{ route('personal.data.index') }}"
                                        class="font-sora text-white bg-primary hover:bg-primary py-2 px-3 rounded-md text-center flex gap-2 items-center justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-person h-4"
                                            viewBox="0 0 16 16">
                                            <path
                                                d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z" />
                                        </svg>
                                        Lengkapi Data
                                    </a>
                                </div>
                            </div>
                        @else
                            @forelse ($programOptions as $programOption)
                                <a href="{{ route('registration.option', ['id' => $programOption->id]) }}">
                                    <div
                                        class="outline outline-1 outline-gray-200 p-5 rounded-xl gap-3 hover:bg-primary hover:text-white hover:shadow-lg shadow-md mb-3">
                                        <h1 class="font-sora font-semibold text-1xl mb-3">
                                            {{ $programOption->departement_name }}
                                        </h1>
                                        <small class="flex flex-nowrap gap-4 items-center mb-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                class="bi bi-exclamation-circle w-5" viewBox="0 0 16 16">
                                                <path
                                                    d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16" />
                                                <path
                                                    d="M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0M7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0z" />
                                            </svg>
                                            <span class="font-sora font-semibold">{{ $programOption->registration_name }} -
                                                {{ $programOption->title }}</span>
                                        </small>
                                        <small class="flex flex-nowrap gap-4 items-center mb-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                class="bi bi-calendar-week w-4" viewBox="0 0 16 16">
                                                <path
                                                    d="M11 6.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm-3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm-5 3a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5z" />
                                                <path
                                                    d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5M1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4z" />
                                            </svg>
                                            <span class="font-sora font-semibold">{{ $programOption->start_date }} s.d
                                                {{ $programOption->end_date }}</span>
                                        </small>
                                        <small class="flex flex-nowrap gap-4 items-center mb-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                class="bi bi-hourglass-split w-5" viewBox="0 0 16 16">
                                                <path
                                                    d="M2.5 15a.5.5 0 1 1 0-1h1v-1a4.5 4.5 0 0 1 2.557-4.06c.29-.139.443-.377.443-.59v-.7c0-.213-.154-.451-.443-.59A4.5 4.5 0 0 1 3.5 3V2h-1a.5.5 0 0 1 0-1h11a.5.5 0 0 1 0 1h-1v1a4.5 4.5 0 0 1-2.557 4.06c-.29.139-.443.377-.443.59v.7c0 .213.154.451.443.59A4.5 4.5 0 0 1 12.5 13v1h1a.5.5 0 0 1 0 1zm2-13v1c0 .537.12 1.045.337 1.5h6.326c.216-.455.337-.963.337-1.5V2zm3 6.35c0 .701-.478 1.236-1.011 1.492A3.5 3.5 0 0 0 4.5 13s.866-1.299 3-1.48zm1 0v3.17c2.134.181 3 1.48 3 1.48a3.5 3.5 0 0 0-1.989-3.158C8.978 9.586 8.5 9.052 8.5 8.351z" />
                                            </svg>
                                            <span class="font-sora font-semibold">Status Pendaftaran:
                                                {{ $programOption->status }}</span>
                                        </small>
                                    </div>
                                </a>
                            @empty
                                <div class="flex flex-col gap-3 items-center justify-center h-full">
                                    <img src="{{ asset('assets/icons/empty_data.svg') }}" alt="empty" class="w-40">
                                    <div class="text-center gap-2 flex flex-col items-center justify-center mb-5">
                                        <h1 class="font-sora font-semibold text-lg">Kamu belum memilih satupun jalur
                                            pendaftaran
                                        </h1>
                                        <small class="font-sora font-semibold">Silahkan pilih jalur dan program studi yang
                                            kamu inginkan</small>
                                    </div>
                                </div>
                            @endforelse

                            {{-- tombol pilih jalur hanya tampil kalau kurang dari 2 --}}
                            @if ($programOptions->count() < 2)
                                <div class="flex items-center justify-center h-full">
                                    <a href="{{ route('registration.program') }}"
                                        class="font-sora text-white bg-primary hover:bg-primary py-2 px-3 rounded-xl text-center">+
                                        Pilih Jalur Pendaftaran</a>
                                </div>
                            @endif
                        @endif
                    </div>
                </div>
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
