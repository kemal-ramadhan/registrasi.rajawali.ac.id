@extends('admin.template.template', ['title' => 'Tambah Proses Seleksi Baru'])

@section('content')
    <style>
        /* Styling untuk wrapper Select2 */
        .select2-container .select2-selection--single {
            height: 40px;
            /* setara dengan h-10 */
            padding: 0 1rem;
            /* setara dengan px-4 */
            border: 1px solid #3b82f6;
            /* setara dengan outline-primary (biru Tailwind) */
            border-radius: 0.75rem;
            /* setara dengan rounded-md */
            display: flex;
            align-items: center;
            box-sizing: border-box;
        }

        /* Styling untuk text di dalam pilihan */
        .select2-container .select2-selection--single .select2-selection__rendered {
            color: #111827;
            /* setara dengan text-gray-900 */
            line-height: 40px;
        }

        /* Hapus border default dan outline saat focus */
        .select2-container--default .select2-selection--single:focus,
        .select2-container--default .select2-selection--single:focus-visible {
            outline: none;
            box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.5);
            /* mirip efek focus Tailwind */
        }

        /* Panah dropdown */
        .select2-container .select2-selection--single .select2-selection__arrow {
            height: 100%;
            right: 10px;
        }
    </style>
    <form action="{{ route('exam.update', $exam->id) }}" method="post" id="myForm" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="bg-white p-5 rounded-2xl">
            <div class="grid md:grid-cols-2 grid-cols-1 gap-5">
                <div class="flex flex-col gap-3 mb-3">
                    <label for="name" class="font-sora font-semibold">Jalur Pendaftaran</label>
                    <select name="registration_path_id" id="pendaftar_id"
                        class="js-example-basic-single form-control px-4 py-2 border rounded-md outline outline-1 h-10 outline-primary"
                        style="width: 100%;">
                        @foreach ($registrations as $item)
                        @if ($exam->registration_path_id == $item->id)
                        <option value="{{ $item->id }}" selected>{{ $item->name }} - {{ $item->title }}</option>
                        @endif
                            <option value="{{ $item->id }}">{{ $item->name }} - {{ $item->title }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex flex-col gap-3 mb-3">
                    <label for="name" class="font-sora font-semibold">Nama Test</label>
                    <input type="text" name="name" placeholder="Name of test" required value="{{ $exam->name }}"
                        class="px-4 py-2 border rounded-md outline outline-1 h-10 outline-primary">
                    @error('name')
                        <div>
                            <small class="text-red-500"><i>{{ $message }}</small>
                        </div>
                    @enderror
                </div>
                <div class="flex flex-col gap-3 mb-3">
                    <label for="start_date" class="font-sora font-semibold">Tanggal Mulai</label>
                    <input type="datetime-local" name="start_date" placeholder="Name of test" required value="{{ $exam->start_date }}"
                        class="px-4 py-2 border rounded-md outline outline-1 h-10 outline-primary">
                    @error('start_date')
                        <div>
                            <small class="text-red-500"><i>{{ $message }}</small>
                        </div>
                    @enderror
                </div>
                <div class="flex flex-col gap-3 mb-3">
                    <label for="duration" class="font-sora font-semibold">Durasi Test</label>
                    <input type="text" name="duration" placeholder="Durasi" required value="{{ $exam->duration }}"
                        class="px-4 py-2 border rounded-md outline outline-1 h-10 outline-primary">
                    @error('duration')
                        <div>
                            <small class="text-red-500"><i>{{ $message }}</small>
                        </div>
                    @enderror
                </div>
                <div class="flex flex-col gap-3 mb-3 md:col-span-2">
                    <label for="description" class="font-sora font-semibold">description</label>
                    <textarea name="description" id="description" class="block w-full mt-1 text-sm border-gray-300 border-2 p-2 rounded-md">{{ $exam->description }}</textarea>
                        @error('description')
                            <div>
                                <small class="text-red-500"><i>{{ $message }}</i></small>
                            </div>
                        @enderror
                </div>
                <div class="flex flex-col gap-3">
                    <label for="pengerjaan" class="font-sora font-semibold">Status Pengerjaan</label>
                    <select name="pengerjaan" id="pengerjaan"
                        class="border rounded-md outline outline-1 h-10 outline-primary">
                        <option value="{{ $exam->pengerjaan }}" selected>{{ $exam->pengerjaan }}</option>
                        <option value="Terjadwal">Terjadwal</option>
                        <option value="Fleksibel">Fleksibel</option>
                    </select>
                    @error('pengerjaan')
                        <div>
                            <small class="text-red-500"><i>{{ $message }}</small>
                        </div>
                    @enderror
                </div>
                <div class="flex flex-col gap-3">
                    <label for="pengerjaan_waktu" class="font-sora font-semibold">Waktu Pengerjaan (Jika Memilih Fleksible, Isi Dalam JAM)</label>
                    <input type="text" name="pengerjaan_waktu" placeholder="Durasi" required value="{{ $exam->pengerjaan_waktu }}"
                        class="px-4 py-2 border rounded-md outline outline-1 h-10 outline-primary">
                    @error('pengerjaan_waktu')
                        <div>
                            <small class="text-red-500"><i>{{ $message }}</small>
                        </div>
                    @enderror
                </div>
                <div class="flex flex-col gap-3 mb-3">
                    <label for="type" class="font-sora font-semibold">Type Seleksi</label>
                    <select name="type" id="type" class="border rounded-md outline outline-1 h-10 outline-primary">
                        <option value="{{ $exam->type }}" selected>{{ $exam->type }}</option>
                        <option value="CBT">CBT</option>
                        <option value="Lisan">Lisan</option>
                    </select>
                    @error('type')
                        <div>
                            <small class="text-red-500"><i>{{ $message }}</small>
                        </div>
                    @enderror
                </div>
                <div class="flex flex-col gap-3 mb-3">
                    <label for="name" class="font-sora font-semibold">Status</label>
                    <select name="status" id="status" class="border rounded-md outline outline-1 h-10 outline-primary">
                        <option value="{{ $exam->status }}" selected>{{ $exam->status }}</option>
                        <option value="Publish">Publish</option>
                        <option value="Draf">Draf</option>
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
                    class="py-3 px-5 text-center bg-primary text-white font-sora font-semibold rounded-lg">Perbaharui</button>
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
