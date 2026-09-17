@extends('bk.template.index', ['title' => 'Daftar Siswa'])

@section('content')
    <div class="bg-white p-5 rounded-2xl flex flex-col gap-6 w-full md:w-5/6">

        {{-- Header --}}
        <div class="flex flex-wrap md:flex-nowrap gap-5 items-center justify-between">
            <div class="flex gap-3 items-center">
                <a href="{{ route('dashboard.bk') }}" class="p-2 rounded-xl hover:bg-primary hover:text-white bg-gray-200">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-box-arrow-left" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M6 12.5a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v2a.5.5 0 0 1-1 0v-2A1.5 1.5 0 0 1 6.5 2h8A1.5 1.5 0 0 1 16 3.5v9a1.5 1.5 0 0 1-1.5 1.5h-8A1.5 1.5 0 0 1 5 12.5v-2a.5.5 0 0 1 1 0z" />
                        <path fill-rule="evenodd"
                            d="M.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L1.707 7.5H10.5a.5.5 0 0 1 0 1H1.707l2.147 2.146a.5.5 0 0 1-.708.708z" />
                    </svg>
                </a>
                <h1 class="font-sora font-semibold text-xl">Detail Kode Referal</h1>
            </div>
            <form method="GET" action="{{ route('referalBk.show', $referal->id) }}" class="flex gap-2">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama atau email..."
                    class="px-4 py-2 min-w-[250px] border rounded-md outline outline-1 outline-primary">
                <button type="submit" class="p-3 bg-primary rounded-md hover:bg-gray-900 text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-search w-3"
                        viewBox="0 0 16 16">
                        <path
                            d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
                    </svg>
                </button>
            </form>
        </div>

        {{-- Detail Referal Modern Card --}}
        <div class="bg-white border border-gray-200 shadow-sm rounded-2xl p-6 transition hover:shadow-md duration-300">
            <div class="flex items-center justify-between mb-5">
                <h2 class="font-sora font-semibold text-xl text-gray-800 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-500" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                            d="M12 11c0 2.485-2.015 4.5-4.5 4.5S3 13.485 3 11s2.015-4.5 4.5-4.5S12 8.515 12 11zm0 0c0 2.485 2.015 4.5 4.5 4.5S21 13.485 21 11s-2.015-4.5-4.5-4.5S12 8.515 12 11z" />
                    </svg>
                    Informasi Referal
                </h2>

                {{-- Status badge --}}
                <span
                    class="px-3 py-1 text-sm font-medium rounded-full 
            {{ $referal->status == 'active' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                    {{ ucfirst($referal->status) }}
                </span>
            </div>

            <div class="grid sm:grid-cols-2 gap-y-5 gap-x-8 text-sm">
                {{-- Institusi --}}
                <div>
                    <p class="text-gray-500 font-medium">Institusi</p>
                    <p class="mt-1 text-gray-800 font-semibold">{{ $referal->institution ?? '-' }}</p>
                </div>

                {{-- Kode Referal --}}
                <div>
                    <p class="text-gray-500 font-medium">Kode Referal</p>
                    <p class="mt-1 text-indigo-600 font-semibold">{{ $referal->code ?? '-' }}</p>
                </div>

                {{-- Penanggung Jawab --}}
                <div>
                    <p class="text-gray-500 font-medium">Penanggung Jawab</p>
                    <p class="mt-1 text-gray-800 font-semibold">{{ $referal->user->name ?? '-' }}</p>
                </div>

                {{-- Kode Pembayaran --}}
                <div>
                    <p class="text-gray-500 font-medium">Kode Pembayaran Siswa</p>
                    <div class="mt-1 flex items-center gap-2">
                        <span class="font-mono bg-gray-100 text-gray-800 px-2 py-1 rounded-md">
                            {{ $referal->code_pembayaran ?? '-' }}
                        </span>
                        <button type="button" onclick="navigator.clipboard.writeText('{{ $referal->code_pembayaran }}')"
                            class="text-gray-500 hover:text-indigo-500 transition" title="Salin Kode">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6"
                                    d="M8 16h8M8 12h8m-8-4h8m-2-4H6a2 2 0 00-2 2v12a2 2 0 002 2h8l6-6V6a2 2 0 00-2-2z" />
                            </svg>
                        </button>
                    </div>
                </div>

                {{-- Deskripsi --}}
                <div class="sm:col-span-2">
                    <p class="text-gray-500 font-medium">Deskripsi</p>
                    <div class="mt-1 text-gray-700 leading-relaxed prose prose-gray max-w-none text-xs">
                                {!! html_entity_decode($referal->description ?? '-') !!}
                            </div>
                </div>

                {{-- Total Pengguna --}}
                <div class="sm:col-span-2 border-t border-gray-200 pt-4">
                    <p class="text-gray-500 font-medium">Total Pengguna</p>
                    <p class="mt-1 text-gray-800 font-semibold">
                        {{ $referal->personalData->count() }} pengguna menggunakan kode ini
                    </p>
                </div>
            </div>
        </div>

        {{-- transaksi --}}
        <div
                class="bg-white border border-gray-100 p-6 rounded-2xl shadow-sm hover:shadow-md transition-all duration-300 w-full flex flex-col gap-6">

                <!-- Header -->
                <div class="flex items-center justify-between">
                    <h2 class="font-sora font-semibold text-lg text-gray-800">Transaksi Pendafatran</h2>
                    <span class="text-xs text-gray-500">Update: {{ now()->format('d M Y') }}</span>
                </div>

                <!-- Grid Pertama -->
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    <div class="flex flex-col items-start bg-gray-50 hover:bg-indigo-50 transition rounded-xl p-4">
                        <span class="text-xs text-gray-500 font-sora">All Transaksi (Success)</span>
                        <h2 class="text-2xl font-bold text-gray-800 mt-1">Rp. {{ number_format($totalTransaksiAll, 0, ',', '.') }}</h2>
                    </div>
                    <div class="flex flex-col items-start bg-gray-50 hover:bg-indigo-50 transition rounded-xl p-4">
                        <span class="text-xs text-gray-500 font-sora">Tagihan Saya Ke Kampus</span>
                        <h2 class="text-2xl font-bold text-gray-800 mt-1">Rp. {{ number_format($tagihan, 0, ',', '.') }}</h2>
                    </div>
                    <div class="flex flex-col items-start bg-gray-50 hover:bg-indigo-50 transition rounded-xl p-4">
                        <span class="text-xs text-gray-500 font-sora">Sudah Di Setorkan Ke Kampus</span>
                        <h2 class="text-2xl font-bold text-gray-800 mt-1">Rp. {{ number_format($lunas, 0, ',', '.') }}</h2>
                    </div>
                    <div class="flex flex-col items-start bg-gray-50 hover:bg-indigo-50 transition rounded-xl p-4">
                        <span class="text-xs text-gray-500 font-sora">Antrian Verifikasi Pembayaran</span>
                        <h2 class="text-2xl font-bold text-gray-800 mt-1">Rp. {{ number_format($pending, 0, ',', '.') }}</h2>
                    </div>
                </div>
            </div>


        {{-- Daftar Pengguna --}}
        <div class="w-full overflow-x-auto mt-6">
            <h2 class="font-sora font-semibold text-lg mb-3">Daftar Pengguna Kode Referal</h2>
            <table class="w-full border-collapse border border-gray-300 min-w-max">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="border border-gray-300 px-4 py-2">#</th>
                        <th class="border border-gray-300 px-4 py-2">Nama</th>
                        <th class="border border-gray-300 px-4 py-2">Email</th>
                        <th class="border border-gray-300 px-4 py-2">NIK</th>
                        <th class="border border-gray-300 px-4 py-2">NISN</th>
                        <th class="border border-gray-300 px-4 py-2">Nominal</th>
                        <th class="border border-gray-300 px-4 py-2">Tipe</th>
                        <th class="border border-gray-300 px-4 py-2">Status Approve</th>
                        <th class="border border-gray-300 px-4 py-2">Keuangan Kampus</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($personalData as $index => $personal)
                        @php
                            // Cocokkan data pembayaran berdasarkan user_id
                            $pembayaran = $pembayaranBk->where('user_id', $personal->user_id)->first();
                        @endphp
                        <tr>
                            <td class="border border-gray-300 px-4 py-2">{{ $personalData->firstItem() + $index }}</td>
                            <td class="border border-gray-300 px-4 py-2 whitespace-nowrap">
                                {{ $personal->user->name ?? '-' }}</td>
                            <td class="border border-gray-300 px-4 py-2 whitespace-nowrap">
                                {{ $personal->user->email ?? '-' }}</td>
                            <td class="border border-gray-300 px-4 py-2 whitespace-nowrap">{{ $personal->nik ?? '-' }}</td>
                            <td class="border border-gray-300 px-4 py-2 whitespace-nowrap">{{ $personal->nisn ?? '-' }}
                            </td>
                            <td class="border border-gray-300 px-4 py-2 whitespace-nowrap text-right">
                                Rp. {{ number_format($pembayaran?->nominal ?? 0, 0, ',', '.') }}
                            </td>
                            <td class="border border-gray-300 px-4 py-2 whitespace-nowrap">
                                {{ ucfirst($pembayaran->type ?? '-') }}
                            </td>
                            <td class="border border-gray-300 px-4 py-2 whitespace-nowrap">
                                @if ($pembayaran && ($pembayaran->status_approve == 'panding' || $pembayaran->status_approve == 'pending'))
                                    <form id="form-approve-reject-{{ $pembayaran->id }}"
                                        action="{{ route('referalBk.update', $pembayaran->id) }}" method="post">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="userId" value="{{ $personal->user_id ?? '-' }}">
                                        <input type="hidden" name="amount" value="{{ $pembayaran->nominal ?? '-' }}">
                                        <input type="hidden" name="action" id="action-input-{{ $pembayaran->id }}">

                                        <div class="flex gap-3">
                                            <!-- Tombol Approve -->
                                            <button type="button"
                                                onclick="confirmAction('{{ $pembayaran->id }}', 'approve')"
                                                class="bg-green-500 p-1 rounded-full text-white hover:bg-green-600 transition">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-check2-circle" viewBox="0 0 16 16">
                                                    <path
                                                        d="M2.5 8a5.5 5.5 0 0 1 8.25-4.764.5.5 0 0 0 .5-.866A6.5 6.5 0 1 0 14.5 8a.5.5 0 0 0-1 0 5.5 5.5 0 1 1-11 0" />
                                                    <path
                                                        d="M15.354 3.354a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0z" />
                                                </svg>
                                            </button>

                                            <!-- Tombol Reject -->
                                            <button type="button"
                                                onclick="confirmAction('{{ $pembayaran->id }}', 'reject')"
                                                class="bg-red-500 p-1 rounded-full text-white hover:bg-red-600 transition">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
                                                    <path
                                                        d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16" />
                                                    <path
                                                        d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708" />
                                                </svg>
                                            </button>
                                        </div>
                                    </form>
                                @endif

                                @if ($pembayaran && $pembayaran->status_approve == 'SUCCESS')
                                    <span class="text-green-600 font-semibold">SUCCESS</span>
                                @endif

                                @if (!$pembayaran)
                                    <span class="text-gray-500 italic">Data pembayaran tidak ditemukan</span>
                                @endif
                            </td>
                            <td class="border border-gray-300 px-4 py-2 whitespace-nowrap">
                                {{ ucfirst($pembayaran->status_keuangan ?? '-') }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center border border-gray-300 px-4 py-2">
                                Belum ada pengguna untuk kode referal ini.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>


        {{-- Pagination --}}
        <div>
            {{ $personalData->appends(['search' => request('search')])->links() }}
        </div>

    </div>


    <script>
        function confirmAction(id, action) {
            let message = action === 'approve' ?
                'Apakah kamu yakin ingin menyetujui pembayaran ini?' :
                'Apakah kamu yakin ingin menolak pembayaran ini?';

            let confirmText = action === 'approve' ? 'Ya, Setujui' : 'Ya, Tolak';

            Swal.fire({
                title: 'Konfirmasi',
                text: message,
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: action === 'approve' ? '#16a34a' : '#dc2626',
                cancelButtonColor: '#6b7280',
                confirmButtonText: confirmText,
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('action-input-' + id).value = action;
                    document.getElementById('form-approve-reject-' + id).submit();
                }
            });
        }
    </script>
@endsection
