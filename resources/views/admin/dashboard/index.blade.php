@extends('admin.template.template', ['title' => 'Dashboard'])

@section('content')
<div class="grid grid-cols-1 md:grid-cols-4 gap-5 my-5 items-start">
    <div class="flex flex-col gap-1 md:col-span-4">
        <small class="font-sora text-2xl font-thin">Selamat Datang, {{ auth()->user()->name }}!</small>
        <span class="font-sora">Dashboard Admin Sistem Penerimaan Mahasiswa Baru Universitas Bakti Tunas Husada.</span>
    </div>
    <div
        class="group relative bg-white transition-all duration-300 p-5 rounded-2xl shadow-md hover:shadow-xl w-full flex flex-col gap-4">
        <!-- Icon background effect -->
        <div class="absolute top-3 right-3 text-prifrom-primary/20 text-gray-900 transition-all duration-300">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M17 20h5v-2a8 8 0 10-16 0v2h5m4 0v-2m-4 0v2m0 0H5a2 2 0 01-2-2v-2a10 10 0 1120 0v2a2 2 0 01-2 2h-5z" />
            </svg>
        </div>

        <!-- Title -->
        <span class="font-sora text-sm text-gray-900 tracking-wide">Jumlah Pengguna</span>

        <!-- Main value -->
        <h1 class="font-sora font-bold text-4xl text-gray-900 transition-all">{{ $userCount }}
        </h1>

        <!-- Divider -->
        <div class="w-full h-[1px] bg-gray-900"></div>

        <!-- Sub grid -->
        <div class="grid grid-cols-2 gap-4">
            <div class="flex flex-col items-start bg-gray-50 hover:bg-indigo-50 transition rounded-xl p-4">
                <span class="font-sora text-xs text-gray-900">Pendaftar Hari Ini</span>
                <h2 class="font-sora font-semibold text-2xl text-gray-900 transition-all">
                    {{ $userCountToday }}</h2>
            </div>
            <div class="flex flex-col items-start bg-gray-50 hover:bg-indigo-50 transition rounded-xl p-4">
                <span class="font-sora text-xs text-gray-900">Pendaftar Kemarin</span>
                <h2 class="font-sora font-semibold text-2xl text-gray-900 transition-all">
                    {{ $userCountYesterday }}</h2>
            </div>
        </div>

        <!-- Divider -->
        <div class="w-full h-[1px] bg-gray-900"></div>

        <!-- Title -->
        <span class="font-sora text-xs text-gray-900 tracking-wide mt-3">Transaksi Pendaftaran</span>
        <!-- Sub grid -->
        <div class="grid grid-cols-1 gap-4">
            <div class="flex flex-col items-start bg-gray-50 hover:bg-indigo-50 transition rounded-xl p-4">
                <span class="font-sora text-xs text-gray-900">Transaksi Kemarin (Success)</span>
                <h2 class="font-sora font-semibold text-2xl text-gray-900 transition-all">
                    Rp. {{ number_format($totalAmountSuccessYesterday, 0, ',', '.') }}</h2>
            </div>
            <div class="flex flex-col items-start bg-gray-50 hover:bg-indigo-50 transition rounded-xl p-4">
                <span class="font-sora text-xs text-gray-900">Transaksi Kemarin (Panding)</span>
                <h2 class="font-sora font-semibold text-2xl text-gray-900 transition-all">
                    Rp. {{ number_format($totalAmountPendingYesterday, 0, ',', '.') }}</h2>
            </div>
        </div>

        <!-- Divider -->
        <div class="w-full h-[1px] bg-gray-900"></div>

        <!-- Title -->
        <span class="font-sora text-xs text-gray-900 tracking-wide mt-3">Transaksi Daftar Ulang</span>
        <!-- Sub grid -->
        <div class="grid grid-cols-1 gap-4">
            <div class="flex flex-col items-start bg-gray-50 hover:bg-indigo-50 transition rounded-xl p-4">
                <span class="font-sora text-xs text-gray-900">Transaksi Kemarin (Success)</span>
                <h2 class="font-sora font-semibold text-2xl text-gray-900 transition-all">
                    Rp. {{ number_format($totalAmountSuccessYesterdayDaftarUlang, 0, ',', '.') }}</h2>
            </div>
            <div class="flex flex-col items-start bg-gray-50 hover:bg-indigo-50 transition rounded-xl p-4">
                <span class="font-sora text-xs text-gray-900">Transaksi Kemarin (Panding)</span>
                <h2 class="font-sora font-semibold text-2xl text-gray-900 transition-all">
                    Rp. {{ number_format($totalAmountPendingYesterdayDaftarUlang, 0, ',', '.') }}</h2>
            </div>
        </div>
    </div>

    <div class="col-span-3 grid grid-cols-1 gap-5">

        <div
            class="bg-white border border-gray-100 p-6 rounded-2xl shadow-sm hover:shadow-md transition-all duration-300 w-full flex flex-col gap-6">

            <!-- Header -->
            <div class="flex items-center justify-between">
                <h2 class="font-sora font-semibold text-lg text-gray-800">Status Pendaftaran</h2>
                <span class="text-xs text-gray-500">Update: {{ now()->format('d M Y') }}</span>
            </div>

            <!-- Grid Pertama -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <div class="flex flex-col items-start bg-gray-50 hover:bg-indigo-50 transition rounded-xl p-4">
                    <span class="text-xs text-gray-500 font-sora">Tinggal Bayar</span>
                    <h2 class="text-2xl font-bold text-gray-800 mt-1">{{ $pembayaran }}</h2>
                </div>
                <div class="flex flex-col items-start bg-gray-50 hover:bg-indigo-50 transition rounded-xl p-4">
                    <span class="text-xs text-gray-500 font-sora">Upload Dokumen</span>
                    <h2 class="text-2xl font-bold text-gray-800 mt-1">{{ $uploadDokumen }}</h2>
                </div>
                <div class="flex flex-col items-start bg-gray-50 hover:bg-indigo-50 transition rounded-xl p-4">
                    <span class="text-xs text-gray-500 font-sora">Verifikasi Dokumen</span>
                    <h2 class="text-2xl font-bold text-gray-800 mt-1">{{ $verfikasiDokumen }}</h2>
                </div>
                <div class="flex flex-col items-start bg-gray-50 hover:bg-indigo-50 transition rounded-xl p-4">
                    <span class="text-xs text-gray-500 font-sora">Revisi Dokumen</span>
                    <h2 class="text-2xl font-bold text-gray-800 mt-1">{{ $revisiDokumen }}</h2>
                </div>
            </div>

            <!-- Divider -->
            <div class="w-full h-[1px] bg-gray-200"></div>

            <!-- Grid Kedua -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <div class="flex flex-col items-start bg-gray-50 hover:bg-indigo-50 transition rounded-xl p-4">
                    <span class="text-xs text-gray-500 font-sora">Proses Seleksi</span>
                    <h2 class="text-2xl font-bold text-gray-800 mt-1">{{ $prosesSeleksi }}</h2>
                </div>
                <div class="flex flex-col items-start bg-gray-50 hover:bg-indigo-50 transition rounded-xl p-4">
                    <span class="text-xs text-gray-500 font-sora">Daftar Ulang</span>
                    <h2 class="text-2xl font-bold text-gray-800 mt-1">{{ $daftarUlang }}</h2>
                </div>
                <div class="flex flex-col items-start bg-gray-50 hover:bg-indigo-50 transition rounded-xl p-4">
                    <span class="text-xs text-gray-500 font-sora">Generate NIM</span>
                    <h2 class="text-2xl font-bold text-gray-800 mt-1">{{ $generateNIM }}</h2>
                </div>
                <div class="flex flex-col items-start bg-gray-50 hover:bg-indigo-50 transition rounded-xl p-4">
                    <span class="text-xs text-gray-500 font-sora">Lulus</span>
                    <h2 class="text-2xl font-bold text-gray-800 mt-1">{{ $lulus }}</h2>
                </div>
            </div>
        </div>

        <div
            class="bg-white border border-gray-100 p-6 rounded-2xl shadow-sm hover:shadow-md transition-all duration-300 w-full flex flex-col gap-6">

            <!-- Header -->
            <div class="flex items-center justify-between">
                <h2 class="font-sora font-semibold text-lg text-gray-800">Transaksi Pendaftaran</h2>
                <span class="text-xs text-gray-500">Update: {{ now()->format('d M Y') }}</span>
            </div>

            <!-- Grid Pertama -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <div class="flex flex-col items-start bg-gray-50 hover:bg-indigo-50 transition rounded-xl p-4">
                    <span class="text-xs text-gray-500 font-sora">All Transaksi (Success)</span>
                    <h2 class="text-2xl font-bold text-gray-800 mt-1">Rp.
                        {{ number_format($totalAmountSuccess, 0, ',', '.') }}</h2>
                </div>
                <div class="flex flex-col items-start bg-gray-50 hover:bg-indigo-50 transition rounded-xl p-4">
                    <span class="text-xs text-gray-500 font-sora">All Transaksi (Pending)</span>
                    <h2 class="text-2xl font-bold text-gray-800 mt-1">Rp.
                        {{ number_format($totalAmountPending, 0, ',', '.') }}</h2>
                </div>
                <div class="flex flex-col items-start bg-gray-50 hover:bg-indigo-50 transition rounded-xl p-4">
                    <span class="text-xs text-gray-500 font-sora">Transaksi Hari Ini (Success)</span>
                    <h2 class="text-2xl font-bold text-gray-800 mt-1">Rp.
                        {{ number_format($totalAmountSuccessToday, 0, ',', '.') }}</h2>
                </div>
                <div class="flex flex-col items-start bg-gray-50 hover:bg-indigo-50 transition rounded-xl p-4">
                    <span class="text-xs text-gray-500 font-sora">Transaksi Hari Ini (Pending)</span>
                    <h2 class="text-2xl font-bold text-gray-800 mt-1">Rp.
                        {{ number_format($totalAmountPendingToday, 0, ',', '.') }}</h2>
                </div>
            </div>
        </div>

        <div
            class="bg-white border border-gray-100 p-6 rounded-2xl shadow-sm hover:shadow-md transition-all duration-300 w-full flex flex-col gap-6">

            <!-- Header -->
            <div class="flex items-center justify-between">
                <h2 class="font-sora font-semibold text-lg text-gray-800">Transaksi Daftar Ulang</h2>
                <span class="text-xs text-gray-500">Update: {{ now()->format('d M Y') }}</span>
            </div>

            <!-- Grid Pertama -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <div class="flex flex-col items-start bg-gray-50 hover:bg-indigo-50 transition rounded-xl p-4">
                    <span class="text-xs text-gray-500 font-sora">All Transaksi (Success)</span>
                    <h2 class="text-2xl font-bold text-gray-800 mt-1">Rp.
                        {{ number_format($totalAmountSuccessDaftarUlang, 0, ',', '.') }}</h2>
                </div>
                <div class="flex flex-col items-start bg-gray-50 hover:bg-indigo-50 transition rounded-xl p-4">
                    <span class="text-xs text-gray-500 font-sora">All Transaksi (Pending)</span>
                    <h2 class="text-2xl font-bold text-gray-800 mt-1">Rp.
                        {{ number_format($totalAmountPendingDaftarUlang, 0, ',', '.') }}</h2>
                </div>
                <div class="flex flex-col items-start bg-gray-50 hover:bg-indigo-50 transition rounded-xl p-4">
                    <span class="text-xs text-gray-500 font-sora">Transaksi Hari Ini (Success)</span>
                    <h2 class="text-2xl font-bold text-gray-800 mt-1">Rp.
                        {{ number_format($totalAmountSuccessTodayDaftarUlang, 0, ',', '.') }}</h2>
                </div>
                <div class="flex flex-col items-start bg-gray-50 hover:bg-indigo-50 transition rounded-xl p-4">
                    <span class="text-xs text-gray-500 font-sora">Transaksi Hari Ini (Pending)</span>
                    <h2 class="text-2xl font-bold text-gray-800 mt-1">Rp.
                        {{ number_format($totalAmountPendingTodayDaftarUlang, 0, ',', '.') }}</h2>
                </div>
            </div>
        </div>

    </div>

