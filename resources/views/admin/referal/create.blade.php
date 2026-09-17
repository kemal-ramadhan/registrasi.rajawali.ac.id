@extends('admin.template.template', ['title' => 'Tambah Kode Referal'])

@section('content')
    <div class="bg-white p-5 rounded-2xl flex flex-col gap-5">
        <form action="{{ route('referal.store') }}" method="post" id="myForm" enctype="multipart/form-data">
            @csrf
            <h1 class="font-sora text-lg font-semibold">Pengaruran Kode Referal</h1>
            <hr class="my-5">
            <div class="flex flex-col mb-3">
                <label for="user_id" class="font-sora font-semibold">Penanggung Jawab</label>
                <small class="font-sora mb-3"><i>Penanggung Jawab</i></small>

                <select name="user_id" id="user_id"
                    class="py-2 px-5 border border-gray-500 w-full rounded-md my-2 bg-transparent select2">
                    <option value="">Pilih Penanggung Jawab</option>

                    @foreach ($users as $user)
                        <option value="{{ $user->id }}">
                            {{ $user->name }} - {{ $user->email }}
                        </option>
                    @endforeach
                </select>

                @error('user_id')
                    <div>
                        <small class="text-red-500"><i>{{ $message }}</i></small>
                    </div>
                @enderror
            </div>
            <div class="grid grid-cols-1 md:grid-cols-1 gap-5 my-5">
                <div class="flex flex-col gap-3 mb-3">
                    <label for="name" class="font-sora font-semibold">Nama Institusi</label>
                    <input type="text" name="institution" placeholder="Example : SMKN 1 Tasik" required
                        class="px-4 py-2 border rounded-xl outline outline-1 h-10 outline-primary">
                    @error('institution')
                        <div>
                            <small class="text-red-500"><i>{{ $message }}</small>
                        </div>
                    @enderror
                </div>
                <div class="flex flex-col gap-3 mb-3">
                    <label for="name" class="font-sora font-semibold">Code Referensi</label>
                    <input type="text" name="code" placeholder="Example : bksmkn1tasik" required
                        class="px-4 py-2 border rounded-xl outline outline-1 h-10 outline-primary">
                    @error('code')
                        <div>
                            <small class="text-red-500"><i>{{ $message }}</small>
                        </div>
                    @enderror
                </div>
                <div class="flex flex-col gap-3 mb-3">
                    <label for="name" class="font-sora font-semibold">Code Pembayaran Siswa</label>
                    <input type="text" name="code_pembayaran" placeholder="Example : bksmkn1tasik"
                        class="px-4 py-2 border rounded-xl outline outline-1 h-10 outline-primary">
                    @error('code_pembayaran')
                        <div>
                            <small class="text-red-500"><i>{{ $message }}</small>
                        </div>
                    @enderror
                </div>
                <div class="flex flex-col gap-3 mb-3">
                    <label for="name" class="font-sora font-semibold">Status</label>
                    <select name="status" id="status" class="border rounded-xl outline outline-1 h-10 outline-primary">
                        <option value="active" selected>active</option>
                        <option value="non-active">non active</option>
                    </select>
                    @error('status')
                        <div>
                            <small class="text-red-500"><i>{{ $message }}</small>
                        </div>
                    @enderror
                </div>
                <div class="flex flex-col gap-3 mb-3">
                    <label for="name" class="font-sora font-semibold">Deskripsi</label>
                    <textarea name="description" id="description" cols="30" rows="10"
                        class="px-4 py-2 border rounded-xl outline outline-1 outline-primary"></textarea>
                    @error('description')
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

    <script>
        $(document).ready(function() {
            $('#user_id').select2({
                placeholder: "Pilih Penanggung Jawab",
                allowClear: true,
                width: '100%',
            });
        });
    </script>
@endsection
