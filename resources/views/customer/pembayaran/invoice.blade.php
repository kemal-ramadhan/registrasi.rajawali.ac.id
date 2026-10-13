@extends('customer.template.template', ['title' => 'Menu Utama', 'menu' => 'pembayaran'])
@section('content')
    <div class="bg-gray-50 py-10 px-4 sm:px-6 text-gray-800 rounded-2xl">
        <div class="max-w-4xl mx-auto bg-white p-4 sm:p-8 rounded-lg shadow">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-start mb-8 gap-4">
                <div>
                    <h2 class="text-2xl sm:text-3xl font-bold mb-2">INVOICE</h2>
                    <p class="text-sm text-gray-500">Billed to</p>
                    <p class="text-sm">Institut Kesehatan Rajawali</p>
                    <p class="text-sm">Jl. Letjen Mashudi No.20, Setiaratu,</p>
                    <p class="text-sm">Kec. Cibeureum, Kab. Tasikmalaya,</p>
                    <p class="text-sm">Jawa Barat 46196, (0265) 334740</p>
                </div>
                <div class="text-left sm:text-right">
                    <img src="{{ asset('assets/icons/IKes.png') }}" alt="Institut Kesehatan Rajawali" class="h-14 sm:ml-auto">
                    <p class="text-blue-600 font-semibold mt-2">Institut Kesehatan Rajawali</p>
                    <p class="text-sm">Jl. Letjen Mashudi No.20, Setiaratu,</p>
                    <p class="text-sm">Kec. Cibeureum, Kab. Tasikmalaya,</p>
                    <p class="text-sm">Jawa Barat 46196, (0265) 334740</p>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 text-sm mb-8 gap-6">
                <div class="space-y-4">
                    <div>
                        <p class="text-gray-500">Invoice #</p>
                        <p class="font-medium">{{ $invoice?->merchant_order_id ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-gray-500">On behalf of</p>
                        <p class="font-medium">
                            @if (!empty($mahasiswa?->nim) && !empty($mahasiswa?->user?->name))
                                {{ $mahasiswa->nim }} - {{ $mahasiswa->user->name }}
                            @elseif (!empty($customer?->name))
                                {{ $customer->name }}
                            @else
                                -
                            @endif
                        </p>
                    </div>
                </div>
                <div class="text-left sm:text-right space-y-4">
                    <div>
                        <p class="text-gray-500">Invoice date</p>
                        <p class="font-medium">{{ $invoice?->created_at ?? '-' }}</p>
                    </div>
                </div>
            </div>

            <div class="border rounded-lg overflow-x-auto">
                <table class="min-w-full text-sm text-left">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 sm:px-6 py-3 font-medium text-gray-500">Invoice</th>
                            <th class="px-4 sm:px-6 py-3 font-medium text-gray-500">Pembayaran</th>
                            <th class="px-4 sm:px-6 py-3 font-medium text-gray-500">Metode Pembayaran</th>
                            <th class="px-4 sm:px-6 py-3 font-medium text-gray-500">Status</th>
                            <th class="px-4 sm:px-6 py-3 font-medium text-gray-500">Nominal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border-t">
                            <td class="px-4 sm:px-6 py-4">{{ $invoice?->merchant_order_id ?? '-' }}</td>
                            <td class="px-4 sm:px-6 py-4">{{ $biaya?->biaya ?? '-' }}</td>
                            <td class="px-4 sm:px-6 py-4">{{ $paymentMethod?->method ?? '-' }}</td>
                            <td class="px-4 sm:px-6 py-4">{{ $invoice?->status ?? '-' }}</td>
                            <td class="px-4 sm:px-6 py-4">Rp {{ number_format($invoice?->amount ?? 0, 2, ',', '.') }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection