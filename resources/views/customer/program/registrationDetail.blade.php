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
                            <a href="{{ route('registration.fakultas', $fakultas->id) }}"
                                class="font-bold">{{ $fakultas->name }} / </a>
                            <a href="{{ route('registration.departement', $departement->id) }}"
                                class="font-bold">{{ $departement->name }} / </a>
                            <a href="" class="font-bold">{{ $registrationsPath->name }}</a>
                        </span>
                    </small>
                </div>
            </div>

            {{-- Grid Card Jalur --}}
            <div
                class="grid grid-cols-1 md:grid-cols-3 gap-5 md:col-span-6 p-5 bg-white outline outline-1 outline-gray-200 rounded-2xl items-start">
                {{-- <div class="w-full">
                    <img src="{{ asset('storage/' . $registrationsPath->image) }}" alt="model">
                </div> --}}
                <div class="md:col-span-2 order-2 md:order-1">

                    <h1 class="font-sora font-semibold mb-3">{{ $registrationsPath->title }}</h1>
                    <div class="prose max-w-none text-xs">
                        {!! $registrationsPath->description !!}
                    </div>
                </div>
                <div
                    class="w-full flex flex-col gap-1 bg-gray-100 outline outline-1 outline-primary p-3 rounded-md order-1 md:order-2">
                    <h1 class="font-sora font-semibold text-sm">
                        {{ $registrationsPath->name }} - {{ $registrationsPath->title }}
                    </h1>
                    <small>Jadwal Pendaftaran :
                        {{ \Carbon\Carbon::parse($registrationsPath->start_date)->translatedFormat('d M Y') }}</small>
                    <small>Pendaftaran Ditutup:
                        {{ \Carbon\Carbon::parse($registrationsPath->end_date)->translatedFormat('d M Y') }}</small>
                    <small>Biaya : Rp. {{ number_format($registrationsPath->amount, 0, ',', '.') }}</small>
                    <small>Status: {{ $registrationsPath->status }}</small>

                    <div class="flex items-center mt-3 gap-2">
                        <a href="{{ route('registration.program.choice', [$registrationsPath->id, $departement->id]) }}"
                            onclick="event.preventDefault(); confirmRegistration(this.href)"
                            class="bg-primary text-white hover:bg-primary-hover py-3 px-5 rounded-md">
                            Daftar Sekarang
                        </a>

                        @php
                            $whatsappNumber = '6282117100200'; // nomor tanpa +
                            $message =
                                'Halo Admin IKes Rajawali! 👋%0ASaya ingin meminta bantuan terkait jalur pendaftaran: *' .
                                $registrationsPath->name .
                                ' - ' .
                                $registrationsPath->title .
                                '*.%0A%0AMohon bantuannya ya 🙏';
                            $waLink = "https://wa.me/{$whatsappNumber}?text={$message}";
                        @endphp

                        <a href="{{ $waLink }}" target="_blank"
                            class="text-primary hover:bg-primary hover:text-white outline outline-1 outline-primary py-3 px-5 rounded-md">
                            Bantuan
                        </a>
                    </div>
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
