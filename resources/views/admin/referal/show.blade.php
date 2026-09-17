@extends('admin.template.template', ['title' => 'Referal Detail'])

@section('content')
<div class="bg-white p-5 rounded-2xl flex flex-col gap-6">

    {{-- Header --}}
    <div class="flex items-center justify-between">
        <h1 class="font-sora font-semibold text-xl">Detail Kode Referal</h1>
        <form method="GET" action="{{ route('referal.show', $referal->id) }}" class="flex gap-2">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama atau email..."
                class="px-4 py-2 min-w-[300px] border rounded-md outline outline-1 outline-primary">
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
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-500" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                        d="M12 11c0 2.485-2.015 4.5-4.5 4.5S3 13.485 3 11s2.015-4.5 4.5-4.5S12 8.515 12 11zm0 0c0 2.485 2.015 4.5 4.5 4.5S21 13.485 21 11s-2.015-4.5-4.5-4.5S12 8.515 12 11z" />
                </svg>
                Informasi Referal
            </h2>

            {{-- Status badge --}}
            <span class="px-3 py-1 text-sm font-medium rounded-full 
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
                <p class="mt-1 text-gray-800 font-semibold">{{ $referal->user->name ?? '-' }} - {{ $referal->user->phone
                    ?? '-' }}</p>
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
                <p class="mt-1 text-gray-700 leading-relaxed">{!! $referal->description ?? '-' !!}</p>
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


    {{-- Daftar Pengguna --}}
    <div class="w-full overflow-x-auto">
        <h2 class="font-sora font-semibold text-lg mb-3">Daftar Pengguna Kode Referal</h2>
        <table class="w-full border-collapse border border-gray-300 min-w-max">
            <thead>
                <tr class="bg-gray-100">
                    <th class="border border-gray-300 px-4 py-2">#</th>
                    <th class="border border-gray-300 px-4 py-2">Nama</th>
                    <th class="border border-gray-300 px-4 py-2">Email</th>
                    <th class="border border-gray-300 px-4 py-2">NIK</th>
                    <th class="border border-gray-300 px-4 py-2">NISN</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($personalData as $index => $personal)
                <tr>
                    <td class="border border-gray-300 px-4 py-2">{{ $personalData->firstItem() + $index }}</td>
                    <td class="border border-gray-300 px-4 py-2 whitespace-nowrap">
                        {{ $personal->user->name ?? '-' }}</td>
                    <td class="border border-gray-300 px-4 py-2 whitespace-nowrap">
                        {{ $personal->user->email ?? '-' }}</td>
                    <td class="border border-gray-300 px-4 py-2 whitespace-nowrap">{{ $personal->nik ?? '-' }}</td>
                    <td class="border border-gray-300 px-4 py-2 whitespace-nowrap">{{ $personal->nisn ?? '-' }}
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center border border-gray-300 px-4 py-2">
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
@endsection