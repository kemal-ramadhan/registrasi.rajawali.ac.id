@extends('customer.template.template', ['title' => 'Menu Utama', 'menu' => 'pendaftaran'])

@section('content')
    <div class="w-full">
        <div class="w-full">
            {{-- Breadcrumb --}}
            <div class="w-full bg-white md:flex items-center p-5 rounded-2xl outline outline-1 outline-gray-200 mb-5">
                <div class="flex gap-2">
                    <small class="font-sora flex gap-2">
                        <span>
                            <a href="{{ route('registration.option', ['id' => $programOption->id]) }}" class="font-bold text-primary">Pendaftaran / </a>
                            <a href="{{ route('registration.option.paymant', ['id' => $programOption->id]) }}" class="font-bold text-primary">Pembayaran / </a>
                            <a href="{{ route('registration.option.document', ['id' => $programOption->id]) }}" class="">Persyaratan / </a>
                            <a href="{{ route('registration.option.test', ['id' => $programOption->id]) }}" class="">Kartu Peserta </a>
                        </span>
                    </small>
                </div>
            </div>

            {{-- kontent --}}
            <div
                class="md:col-span-6 p-5 bg-white outline outline-1 outline-gray-200 rounded-3xl flex flex-col gap-2 items-center justify-center">
                <div class="flex flex-col gap-2 items-center justify-center text-center w-full">
                    <img src="{{ asset('assets/icons/paymant.svg') }}" alt="paymant" class="w-20">
                    <h1 class="font-sora font-semibold text-lg">Informasi Status Pembayaran</h1>
                    <small class="font-sora font-thin">Silahkan Lakukan Pengecekan berkala, jika kesulitan silahkan hubungi admin.</small>
                    <div class="flex flex-col gap-5 items-center justify-center">
                        <span class="font-sora font-semibold text-lg">Rp.
                            {{ number_format($result['amount'], 0, ',', '.') }}</span>
                        <small class="font-sora font-thin"><span
                                class="{{ $result['statusMessage'] === 'SUCCESS' ? 'bg-green-500' : 'bg-red-500' }} bg-red-400 text-white py-1 px-3 rounded-md">{{ $result['statusMessage'] }}</span></small>
                                <div class="flex gap-2 items-center">
                                    <a href="{{ route('registration.option.paymant', ['id' => $programOption->id]) }}" class="bg-gray-100 text-primary outline outline-1 outline-primary py-2 px-3 rounded-md text-center">
                                      Kembali
                                    </a>
                                    <a href="{{ route('transaction.status', ['merchantOrderId' => $result['merchantOrderId']]) }}" class="bg-primary text-white py-2 px-3 rounded-md text-center flex gap-2 items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-arrow-clockwise w-3" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M8 3a5 5 0 1 0 4.546 2.914.5.5 0 0 1 .908-.417A6 6 0 1 1 8 2z"/>
                                        <path d="M8 4.466V.534a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384L8.41 4.658A.25.25 0 0 1 8 4.466"/>
                                      </svg>
                                      Refresh
                                    </a>
                                </div>
                    </div>
                    @if (isset($error))
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative"
                            role="alert">
                            <strong class="font-bold">Terjadi Kesalahan:</strong>
                            <span class="block sm:inline">{{ $error }}</span>
                        </div>
                    @elseif(isset($result))
                        <div class="overflow-x-auto mt-6">
                            <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow">
                                <tbody>
                                    <tr class="bg-gray-100 border-b">
                                        <th class="text-left px-6 py-4 font-semibold text-gray-700">Order ID</th>
                                        <td class="px-6 py-4 text-gray-900">{{ $result['merchantOrderId'] }}</td>
                                    </tr>
                                    <tr class="border-b">
                                        <th class="text-left px-6 py-4 font-semibold text-gray-700">Reference</th>
                                        <td class="px-6 py-4 text-gray-900">{{ $result['reference'] }}</td>
                                    </tr>
                                    <tr class="bg-gray-100 border-b">
                                        <th class="text-left px-6 py-4 font-semibold text-gray-700">Jumlah</th>
                                        <td class="px-6 py-4 text-gray-900">Rp
                                            {{ number_format($result['amount'], 0, ',', '.') }}</td>
                                    </tr>
                                    <tr class="border-b">
                                        <th class="text-left px-6 py-4 font-semibold text-gray-700">Biaya Admin</th>
                                        <td class="px-6 py-4 text-gray-900">Rp
                                            {{ number_format($result['fee'], 0, ',', '.') }}</td>
                                    </tr>
                                    <tr>
                                        <th class="text-left px-6 py-4 font-semibold text-gray-700">Pesan Status</th>
                                        <td class="px-6 py-4 text-gray-900">{{ $result['statusMessage'] }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>

            </div>
        </div>
    </div>
@endsection
