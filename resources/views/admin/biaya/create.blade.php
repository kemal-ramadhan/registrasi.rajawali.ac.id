@extends('admin.template.template', ['title' => 'Tambah Biaya Perkuliahan'])

@section('content')
<div class="bg-white p-5 rounded-2xl">
    <form action="{{ route('biayareferensi.store') }}" method="post" id="myForm" enctype="multipart/form-data">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5 my-5">
            <div class="flex flex-col gap-3 mb-3">
                <label for="biaya" class="font-sora font-semibold">Nama Biaya</label>
                <input type="text" name="biaya" placeholder="DPP, PKMBB" required
                    class="px-4 py-2 border rounded-md outline outline-1 h-10 outline-primary">
                @error('biaya')
                    <div>
                        <small class="text-red-500"><i>{{ $message }}</small>
                    </div>
                @enderror
            </div>
            <div class="flex flex-col gap-3 mb-3">
                <label for="nominal" class="font-sora font-semibold">Nominal</label>
                <input type="text" name="nominal" placeholder="000" required
                    class="px-4 py-2 border rounded-md outline outline-1 h-10 outline-primary">
                @error('nominal')
                    <div>
                        <small class="text-red-500"><i>{{ $message }}</small>
                    </div>
                @enderror
            </div>
            <div class="flex flex-col gap-3 mb-3">
                <label for="type" class="font-sora font-semibold">Type Pembayaran</label>
                <select name="type" id="type" class="border rounded-md outline outline-1 h-10 outline-primary">
                    <option value="Tunai" selected>Tunai</option>
                    {{-- <option value="Angsuran">Angsuran</option> --}}
                </select>
                @error('type')
                    <div>
                        <small class="text-red-500"><i>{{ $message }}</small>
                    </div>
                @enderror
            </div>
            <div class="flex flex-col gap-3 mb-3">
                <label for="tengat_akhir" class="font-sora font-semibold">Tengat Terakhir Pembayaran</label>
                <input type="date" name="tengat_akhir" placeholder="000" required
                    class="px-4 py-2 border rounded-md outline outline-1 h-10 outline-primary">
                @error('tengat_akhir')
                    <div>
                        <small class="text-red-500"><i>{{ $message }}</small>
                    </div>
                @enderror
            </div>
            <div class="flex flex-col gap-3 mb-3 col-span-2">
                <label for="name" class="font-sora font-semibold">Deskripsi Program Studi Departement</label>
                <textarea name="description" id="description" cols="30" rows="10"
                    class="px-4 py-2 border rounded-md outline outline-1 outline-primary"></textarea>
                @error('description')
                    <div>
                        <small class="text-red-500"><i>{{ $message }}</small>
                    </div>
                @enderror
            </div>
            <div class="flex flex-col gap-3 mb-3 md:col-span-2">
                <label for="name" class="font-sora font-semibold">Status</label>
                <select name="status" id="status" class="border rounded-md outline outline-1 h-10 outline-primary">
                    <option value="Draf" selected>Draf</option>
                    <option value="Publish">Publish</option>
                </select>
                @error('status')
                    <div>
                        <small class="text-red-500"><i>{{ $message }}</small>
                    </div>
                @enderror
            </div>

        </div>
        <div class="flex items-center justify-end gap-3">
            <button type="button" id="submitBtn"
                class="py-3 px-5 text-center bg-primary text-white font-sora font-semibold rounded-lg">Simpan</button>
        </div>
    </form>
</div>


    <script>
        document.getElementById('submitBtn').addEventListener('click', function(e) {
            Swal.fire({
                title: "Apakah Anda yakin?",
                text: "Data akan disimpan!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya, Simpan!",
                cancelButtonText: "Batal"
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('myForm').submit(); // Ganti dengan ID form kamu
                }
            });
        });
    </script>
@endsection
