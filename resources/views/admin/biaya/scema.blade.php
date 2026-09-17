@extends('admin.template.template', ['title' => 'Tambah Biaya Perkuliahan'])

@section('content')
    <div class="bg-white p-5 rounded-2xl">
        <form action="{{ route('biaya.scema.store') }}" method="post" id="myForm" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="biaya_id" value="{{ $id }}">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5 my-5">
                <div class="flex flex-col gap-3 mb-3">
                    <label for="potongan" class="font-sora font-semibold">Potongan (isi dengan 0 jika tidak ada benefit)</label>
                    <input type="text" name="potongan" placeholder="0" required
                        class="px-4 py-2 border rounded-md outline outline-1 h-10 outline-primary">
                    @error('potongan')
                        <div>
                            <small class="text-red-500"><i>{{ $message }}</small>
                        </div>
                    @enderror
                </div>
                <div class="flex flex-col gap-3 mb-3">
                    <label for="jumlah_cicilan" class="font-sora font-semibold">Jumlah Angsuran</label>
                    <input type="text" name="jumlah_cicilan" placeholder="3" required
                        class="px-4 py-2 border rounded-md outline outline-1 h-10 outline-primary">
                    @error('jumlah_cicilan')
                        <div>
                            <small class="text-red-500"><i>{{ $message }}</small>
                        </div>
                    @enderror
                </div>
                <div class="flex flex-col gap-3 mb-3 md:col-span-2">
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
