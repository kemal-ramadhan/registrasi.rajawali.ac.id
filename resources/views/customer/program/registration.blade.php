@extends('customer.template.template', ['title' => 'Menu Utama', 'menu' => 'pendaftaran'])

@section('content')
    <div class="w-full mb-20">
        <div class="w-full">

            {{-- Breadcrumb --}}
            <div class="w-full bg-white hidden md:flex items-center p-5 rounded-2xl outline outline-1 outline-gray-200 mb-5">
                <div class="flex gap-2">
                    <small class="font-sora flex gap-2">
                        <span>
                            <a href="{{ route('jalur.pendaftaran') }}" class="font-bold">Jalur Pendaftaran / </a>
                            <a href="{{ route('registration.program') }}" class="font-bold">Pilih Jenjang Studi / </a>
                            <a href="{{ route('registration.fakultas', $fakultas->id) }}" class="font-bold">{{ $fakultas->name }} / </a>
                            <a href="{{ route('registration.departement', $departement->id) }}" class="font-bold">{{ $departement->name }}</a>
                        </span>
                    </small>
                </div>
            </div>

            {{-- Grid Card Jalur --}}
            <div class="md:col-span-6 p-5 bg-white outline outline-1 outline-gray-200 rounded-2xl">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-3">

                    {{-- Optimasi Looping: Tampilkan hanya path yang memiliki data --}}
                    @foreach ($registrationsPaths as $registrationsPath)
                        @php
                            $hasData = $registrations->contains('registration_path_id', $registrationsPath->id);
                        @endphp

                        @if ($hasData)
                            <a href="{{ route('registration.path.detail', ['id' => $registrationsPath->id, 'idDepartement' => $departement->id]) }}">
                                <div class="relative overflow-hidden flex flex-col gap-3 h-50 md:h-40 outline outline-1 outline-gray-200 p-5 rounded-2xl bg-primary text-white hover:bg-primary-hover hover:text-white hover:shadow-lg">
                                    {{-- Icon background --}}
                                    <img src="{{ asset('assets/icons/outline.png') }}" alt="outline" class="w-20 absolute bottom-0 -right-5 opacity-50">
                                    
                                    <h1 class="font-sora font-semibold">{{ $registrationsPath->title }}</h1>
                                    <small class="font-sora font-thin hidden md:block">
                                        {{ \Illuminate\Support\Str::words(strip_tags($registrationsPath->description), 50, '...') }}
                                    </small>                                    
                                    <small class="font-sora font-thin md:hidden">
                                        {{ \Illuminate\Support\Str::words(strip_tags($registrationsPath->description), 20, '...') }}
                                    </small>                                    

                                    {{-- Info badge --}}
                                    <div class="flex gap-3 flex-wrap">
                                        <small class="bg-white rounded-md text-xs text-primary p-1">{{ $registrationsPath->name }}</small>
                                        <small class="bg-white rounded-md text-xs text-primary p-1">
                                            {{ \Carbon\Carbon::parse($registrationsPath->end_date)->translatedFormat('d M Y') }}
                                        </small>
                                        <small class="bg-white rounded-md text-xs text-primary p-1">
                                            Rp. {{ number_format($registrationsPath->amount, 0, ',', '.') }}
                                        </small>
                                    </div>
                                </div>
                            </a>
                        @endif
                    @endforeach

                </div>
            </div>
        </div>
    </div>

    {{-- SweetAlert untuk konfirmasi --}}
    <script>
        function confirmRegistration(url) {
            Swal.fire({
                title: "Apakah Anda yakin?",
                text: "Anda akan mendaftar ke program ini!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya, daftar!",
                cancelButtonText: "Batal"
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = url;
                }
            });
        }
    </script>
@endsection
