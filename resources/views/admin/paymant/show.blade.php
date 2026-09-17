@extends('admin.template.template', ['title' => 'Pembayaran Mahasiswa'])

@section('content')
    <div class="w-full grid grid-cols-1 md:grid-cols-3 items-center gap-5">
        @foreach ($biayas as $biaya)
            @php
                $payment = $mahasiswa_paymants->firstWhere('biaya_id', $biaya->id);
            @endphp
            <div class="bg-white rounded-2xl p-5 text-xs flex flex-col gap-3">
                <h1 class="font-sora font-semibold">{{ $biaya->biaya }}</h1>
                <small class="prose text-xs">{!! $biaya->description !!}</small>

                <span class="flex gap-3 items-center text-xs">
                    <!-- ikon dan tipe -->
                    {{ $biaya->type }}
                </span>

                <span class="flex gap-3 items-center text-xs">
                    <!-- ikon dan tenggat -->
                    Wajib Dibayarkan Sebelum tanggal {{ $biaya->tengat_akhir }}
                </span>

                <span class="flex gap-3 items-center text-xs">
                    <!-- ikon status -->
                    @if ($payment)
                        {{ $payment->status }}
                    @else
                        Belum Dibayarkan
                    @endif
                </span>

                <div class="flex items-center justify-between gap-3 mt-3">
                    <h1 class="font-sora font-semibold text-xl">Rp {{ number_format($biaya->nominal, 0, ',', '.') }}</h1>
                    @if ($payment)
                        <a href="{{ route('mahasiswa-paymant.edit', $payment->id) }}"
                            class="bg-primary hover:bg-primary-hover py-2 px-3 rounded-md text-white">
                            Lihat Detail Pembayaran
                        </a>
                    @else
                        Belum Dibayarkan
                    @endif
                </div>
            </div>
        @endforeach

    </div>
@endsection
