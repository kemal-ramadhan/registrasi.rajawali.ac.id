@extends('admin.template.template', ['title' => 'Biaya Perkuliahan'])

@section('content')
    <div class="bg-white rounded-2xl p-5">
        <div class="flex items-center justify-between gap-3">
            <a href="{{ route('biayareferensi.show', $biaya->id) }}" class="bg-gray-100 hover:bg-gray-200 p-2 rounded-md">
                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-arrow-left w-3" viewBox="0 0 16 16">
                    <path fill-rule="evenodd"
                        d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8" />
                </svg>
            </a>
            <div class="flex items-center gap-3">
                <a href="{{ route('biaya.scema.edit', $scema->id) }}"
                    class="px-2 py-1 flex font-thin bg-primary text-white rounded-md">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-pencil-square w-3"
                        viewBox="0 0 16 16">
                        <path
                            d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                        <path fill-rule="evenodd"
                            d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                    </svg>
                    <span class="ml-2">Edit Scema</span>
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
        <hr class="my-3">
        <div class="flex items-center justify-between gap-3">
            <h1 class="font-sora font-semibold">{{ $biaya->biaya }}</h1>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-5 my-3">
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
        </div>
        <div class="prose my-3 text-xs w-full">
            {!! $biaya->description !!}
        </div>
        <hr class="my-3">
        <div
            class="relative overflow-hidden flex flex-col gap-3 outline outline-1 outline-gray-200 p-5 rounded-2xl bg-primary text-white hover:bg-primary-hover hover:text-white hover:shadow-lg">
            <img src="{{ asset('assets/icons/outline.png') }}" alt="outline" class="w-40 absolute -top-5 -right-20">
            <h1 class="font-sora font-semibold">Jumlah Scema CIcilan : {{ $scema->jumlah_cicilan }}x</h1>
            <div class="flex gap-3 items-center">
                <small class="font-sora font-light p-2 bg-white rounded-md text-primary">Potongan/ Beefit :
                    {{ $scema->potongan }}</small>
                <small class="font-sora font-light p-2 bg-white rounded-md text-primary"> Status :
                    {{ $scema->status }}</small>
            </div>
            <small class="font-sora font-light">{!! $scema->description !!}</small>
        </div>
    </div>

    <div class="bg-white p-5 rounded-2xl w-full flex flex-col gap-3">
        <div x-data="{ showModal: false }">

            <div class="flex items-center justify-between gap-3">
                <h1 class="font-sora font-semibold">Scema Angsuran</h1>

                <!-- Trigger -->
                <a href="#" @click.prevent="showModal = true"
                    class="bg-primary hover:bg-primary-hover py-2 px-3 rounded-md text-white">
                    Tambah Scema Angsuran
                </a>
            </div>

            <!-- Modal -->
            <div x-show="showModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50"
                x-transition:enter="transition ease-out duration-200" x-transition:leave="transition ease-in duration-100">
                <div @click.away="showModal = false" class="bg-white p-6 rounded-lg shadow-md w-full max-w-md">
                    <h2 class="text-lg font-semibold mb-4">Tambah Scema Angsuran</h2>

                    <form action="{{ route('scema.detail.store') }}" method="post">
                        @csrf
                        <input type="hidden" name="scema_cicilan_id" value="{{ $scema->id }}">
                        <!-- Contoh input -->
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700">Cicilan Ke</label>
                            <input type="number" name="cicilan_ke"
                                class="w-full border border-gray-300 rounded px-3 py-2 mt-1" required>
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700">Nominal</label>
                            <input type="number" name="nominal"
                                class="w-full border border-gray-300 rounded px-3 py-2 mt-1" required>
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700">Tengat Pembayaran</label>
                            <input type="date" name="tengat"
                                class="w-full border border-gray-300 rounded px-3 py-2 mt-1" required>
                        </div>

                        <!-- Tombol -->
                        <div class="flex justify-end gap-2">
                            <button type="button" @click="showModal = false"
                                class="px-4 py-2 rounded bg-gray-300 hover:bg-gray-400">
                                Batal
                            </button>
                            <button type="submit" class="px-4 py-2 rounded bg-primary text-white hover:bg-primary-hover">
                                Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>

        <hr class="my-3">

        <div class="w-full">
            <div class="overflow-x-auto bg-white shadow-md rounded-lg">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-100 text-left text-gray-600 uppercase text-sm font-semibold">
                        <tr>
                            <th class="px-4 py-3">Cicilan Ke</th>
                            <th class="px-4 py-3">Nominal</th>
                            <th class="px-4 py-3">Tenggat</th>
                            <th class="px-4 py-3">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 text-sm">
                        @forelse($details as $index => $cicilan)
                            <tr>
                                <td class="px-4 py-2 text-xs">{{ $cicilan->cicilan_ke }}</td>
                                <td class="px-4 py-2 text-xs">Rp {{ number_format($cicilan->nominal, 0, ',', '.') }}</td>
                                <td class="px-4 py-2 text-xs">{{ \Carbon\Carbon::parse($cicilan->tengat)->format('d-m-Y') }}</td>
                                <td class="px-4 py-2 text-xs flex gap-2">
                                    <form action="{{ route('scema.detail.destroy', $cicilan->id) }}" method="post"
                                        onsubmit="return confirm('Yakin ingin menghapus?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-xs">
                                            Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-4 py-4 text-center text-gray-500">Belum ada data cicilan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                    <tfoot>
                        <tr>
                            <td></td>
                            <td class="px-4 py-2">
                                Rp {{ number_format($totalNominal, 0, ',', '.') }}
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>

    </div>

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
