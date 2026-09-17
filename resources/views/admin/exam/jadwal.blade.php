@extends('admin.template.template', ['title' => 'Tambah Jadwal Proses Seleksi Baru'])

@section('content')
    <form action="{{ isset($lisan) ? route('lisan.update', $lisan->id) : route('lisan.store') }}" method="POST"
        id="myForm">
        @csrf
        @if (isset($lisan))
            @method('PUT')
        @endif
        <input type="hidden" name="exams_id" value="{{ $id }}">
        <div class="bg-white p-5 rounded-2xl">
            <div class="grid md:grid-cols-2 grid-cols-1 gap-5">
                <div class="flex flex-col gap-3 mb-3">
                    <label for="media" class="font-sora font-semibold">Media Pertemuan</label>
                    <input type="text" name="media" placeholder="Media" required value="{{ $lisan->media ?? '' }}"
                        class="px-4 py-2 border rounded-md outline outline-1 h-10 outline-primary">
                    @error('media')
                        <div>
                            <small class="text-red-500"><i>{{ $message }}</small>
                        </div>
                    @enderror
                </div>
                <div class="flex flex-col gap-3 mb-3">
                    <label for="link" class="font-sora font-semibold">Link Pertemuan (Media Offline / Online)</label>
                    <input type="text" name="link" placeholder="Durasi" required value="{{ $lisan->link ?? '' }}"
                        class="px-4 py-2 border rounded-md outline outline-1 h-10 outline-primary">
                    @error('link')
                        <div>
                            <small class="text-red-500"><i>{{ $message }}</small>
                        </div>
                    @enderror
                </div>
                <div class="flex flex-col gap-3 mb-3 md:col-span-2">
                    <label for="description" class="font-sora font-semibold">description</label>
                    <textarea name="description" id="description" class="block w-full mt-1 text-sm border-gray-300 border-2 p-2 rounded-md">{{ $lisan->description ?? '' }}</textarea>
                    @error('description')
                        <div>
                            <small class="text-red-500"><i>{{ $message }}</i></small>
                        </div>
                    @enderror
                </div>
                <div class="flex flex-col gap-3 mb-3 md:col-span-2">
                    <label for="name" class="font-sora font-semibold">Status</label>
                    <select name="status" id="status" class="border rounded-md outline outline-1 h-10 outline-primary">
                        @php
                        $selectedStatus = $lisan->status ?? null;
                        @endphp

                        <option value="Publish" {{ $selectedStatus == 'Publish' ? 'selected' : '' }}>Publish</option>
                        <option value="Draf" {{ $selectedStatus == 'Draf' ? 'selected' : '' }}>Draf</option>

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
        </div>
    </form>


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
        $('.js-example-basic-single').select2({
            placeholder: 'Select an option',
        });
    </script>
@endsection
