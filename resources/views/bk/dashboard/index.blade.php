@extends('bk.template.index', ['title' => 'Daftar Siswa'])

@section('content')
    <div class="grid grid-cols-1 gap-5 w-full md:w-4/5">
        <div>
            <h1 class="font-semibold font-sora">Daftar Pengelolaan</h1>
        </div>
        <div class="grid grid-cols-1 gap-5 w-full">
    
            @forelse ($referals as $referal)
                {{-- Detail Referal Modern Card --}}
                <div class="bg-white border border-gray-200 shadow-sm rounded-2xl p-6 transition hover:shadow-xs duration-300">
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
                                <button type="button"
                                    onclick="navigator.clipboard.writeText('{{ $referal->code_pembayaran }}')"
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
                            <div class="flex gap-5 justify-between items-end">
                                <div>
                                    <p class="text-gray-500 font-medium">Total Pengguna</p>
                                    <p class="mt-1 text-gray-800 font-semibold">
                                        {{ $referal->personalData->count() }} pengguna menggunakan kode ini
                                    </p>
                                </div>
                                <div>
                                    <a href="{{ route('referalBk.show', $referal->id) }}" class="py-2 px-3 text-center bg-primary hover:bg-primary-hover text-white font-sora rounded-md flex justify-center items-center gap-2">Lihat Detail</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <span>Data Tidak Tersedia</span>
            @endforelse
    
    
        </div>
    </div>
@endsection
