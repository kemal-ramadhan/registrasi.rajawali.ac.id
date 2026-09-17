@extends('admin.template.template', ['title' => 'Biaya Perkuliahan'])

@section('content')
    <div class="bg-white rounded-2xl p-5">
        <div class="flex items-center justify-between gap-3">
            <h1 class="font-sora font-semibold">{{ $biaya->biaya }}</h1>
            <div class="flex items-center gap-3">
                <a href="{{ route('biayareferensi.edit', $biaya->id) }}"
                    class="px-2 py-1 flex font-thin bg-primary text-white rounded-md">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-pencil-square w-3"
                        viewBox="0 0 16 16">
                        <path
                            d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                        <path fill-rule="evenodd"
                            d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                    </svg>
                    <span class="ml-2">Edit Biaya</span>
                </a>
                <button type="button"
                    class="px-2 py-1 flex font-thin bg-red-600 text-white rounded-md hover:bg-red-700 btn-delete"
                    data-id="{{ $biaya->id }}">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-trash w-3" viewBox="0 0 16 16">
                        <path
                            d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5.5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6zm2 .5a.5.5 0 0 1 1 0v6a.5.5 0 0 1-1 0V6z" />
                        <path fill-rule="evenodd"
                            d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1 0-2H5.118a1 1 0 0 1 .876-.479h4.012a1 1 0 0 1 .876.479H14.5a1 1 0 0 1 0 2H14v1h-.5V4h-.5V3h1zm-1 1v9a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V4h9z" />
                    </svg>
                    <span class="ml-2">Hapus</span>
                </button>

                <!-- Form untuk delete (disembunyikan) -->
                <form id="form-delete-{{ $biaya->id }}" action="{{ route('biayareferensi.destroy', $biaya->id) }}"
                    method="POST" style="display: none;">
                    @csrf
                    @method('DELETE')
                </form>

            </div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-4 gap-5 my-3">
            <div class="flex items-center gap-3 bg-opacity-10 bg-primary shadow-sm p-2 rounded-md">
                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-exclamation-circle w-3 h-3"
                    viewBox="0 0 16 16">
                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16" />
                    <path
                        d="M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0M7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0z" />
                </svg>
                <span class="font-sora text-xs">Rp {{ number_format($biaya->nominal, 0, ',', '.') }}</span>
            </div>
            <div class="flex items-center gap-3 bg-opacity-10 bg-primary shadow-sm p-2 rounded-md">
                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-exclamation-circle w-3 h-3"
                    viewBox="0 0 16 16">
                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16" />
                    <path
                        d="M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0M7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0z" />
                </svg>
                <span class="font-sora text-xs">{{ $biaya->type }}</span>
            </div>
            <div class="flex items-center gap-3 bg-opacity-10 bg-primary shadow-sm p-2 rounded-md">
                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-exclamation-circle w-3 h-3"
                    viewBox="0 0 16 16">
                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16" />
                    <path
                        d="M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0M7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0z" />
                </svg>
                <span class="font-sora text-xs">{{ $biaya->status }}</span>
            </div>
            <div class="flex items-center gap-3 bg-opacity-10 bg-primary shadow-sm p-2 rounded-md">
                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-exclamation-circle w-3 h-3"
                    viewBox="0 0 16 16">
                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16" />
                    <path
                        d="M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0M7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0z" />
                </svg>
                <span class="font-sora text-xs">{{ $biaya->tengat_akhir }}</span>
            </div>
        </div>
        <div class="prose my-3 text-xs w-full">
            {!! $biaya->description !!}
        </div>
    </div>

    @if ($biaya->type == 'Angsuran')
    <div class="bg-white p-5 rounded-2xl w-full flex flex-col gap-3">
        <div x-data="{ showModal: false }">

            <div class="flex items-center justify-between gap-3">
                <h1 class="font-sora font-semibold">Scema Angsuran</h1>
                <a href="{{ route('biaya.scema', $biaya->id) }}"
                    class="bg-primary hover:bg-primary-hover py-2 px-3 rounded-md text-white">Tambah Scema
                    Angsuran</a>
            </div>

        </div>
        <hr class="my-3">
        @forelse ($scema_cicilans as $scema)
            <a href="{{ route('biaya.scema.detail', $scema->id) }}">
                <div
                    class="relative overflow-hidden flex flex-col gap-3 outline outline-1 outline-gray-200 p-5 rounded-2xl bg-primary text-white hover:bg-primary-hover hover:text-white hover:shadow-lg">
                    <img src="{{ asset('assets/icons/outline.png') }}" alt="outline"
                        class="w-40 absolute -top-5 -right-20">
                    <h1 class="font-sora font-semibold">Jumlah Scema CIcilan : {{ $scema->jumlah_cicilan }}x</h1>
                    <div class="flex gap-3 items-center">
                        <small class="font-sora font-light p-2 bg-white rounded-md text-primary">Potongan/ Beefit : {{ $scema->potongan }}</small>
                        <small class="font-sora font-light p-2 bg-white rounded-md text-primary"> Status : {{ $scema->status }}</small>
                    </div>
                    <small class="font-sora font-light">{!! $scema->description !!}</small>
                </div>
            </a>
        @empty
            <div class="flex flex-col items-start gap-3 mx-auto">
                <img src="{{ asset('assets/icons/empty_data.svg') }}" class="w-72 mx-auto" alt="empty">
                <h1 class="font-sora font-semibold my-3">Soal belum ada, klik tombol '+ Tambah Scema Angsuran' untuk
                    menambahkan
                    angsuran
                    baru!</h1>
            </div>
        @endforelse
    </div>
    @endif

    <script>
        document.querySelectorAll('.btn-delete').forEach(button => {
            button.addEventListener('click', function() {
                const biayaId = this.dataset.id;

                Swal.fire({
                    title: 'Yakin ingin menghapus?',
                    text: "Data yang dihapus tidak bisa dikembalikan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#e3342f',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById(`form-delete-${biayaId}`).submit();
                    }
                });
            });
        });
    </script>
@endsection
