@extends('customer.seleksi.template', ['title' => 'Hasil Seleksi'])

@section('content')
    <div class="w-full mx-auto p-6 bg-white rounded-xl shadow-md border border-gray-200">
        <div class="flex items-center gap-2">
            <a href="{{ route('test.show', $exam->id) }}" class="bg-gray-100 hover:bg-gray-200 p-2 rounded-md">
                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-arrow-left w-3" viewBox="0 0 16 16">
                    <path fill-rule="evenodd"
                        d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8" />
                </svg>
            </a>
            <h1 class="font-sora font-semibold text-gray-800 text-lg">Hasil {{ $exam->name }}</h1>
        </div>

        <hr class="my-5">

        <h1 class="font-sora font-semibold text-gray-800">Program Pilihan :
            @foreach ($exam->registration_path->programOptions as $option)
                {{ $option->departement->name ?? '-' }}
            @endforeach
        </h1>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
            <div class="flex items-center gap-3 bg-opacity-10 bg-primary shadow-sm p-2 rounded-md">
                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-exclamation-circle w-3 h-3"
                    viewBox="0 0 16 16">
                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16" />
                    <path
                        d="M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0M7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0z" />
                </svg>
                <span class="font-sora text-xs">{{ $exam->duration }} Menit</span>
            </div>

            <div class="flex items-center gap-3 bg-opacity-10 bg-primary shadow-sm p-2 rounded-md">
                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-calendar-week w-3 h-3"
                    viewBox="0 0 16 16">
                    <path
                        d="M11 6.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm-3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm-5 3a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5z" />
                    <path
                        d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5M1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4z" />
                </svg>
                @php
                    $start = date('d F Y', strtotime($exam->start_date));
                @endphp

                <span class="font-sora text-xs">{{ $start }}</span>
            </div>

            <div class="flex items-center gap-3 bg-opacity-10 bg-primary shadow-sm p-2 rounded-md">
                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-hourglass-split w-3 h-3"
                    viewBox="0 0 16 16">
                    <path
                        d="M2.5 15a.5.5 0 1 1 0-1h1v-1a4.5 4.5 0 0 1 2.557-4.06c.29-.139.443-.377.443-.59v-.7c0-.213-.154-.451-.443-.59A4.5 4.5 0 0 1 3.5 3V2h-1a.5.5 0 0 1 0-1h11a.5.5 0 0 1 0 1h-1v1a4.5 4.5 0 0 1-2.557 4.06c-.29.139-.443.377-.443.59v.7c0 .213.154.451.443.59A4.5 4.5 0 0 1 12.5 13v1h1a.5.5 0 0 1 0 1zm2-13v1c0 .537.12 1.045.337 1.5h6.326c.216-.455.337-.963.337-1.5V2zm3 6.35c0 .701-.478 1.236-1.011 1.492A3.5 3.5 0 0 0 4.5 13s.866-1.299 3-1.48zm1 0v3.17c2.134.181 3 1.48 3 1.48a3.5 3.5 0 0 0-1.989-3.158C8.978 9.586 8.5 9.052 8.5 8.351z" />
                </svg>
                <span class="font-sora text-xs">
                    Status Ujian:
                    <span class="inline-block px-2 py-0.5 rounded-md text-xs font-semibold bg-green-100 text-green-700">
                        {{ $exam->pengerjaan }}
                    </span>
                </span>
            </div>
        </div>
        <hr class="my-5">
        <div class="prose max-w-none text-xs w-full md:w-1/2 md:mx-auto">
            {!! $exam->description !!}
        </div>
        <hr class="my-5">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <div>
                <div
                    class="relative overflow-hidden flex flex-col outline outline-1 outline-gray-200 p-5 rounded-2xl bg-primary text-white hover:bg-primary-hover hover:text-white hover:shadow-lg">
                    <img src="{{ asset('assets/icons/outline.png') }}" alt="outline"
                        class="w-40 absolute -right-10 opacity-45">
                    <h1 class="font-sora font-semibold text-xl text-center">
                        Institut Kesehatan Rajawali
                    </h1>
                    <h1 class="font-sora font-semibold mb-3 text-center">
                        Kartu Mahasiswa
                    </h1>
                    <table class="w-full table-auto border border-gray-300 rounded-lg">
                        <tbody>
                            <tr>
                                <td class="px-4 py-2 border border-gray-300 font-semibold">Nama</td>
                                <td class="px-4 py-2 border border-gray-300">{{ $mahasiswa->user->name ?? '-'}}</td>
                            </tr>
                            <tr>
                                <td class="px-4 py-2 border border-gray-300 font-semibold">NIM</td>
                                <td class="px-4 py-2 border border-gray-300">{{ $mahasiswa->nim ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td class="px-4 py-2 border border-gray-300 font-semibold">Departement</td>
                                <td class="px-4 py-2 border border-gray-300">{{ $mahasiswa->departement->name ?? '-'}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div>
                <table class="w-full table-auto border border-gray-300 rounded-lg">
                    <tbody>
                        <tr>
                            <td class="px-4 py-2 border border-gray-300 font-semibold bg-gray-200" colspan="2">Hasil Selesi</td>
                        </tr>
                        <tr>
                            <td class="px-4 py-2 border border-gray-300 font-semibold">Score</td>
                            <td class="px-4 py-2 border border-gray-300">{{ $result->score ?? 'Masih dalam Peninjauan' }}</td>
                        </tr>
                        <tr>
                            <td class="px-4 py-2 border border-gray-300 font-semibold">Keterangan</td>
                            <td class="px-4 py-2 border border-gray-300">{!! $result->description ?? 'Masih dalam Peninjauan' !!}</td>
                        </tr>
                        <tr>
                            <td class="px-4 py-2 border border-gray-300 font-semibold">Status</td>
                            <td class="px-4 py-2 border border-gray-300">Kamu Dinyatakan <b>{{ $result->status ?? '....' }}</b></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
@endsection
