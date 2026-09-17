@extends('admin.template.template', ['title' => 'Riwayat Pembayaran'])

@section('content')
<div class="bg-white p-5 rounded-2xl flex flex-col gap-5">
    <div class="flex items-center justify-between">
        <h1 class="font-sora font-semibold">Data Riwayat Pembayaran</h1>
        <form method="GET" action="{{ route('pembayaran.index') }}" class="flex gap-2">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari..." class="px-4 py-2 min-w-[300px] border rounded-md outline outline-1 outline-primary">
            <div class="flex gap-1">
                <button type="submit" class="p-3 bg-primary rounded-md hover:bg-gray-900 text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-search w-3" viewBox="0 0 16 16">
                        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
                      </svg>
                </button>
            </div>
        </form>
    </div>
    
    <div class="w-full overflow-x-auto">
        <table class="w-full border-collapse border border-gray-300 min-w-max">
            <thead>
                <tr>
                    <th class="border border-gray-300 px-4 py-2">#</th>
                    <th class="border border-gray-300 px-4 py-2">Nama Lengkap</th>
                    <th class="border border-gray-300 px-4 py-2">Email</th>
                    <th class="border border-gray-300 px-4 py-2">Program</th>
                    <th class="border border-gray-300 px-4 py-2">Merchant Order ID</th>
                    <th class="border border-gray-300 px-4 py-2">Metode Pembayaran</th>
                    <th class="border border-gray-300 px-4 py-2">Jumlah</th>
                    <th class="border border-gray-300 px-4 py-2">Status</th>
                    <th class="border border-gray-300 px-4 py-2">Tanggal</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($payments as $payment)
                    <tr>
                        <td class="border border-gray-300 px-4 py-2">{{ $loop->iteration }}</td>
                        <td class="border border-gray-300 px-4 py-2 whitespace-nowrap">{{ $payment->user->name ?? '-' }}</td>
                        <td class="border border-gray-300 px-4 py-2 whitespace-nowrap">{{ $payment->user->email ?? '-' }}</td>
                        <td class="border border-gray-300 px-4 py-2 whitespace-nowrap">{{ $payment->programOption->name ?? '-' }}</td>
                        <td class="border border-gray-300 px-4 py-2 whitespace-nowrap">{{ $payment->merchant_order_id }}</td>
                        <td class="border border-gray-300 px-4 py-2 whitespace-nowrap">{{ $payment->payment_method }}</td>
                        <td class="border border-gray-300 px-4 py-2 whitespace-nowrap">Rp {{ number_format($payment->amount, 0, ',', '.') }}</td>
                        <td class="border border-gray-300 px-4 py-2 whitespace-nowrap">{{ ucfirst($payment->status) }}</td>
                        <td class="border border-gray-300 px-4 py-2 whitespace-nowrap">{{ $payment->created_at->format('d M Y') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center border border-gray-300 px-4 py-2">Data tidak ditemukan</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    <div class="">
        {{ $payments->appends(['search' => request('search')])->links() }}
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const deleteButtons = document.querySelectorAll(".btn-delete");

        deleteButtons.forEach(button => {
            button.addEventListener("click", function () {
                const form = this.closest("form");

                Swal.fire({
                    title: "Apakah Anda yakin?",
                    text: "Data akan dihapus secara permanen!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#d33",
                    cancelButtonColor: "#3085d6",
                    confirmButtonText: "Ya, hapus!",
                    cancelButtonText: "Batal"
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    });
</script>

    
@endsection