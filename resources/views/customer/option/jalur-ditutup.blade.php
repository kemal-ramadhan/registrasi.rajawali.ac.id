@extends('customer.template.template', ['title' => 'Jalur Ditutup', 'menu' => 'pendaftaran'])

@section('content')
<div class="min-h-screen flex items-center justify-center px-4 py-12">
    <div class="max-w-lg w-full">

        {{-- Card Utama --}}
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden">

            {{-- Header --}}
            <div class="bg-primary px-6 py-8 text-center">
                <div class="w-20 h-20 bg-white bg-opacity-20 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 9v2m0 4h.01M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z" />
                    </svg>
                </div>
                <h1 class="text-2xl font-bold text-white mb-2">Jalur Pendaftaran Ditutup</h1>
                <p class="text-white text-opacity-80 text-sm">Periode pendaftaran untuk jalur ini telah berakhir</p>
            </div>

            {{-- Body --}}
            <div class="px-6 py-8">
                {{-- Info Jalur --}}
                <div class="bg-red-50 border border-red-200 rounded-xl p-4 mb-6">
                    <div class="flex items-start gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-red-500 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                        </svg>
                        <div>
                            <p class="font-semibold text-red-700 text-sm">Jalur yang Ditutup</p>
                            <p class="text-red-600 text-sm mt-1">{{ $registrationPath->name }}  {{ $registrationPath->title }}</p>
                        </div>
                    </div>
                </div>

                {{-- Pesan --}}
                <p class="text-gray-600 text-sm text-center mb-6">
                    Mohon maaf, pendaftaran melalui jalur ini sudah tidak dapat dilanjutkan.
                    Kamu masih bisa mendaftar melalui jalur lain yang tersedia.
                </p>

                {{-- Jalur Alternatif --}}
                @if(isset($jalurAltErnatif) && count($jalurAltErnatif) > 0)
                <div class="mb-6">
                    <p class="text-sm font-semibold text-gray-700 mb-3">Jalur yang Masih Tersedia:</p>
                    <div class="flex flex-col gap-2">
                        @foreach($jalurAltErnatif as $jalur)
                        <a href="{{ route('registration.path', $jalur->id) }}"
                            class="flex items-center justify-between p-3 border border-primary rounded-xl hover:bg-primary hover:text-white transition-all group">
                            <div>
                                <p class="font-medium text-sm group-hover:text-white">{{ $jalur->title }}</p>
                                <p class="text-xs text-gray-500 group-hover:text-white text-opacity-80">{{ $jalur->name }}</p>
                            </div>
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </a>
                        @endforeach
                    </div>
                </div>
                @endif

                {{-- Tombol --}}
                <div class="flex flex-col gap-3">
                    <a href="{{ route('registration.program') }}"
                        class="w-full bg-primary text-white text-center py-3 rounded-xl font-medium hover:bg-opacity-90 transition-all text-sm">
                        Lihat Semua Jalur Pendaftaran
                    </a>
                    <a href="{{ route('beranda') }}"
                        class="w-full border border-gray-300 text-gray-600 text-center py-3 rounded-xl font-medium hover:bg-gray-50 transition-all text-sm">
                        Kembali ke Dashboard
                    </a>
                </div>
            </div>

        </div>

        {{-- Info Bantuan --}}
        <p class="text-center text-xs text-gray-400 mt-4">
            Butuh bantuan? Hubungi kami via
            <a href="https://api.whatsapp.com/send?phone=6281312157307&text=Halo,%20saya%20ingin%20bertanya%20mengenai%20jalur%20pendaftaran"
                class="text-primary underline" target="_blank">WhatsApp</a>
        </p>

    </div>
</div>
@endsection