</div>

<!-- CHART BARU: TAHAPAN PMB -->
<div class="bg-white p-5 rounded-xl shadow-sm font-semibold mb-5">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <label for="" class="text-lg font-sora font-semibold whitespace-nowrap">Filter Status Tahapan PMB</label>
        
        <form method="GET" action="{{ route('dashboard') }}" class="w-full md:w-auto flex flex-col md:flex-row gap-3 items-center">
            <!-- Menjaga parameter month & year chart sebelumnya agar tidak keriset -->
            <input type="hidden" name="month" value="{{ $selectedMonth }}">
            <input type="hidden" name="year" value="{{ $selectedYear }}">
            
            <div class="flex items-center gap-2 w-full md:w-auto">
                <span class="text-sm font-normal">Dari:</span>
                <input type="date" name="start_date" value="{{ $startDate }}" class="border p-2 rounded w-full md:w-auto bg-gray-50">
            </div>
            <div class="flex items-center gap-2 w-full md:w-auto">
                <span class="text-sm font-normal">Sampai:</span>
                <input type="date" name="end_date" value="{{ $endDate }}" class="border p-2 rounded w-full md:w-auto bg-gray-50">
            </div>
            <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700 transition w-full md:w-auto">Cari Rentang</button>
        </form>
    </div>
    <hr class="my-4">
    <div id="{{ $statusChart->id }}">
        {!! $statusChart->container() !!}
    </div>
