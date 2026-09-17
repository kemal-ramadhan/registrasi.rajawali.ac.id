@extends('customer.template.template', ['title' => 'Menu Utama', 'menu' => 'pendaftaran'])

@section('content')
<div class="w-full">
    <div class="w-full">
        {{-- Breadcrumb --}}
        <div class="w-full bg-white md:flex items-center p-5 rounded-2xl outline outline-1 outline-gray-200 mb-5">
            <div class="flex gap-2">
                <small class="font-sora flex gap-2">
                    <span>
                        <a href="{{ route('registration.option', ['id' => $programOption->id]) }}"
                            class="font-bold text-primary">Pendaftaran / </a>
                        <a href="{{ route('registration.option.paymant', ['id' => $programOption->id]) }}"
                            class="font-bold text-primary">Pembayaran / </a>
                        <a href="{{ route('registration.option.document', ['id' => $programOption->id]) }}"
                            class="">Persyaratan / </a>
                        <a href="{{ route('registration.option.test', ['id' => $programOption->id]) }}" class="">Kartu
                            Peserta </a>
                    </span>
                </small>
            </div>
        </div>

        {{-- kontent --}}
        <div
            class="md:col-span-6 p-5 bg-white outline outline-1 outline-gray-200 rounded-2xl flex flex-col gap-2 items-center justify-center">
            <div class="flex flex-col gap-2 items-center justify-center text-center w-full">
                @if ($pembayaran->status == 'SUCCESS')
                <img src="{{ asset('assets/icons/mascot-success.png') }}" alt="paymant" class="w-1/4">
                @else
                <img src="{{ asset('assets/icons/mascot-paymant-pandding.png') }}" alt="paymant" class="w-1/4">
                @endif
                <h1 class="font-sora font-semibold text-lg">Informasi Pembayaran Pendaftaran</h1>
                <small class="font-sora font-thin">Silahkan untuk melakukan pembayaran terlebih dahulu agar dokumen bisa
                    segera terverifikasi</small>
                <div class="flex gap-5 items-center justify-center">
                    @if ($registrationPath->amount == 0)
                    <span class="font-sora font-semibold text-lg">Rp.
                        {{ number_format($registrationPath->amount, 0, ',', '.') }}</span>
                    <span class="bg-green-500 text-white py-1 px-3 rounded-md">Free</span>
                    @else
                    <span class="font-sora font-semibold text-lg">Rp.
                        {{ number_format($registrationPath->amount, 0, ',', '.') }}</span>
                    @if ($pembayaranBK && $pembayaranBK->status_approve)
                    <small class="font-sora font-thin"><span
                            class="{{ $pembayaranBK->status_approve === 'SUCCESS' ? 'bg-green-500' : 'bg-red-500' }} text-white py-1 px-3 rounded-md">{{
                            $pembayaranBK->status_approve }}</span></small>
                    @else
                    <small class="font-sora font-thin"><span
                            class="{{ $pembayaran->status === 'SUCCESS' ? 'bg-green-500' : 'bg-red-500' }} text-white py-1 px-3 rounded-md">{{
                            $pembayaran->status }}</span></small>
                    @endif
                    @endif
                </div>

                @if ($registrationPath->amount == 0)
                <div class="flex items-center justify-between w-full my-5">
                    <a href="{{ route('registration.option', ['id' => $programOption->id]) }}"
                        class="font-sora text-gray-900 bg-gray-100 hover:bg-gray-200 py-2 px-3 rounded-md text-center">Kembali</a>
                    <a href="{{ route('registration.option.document', ['id' => $programOption->id]) }}"
                        class="font-sora text-white bg-primary hover:bg-gray-950 py-2 px-3 rounded-md text-center">Selanjutnya</a>
                </div>
                @else
                @if ($pembayaran->status == 'Menunggu Pembayaran')
                <div class="flex gap-5 my-5">
                    <a href="{{ route('paymant', ['id' => $programOption->id]) }}"
                        class="bg-primary text-white py-2 px-3 rounded-md text-center">Bayar Mandiri</a>
                    <a href="{{ route('paymant.bk', ['id' => $programOption->id]) }}"
                        class="bg-secound text-white py-2 px-3 rounded-md text-center">Bayar Melalui Guru BK</a>
                </div>
                @endif

                @if ($pembayaran->status == 'pending')
                @if ($programOption->status == 'Verifikasi Guru BK')
                @php
                $phone = preg_replace('/^0/', '62', $referal->user->phone ?? ''); // ubah 08 jadi 628
                $name = $referal->user->name ?? 'Guru BK';
                $message = urlencode(
                "Halo Bapak/Ibu {$name}, saya ingin menanyakan mengenai pembayaran dan proses pendaftaran saya. Mohon
                bantuannya ya. Terima kasih!",
                );
                @endphp

                <a href="https://wa.me/{{ $phone }}?text={{ $message }}" target="_blank"
                    class="bg-primary text-white py-2 px-3 rounded-md text-center font-medium hover:bg-primary-hover transition">
                    Hubungi Guru BK ({{ $name }})
                </a>
                @else
                    @if ($pembayaran->merchant_order_id)
                    <a href="{{ route('transaction.status', ['merchantOrderId' => $pembayaran->merchant_order_id]) }}"
                        class="bg-primary text-white py-2 px-3 rounded-md text-center font-medium animate-pulse-glow">
                        Cek Status Pembayaran
                    </a>
                    @else
                    <div class="flex gap-5 my-5">
                        <a href="{{ route('paymant', ['id' => $programOption->id]) }}"
                            class="bg-primary text-white py-2 px-3 rounded-md text-center">Lakukan Pembayaran</a>
                        <a href="{{ route('paymant.bk', ['id' => $programOption->id]) }}"
                            class="bg-secound text-white py-2 px-3 rounded-md text-center">Bayar Melalui Guru BK</a>
                    </div>
                    @endif
                @endif                
		@endif

                @if ($pembayaran->status == 'FAILED' || $pembayaran->status == 'EXPIRED')
                <div class="flex gap-5 my-5">
                    <a href="{{ route('paymant', ['id' => $programOption->id]) }}"
                        class="bg-primary text-white py-2 px-3 rounded-md text-center">Lakukan Pembayaran Ulang</a>
                    <a href="{{ route('paymant.bk', ['id' => $programOption->id]) }}"
                        class="bg-secound text-white py-2 px-3 rounded-md text-center">Bayar Melalui Guru BK</a>
                </div>
                @endif

                @if ($pembayaran->status == 'SUCCESS' || $pembayaranBK && $pembayaranBK->status_approve == 'SUCCESS')
                <div class="flex items-center justify-between w-full my-5">
                    <a href="{{ route('registration.option', ['id' => $programOption->id]) }}"
                        class="font-sora text-gray-900 bg-gray-100 hover:bg-gray-200 py-2 px-3 rounded-md text-center">Kembali</a>
                    <a href="{{ route('registration.option.document', ['id' => $programOption->id]) }}"
                        class="font-sora text-white bg-primary hover:bg-gray-950 py-2 px-3 rounded-md text-center">Selanjutnya</a>
                </div>
                @endif
                @endif

            </div>

        </div>
    </div>
</div>

<style>
    @keyframes pulseGlow {
        0% {
            box-shadow: 0 0 0px rgba(255, 99, 33, 0.4);
            transform: scale(1);
        }

        50% {
            box-shadow: 0 0 15px rgba(255, 99, 33, 0.8);
            transform: scale(1.05);
        }

        100% {
            box-shadow: 0 0 0px rgba(255, 99, 33, 0.4);
            transform: scale(1);
        }
    }

    .animate-pulse-glow {
        animation: pulseGlow 2s infinite ease-in-out;
        transition: all 0.3s;
    }
</style>
@endsection