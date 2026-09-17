@extends('admin.template.template', ['title' => 'Tambah Proses Seleksi Baru'])

@section('content')
    <div class="bg-white p-5 rounded-2xl w-full">
        <div class="flex items-center justify-between gap-3">
            <h1 class="font-sora font-semibold">{{ $exam->name }}</h1>
            <div class="flex items-center gap-3">
                <a href="{{ route('exam.edit', $exam->id) }}"
                    class="px-2 py-1 flex font-thin bg-primary text-white rounded-md">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-pencil-square w-3"
                        viewBox="0 0 16 16">
                        <path
                            d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                        <path fill-rule="evenodd"
                            d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                    </svg>
                    <span class="ml-2">Edit Head</span>
                </a>
                <!-- Tombol Delete -->
                <button type="button" onclick="confirmDelete({{ $exam->id }})"
                    class="px-2 py-1 flex items-center font-thin bg-red-600 hover:bg-red-700 text-white rounded-md">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-trash w-3" viewBox="0 0 16 16">
                        <path
                            d="M5.5 5.5a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0v-6a.5.5 0 0 1 .5-.5zm2.5.5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0v-6zm2.5-.5a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0v-6a.5.5 0 0 1 .5-.5z" />
                        <path fill-rule="evenodd"
                            d="M14.5 3a1 1 0 0 1-1 1H13v9.5A1.5 1.5 0 0 1 11.5 15h-7A1.5 1.5 0 0 1 3 13.5V4h-.5a1 1 0 0 1 0-2H5a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1h1.5a1 1 0 0 1 1 1zm-3.5 1v9.5a.5.5 0 0 0 .5.5h-7a.5.5 0 0 0 .5-.5V4h6z" />
                    </svg>
                    <span class="ml-2">Hapus</span>
                </button>

                <!-- Form tersembunyi untuk dikirim via JS -->
                <form id="delete-form-{{ $exam->id }}" action="{{ route('exam.destroy', $exam->id) }}" method="POST"
                    class="hidden">
                    @csrf
                    @method('DELETE')
                </form>
            </div>
        </div>
        <hr class="my-3">
        <div class="prose my-3 text-xs w-full">
            {!! $exam->description !!}
        </div>
        <hr class="my-3">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
            <div class="p-3 outline outline-1 outline-primary rounded-md text-center flex flex-col gap-2">
                <span>Tanggal Pelaksanaan</span>
                <h1 class="font-sora font-semibold text-2xl">
                    {{ \Carbon\Carbon::parse($exam->start_date)->translatedFormat('d F Y, H:i') }} WIB
                </h1>
            </div>
            <div class="p-3 outline outline-1 outline-primary rounded-md text-center flex flex-col gap-2">
                <span>Durasi Pelaksanaan</span>
                <h1 class="font-sora font-semibold text-2xl">
                    {{ $exam->duration }} Menit</h1>
            </div>
            <div class="p-3 outline outline-1 outline-primary rounded-md text-center flex flex-col gap-2">
                <span>Status</span>
                <h1 class="font-sora font-semibold text-2xl">
                    {{ $exam->status }}</h1>
            </div>
        </div>
    </div>

    @if ($lisan)
        <div class="bg-white p-5 rounded-2xl w-full flex flex-col">
            <h2 class="text-2xl font-bold mb-4 text-gray-800">Detail Ujian Lisan</h2>

            <div class="mb-4">
                <p class="text-sm text-gray-500">Media</p>
                <p class="text-lg font-medium text-gray-900">{{ $lisan->media }}</p>
            </div>

            <div class="mb-4">
                <p class="text-sm text-gray-500">Link</p>
                <a href="{{ $lisan->link }}" target="_blank" class="text-blue-600 hover:underline">
                    {{ $lisan->link }}
                </a>
            </div>

            <div class="mb-4">
                <p class="text-sm text-gray-500">Deskripsi</p>
                <div class="prose text-xs">
                    {!! $lisan->description !!}
                </div>
            </div>

            <div class="mb-4">
                <p class="text-sm text-gray-500">Status</p>
                <span
                    class="inline-block px-3 py-1 text-sm rounded-full 
        {{ $lisan->status === 'Publish' ? 'bg-green-100 text-green-700' : 'bg-gray-200 text-gray-800' }}">
                    {{ $lisan->status }}
                </span>
            </div>

            <div class="grid grid-cols-2 gap-4 mb-6">
                <div>
                    <p class="text-sm text-gray-500">Tanggal Dibuat</p>
                    <p class="text-gray-700">{{ $lisan->created_at->format('d M Y H:i') }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Tanggal Diperbarui</p>
                    <p class="text-gray-700">{{ $lisan->updated_at->format('d M Y H:i') }}</p>
                </div>
            </div>

            <div class="flex space-x-3 my-5">
                <a href="{{ route('lisan.edit', $exam->id) }}" class="bg-primary hover:bg-primary-hover text-white py-2 px-3 rounded-md">Perbaharui Data</a>
            </div>
        </div>
    @else
        <div class="bg-white p-5 rounded-2xl w-full flex flex-col items-center justify-center">
            <img src="{{ asset('assets/icons/empty_data.svg') }}" class="w-72" alt="empty">
            <h1 class="font-sora font-semibold my-3">Jadwal Pertemuan Belum Di atur, klik tombol '+ Tambah Jadwal Baru'
                untuk menambahkan jadwal!</h1>
            <a href="{{ route('lisan.edit', $exam->id) }}"
                class="bg-primary hover:bg-primary-hover text-white py-2 px-3 rounded-md">+ Tambah Jadwal</a>
        </div>
    @endif

    <script>
        function confirmDelete(id) {
            Swal.fire({
                title: 'Yakin ingin menghapus?',
                text: "Data tidak bisa dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#e3342f',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + id).submit();
                }
            });
        }
    </script>
@endsection