</div>

<div class="bg-white p-5 rounded-xl shadow-sm mb-5">
    <div id="{{ $chart->id }}">
        {!! $chart->container() !!}
    </div>
</div>

<div class="bg-white p-5 rounded-xl shadow-sm font-semibold mb-5">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <label for="" class="text-lg font-sora font-semibold whitespace-nowrap">Pilih Bulan & Tahun</label>
        
        <form method="GET" action="{{ route('dashboard') }}" class="w-full md:w-auto flex gap-3">
            <!-- Menjaga parameter start_date & end_date agar tidak keriset -->
            <input type="hidden" name="start_date" value="{{ $startDate }}">
            <input type="hidden" name="end_date" value="{{ $endDate }}">

            <!-- Pilihan Bulan -->
            <select name="month" id="month" onchange="this.form.submit()" class="border p-2 rounded w-full md:w-48 bg-gray-50">
                @foreach (range(1, 12) as $month)
                <option value="{{ $month }}" {{ (int) request('month', now()->month) === $month ? 'selected' : '' }}>
                    {{ \Carbon\Carbon::create()->month($month)->translatedFormat('F') }}
                </option>
                @endforeach
            </select>
            
            <!-- Pilihan Tahun -->
            <select name="year" id="year" onchange="this.form.submit()" class="border p-2 rounded w-full md:w-32 bg-gray-50">
                @php
                    $currentYear = now()->year;
                    $startYear = 2024; 
                @endphp
                @foreach (range($currentYear, $startYear) as $year)
                <option value="{{ $year }}" {{ (int) request('year', $currentYear) === $year ? 'selected' : '' }}>
                    {{ $year }}
                </option>
                @endforeach
            </select>
        </form>
    </div>
    <hr class="my-4">
    <div id="{{ $chartUser->id }}">
        {!! $chartUser->container() !!}
    </div>
