@extends('customer.template.template', ['title' => 'Menu Utama', 'menu' => 'pembayaran'])

@section('content')
    <div class="mb-20 md:mb-0">
        {{-- pembayaran langsung --}}
        <div class="w-full bg-white items-center p-5 rounded-2xl outline outline-1 outline-gray-200 mb-5">
            <div class="">
                <div class="flex gap-2">
                    <small class="font-sora flex gap-2">
                        <span>
                            <a href="{{ route('paymant.index') }}" class="font-bold">Pembayaran Saya</a>
                        </span>
                    </small>
                </div>
            </div>
        </div>

        <div class="w-full grid grid-cols-1 md:grid-cols-3 items-center gap-5">
            @foreach ($biayas as $biaya)
                <div class="bg-white rounded-2xl p-5 text-xs flex flex-col gap-3">
                    <h1 class="font-sora font-semibold">{{ $biaya->biaya }}</h1>
                    <small class="prose text-xs">
                        {!! $biaya->description !!}
                    </small>
                    <span class="flex gap-3 items-center text-xs">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-credit-card-2-front w-3"
                            viewBox="0 0 16 16">
                            <path
                                d="M14 3a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1zM2 2a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2z" />
                            <path
                                d="M2 5.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5zm0 3a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5m3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5m3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5m3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5" />
                        </svg>
                        {{ $biaya->type }}
                    </span>
                    <span class="flex gap-3 items-center text-xs">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-calendar-week w-3"
                            viewBox="0 0 16 16">
                            <path
                                d="M11 6.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm-3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm-5 3a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5z" />
                            <path
                                d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5M1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4z" />
                        </svg>
                        Wajib DIbayarkan Sebelum tanggal {{ $biaya->tengat_akhir }}
                    </span>
                    <span class="flex gap-3 items-center text-xs">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-arrow-clockwise w-3"
                            viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M8 3a5 5 0 1 0 4.546 2.914.5.5 0 0 1 .908-.417A6 6 0 1 1 8 2z" />
                            <path
                                d="M8 4.466V.534a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384L8.41 4.658A.25.25 0 0 1 8 4.466" />
                        </svg>
                        {{-- @php
                            $payment = $mahasiswa_paymants->firstWhere('biaya_id', $biaya->id);
                        @endphp --}}

                        @php
                            $payment = $mahasiswa_paymants
                                ->where('biaya_id', $biaya->id)
                                ->sortByDesc('id')
                                ->first();
                        @endphp
                    

                        @if ($payment)
                            {{ $payment->status }}
                        @else
                            Belum Dibayarkan
                        @endif


                    </span>
                    <div class="flex items-center justify-between gap-3 mt-3">
                        <h1 class="font-sora font-semibold text-xl">Rp {{ number_format($biaya->nominal, 0, ',', '.') }}
                        </h1>
                        {{-- @php
                            $payment = $mahasiswa_paymants->firstWhere('biaya_id', $biaya->id);
                        @endphp --}}

                        @php
                            $payment = $mahasiswa_paymants
                                ->where('biaya_id', $biaya->id)
                                ->sortByDesc('id')
                                ->first();
                        @endphp

                        @if ($payment)
                            @if ($payment->status == 'pending')
                                <a href="{{ route('paymant.status', ['merchantOrderId' => $payment->merchant_order_id]) }}"
                                    class="bg-primary text-white py-2 px-3 rounded-md text-center animate-pulse-glow">Cek Status Pembayaran</a>
                            @elseif ($payment->status == 'FAILED' || $payment->status == 'EXPIRED')
                                <a href="{{ route('retry.paymant', ['id' => $payment->id]) }}"
                                    class="bg-primary text-white py-2 px-3 rounded-md text-center">Ulangi Pembayaran</a>
                            @else
                                <a href="{{ route('invoice', $payment->id) }}"
                                class="bg-primary hover:bg-primary-hover py-2 px-3 rounded-md text-white">Lihat Invoice</a>
                            @endif
                        @else
                            <a href="{{ route('paymant.show', $biaya->id) }}"
                                class="bg-primary hover:bg-primary-hover py-2 px-3 rounded-md text-white">Bayarkan</a>
                        @endif

                    </div>
                </div>
            @endforeach
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
