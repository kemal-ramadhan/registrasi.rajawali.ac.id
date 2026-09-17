@extends('admin.template.template', ['title' => 'Pembayaran Mahasiswa'])

@section('content')
    <table class="w-full border-collapse border border-gray-300">
        <tr class="border-b border-gray-300">
            <td class="p-3 font-semibold bg-gray-100" colspan="2">Riwayat Pembayaran</td>
        </tr>
        <tr class="border-b border-gray-300">
            <td class="p-3 font-semibold bg-gray-100">NIM</td>
            <td class="p-3">{{ $mahasiswa_paymant->mahasiswa->nim }}</td>
        </tr>
        <tr class="border-b border-gray-300">
            <td class="p-3 font-semibold bg-gray-100">Nama Lengkap</td>
            <td class="p-3">{{ $mahasiswa_paymant->mahasiswa->user->name }}</td>
        </tr>
        <tr class="border-b border-gray-300">
            <td class="p-3 font-semibold bg-gray-100">Pembayaran</td>
            <td class="p-3">{{ $mahasiswa_paymant->biaya->biaya }}</td>
        </tr>
        <tr class="border-b border-gray-300">
            <td class="p-3 font-semibold bg-gray-100">Order ID</td>
            <td class="p-3">{{ $mahasiswa_paymant->merchant_order_id }}</td>
        </tr>
        <tr class="border-b border-gray-300">
            <td class="p-3 font-semibold bg-gray-100">Metode Pembayaran</td>
            <td class="p-3">{{ $mahasiswa_paymant->payment_method }}</td>
        </tr>
        <tr class="border-b border-gray-300">
            <td class="p-3 font-semibold bg-gray-100">Nominal</td>
            <td class="p-3">Rp. {{ number_format($mahasiswa_paymant->amount, 0, ',', '.') }}</td>
        </tr>
        <tr class="border-b border-gray-300">
            <td class="p-3 font-semibold bg-gray-100">Status</td>
            <td class="p-3">
                <form id="myForm" action="{{ route('mahasiswa-paymant.update', $mahasiswa_paymant->id) }}" method="post"
                    class="grid grid-cols-2 gap-3">
                    @csrf
                    @method('PUT')
                    <select name="status"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-primary focus:border-primary bg-white text-gray-700">

                        <!-- Opsi 1: Status saat ini -->
                        <option value="{{ $mahasiswa_paymant->status }}" selected>{{ $mahasiswa_paymant->status }}</option>
                        <option value="SUCCESS">SUCCESS</option>
                        <option value="FAILED">FAILED</option>

                    </select>

                    <button type="button" onclick="confirmSubmit()" class="py-2 px-3 bg-primary rounded-lg text-white">Ubah
                        Paksa Status</button>
                </form>
            </td>
        </tr>
    </table>

    <script>
        function confirmSubmit() {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Status akan diubah secara permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, ubah!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('myForm').submit();
                }
            })
        }
    </script>
@endsection