</div>

<div class="grid grid-cols-2 gap-5 mb-5">
    <div class="bg-white p-5 rounded-xl shadow-sm">
        <div id="{{ $genderPie->id }}">
            {!! $genderPie->container() !!}
        </div>
    </div>
    <div class="bg-white p-5 rounded-xl shadow-sm">
        <div id="{{ $ageBarChart->id }}">
            {!! $ageBarChart->container() !!}
        </div>
    </div>
</div>
<div class="bg-white p-5 rounded-xl shadow-sm mb-5">
    <div id="{{ $mediaInformationChart->id }}">
        {!! $mediaInformationChart->container() !!}
    </div>
</div>
<div class="bg-white p-5 rounded-xl shadow-sm mb-5">
    <div id="{{ $topCityBarChart->id }}">
        {!! $topCityBarChart->container() !!}
    </div>
</div>

<script src="{{ $statusChart->cdn() }}"></script>
{{ $statusChart->script() }}
<script src="{{ $chart->cdn() }}"></script>
{{ $chart->script() }}
<script src="{{ $chartUser->cdn() }}"></script>
{{ $chartUser->script() }}
<script src="{{ $genderPie->cdn() }}"></script>
{{ $genderPie->script() }}
<script src="{{ $ageBarChart->cdn() }}"></script>
{{ $ageBarChart->script() }}
<script src="{{ $topCityBarChart->cdn() }}"></script>
{{ $topCityBarChart->script() }}
<script src="{{ $mediaInformationChart->cdn() }}"></script>
{{ $mediaInformationChart->script() }}
@endsection