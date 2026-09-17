@extends('admin.template.template', ['title' => 'Proses Seleksi'])

@section('content')
<div class="bg-white p-5 rounded-2xl flex flex-col gap-5">
    <div class="flex items-center justify-between">
        <h1 class="font-sora font-semibold">Proses Seleksi</h1>
        <form method="GET" action="{{ route('exam.index') }}" class="flex gap-2">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari..."
                class="px-4 py-2 min-w-[300px] border rounded-md outline outline-1 outline-primary">
            <div class="flex gap-1">
                <button type="submit" class="p-3 bg-primary rounded-md hover:bg-primary-hover text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-search w-3"
                        viewBox="0 0 16 16">
                        <path
                            d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
                    </svg>
                </button>
                <a href="{{ route('exam.create') }}"
                    class="p-3 bg-primary rounded-md flex items-center w-fit hover:bg-primary-hover text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-folder-plus w-3"
                        viewBox="0 0 16 16">
                        <path
                            d="m.5 3 .04.87a2 2 0 0 0-.342 1.311l.637 7A2 2 0 0 0 2.826 14H9v-1H2.826a1 1 0 0 1-.995-.91l-.637-7A1 1 0 0 1 2.19 4h11.62a1 1 0 0 1 .996 1.09L14.54 8h1.005l.256-2.819A2 2 0 0 0 13.81 3H9.828a2 2 0 0 1-1.414-.586l-.828-.828A2 2 0 0 0 6.172 1H2.5a2 2 0 0 0-2 2m5.672-1a1 1 0 0 1 .707.293L7.586 3H2.19q-.362.002-.683.12L1.5 2.98a1 1 0 0 1 1-.98z" />
                        <path
                            d="M13.5 9a.5.5 0 0 1 .5.5V11h1.5a.5.5 0 1 1 0 1H14v1.5a.5.5 0 1 1-1 0V12h-1.5a.5.5 0 0 1 0-1H13V9.5a.5.5 0 0 1 .5-.5" />
                    </svg>
                </a>
            </div>
        </form>
    </div>

    <div class="w-full overflow-x-auto">
        <table class="w-full border-collapse border border-gray-300 min-w-max">
            <thead>
                <tr>
                    <th class="border border-gray-300 px-4 py-2">#</th>
                    <th class="border border-gray-300 px-4 py-2">Title</th>
                    <th class="border border-gray-300 px-4 py-2">Date</th>
                    <th class="border border-gray-300 px-4 py-2">Jalur</th>
                    <th class="border border-gray-300 px-4 py-2">Type Seleksi</th>
                    <th class="border border-gray-300 px-4 py-2">Pengerjaan</th>
                    <th class="border border-gray-300 px-4 py-2">Status</th>
                    <th class="border border-gray-300 px-4 py-2">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($exams as $exam)
                    <tr>
                        <td class="border border-gray-300 px-4 py-2">{{ $loop->iteration }}</td>
                        <td class="border border-gray-300 px-4 py-2 whitespace-nowrap">{{ $exam->name }}</td>
                        <td class="border border-gray-300 px-4 py-2 whitespace-nowrap">{{ $exam->start_date }}</td>
                        <td class="border border-gray-300 px-4 py-2 whitespace-nowrap">{{ $exam->registration_path->name }} - {{ $exam->registration_path->title }}</td>
                        <td class="border border-gray-300 px-4 py-2 whitespace-nowrap">{{ $exam->type }}</td>
                        <td class="border border-gray-300 px-4 py-2 whitespace-nowrap">{{ $exam->pengerjaan }}</td>
                        <td class="border border-gray-300 px-4 py-2 text-center">
                            @if ($exam->status === 'Publish')
                                <span class="py-1 px-2 bg-primary rounded-xl text-white text-xs">{{ $exam->status }}</span>
                            @else
                                <span class="py-1 px-2 bg-red-500 rounded-xl text-white text-xs">{{ $exam->status }}</span>
                            @endif
                        </td>
                        <td class="border border-gray-300 px-4 py-2 flex items-start gap-3">
                            <a href="{{ route('exam.show', $exam->id) }}"
                                class="px-2 py-1 flex font-thin bg-primary text-white rounded-md">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-pencil-square w-3"
                                    viewBox="0 0 16 16">
                                    <path
                                        d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                    <path fill-rule="evenodd"
                                        d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                                </svg>
                                <span class="ml-2">Setting Soal</span>
                            </a>
                            <a href="{{ route('particimant.index', $exam->id) }}"
                                class="px-2 py-1 flex font-thin bg-primary text-white rounded-md">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-people w-3"
                                    viewBox="0 0 16 16">
                                    <path
                                        d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1zm-7.978-1L7 12.996c.001-.264.167-1.03.76-1.72C8.312 10.629 9.282 10 11 10c1.717 0 2.687.63 3.24 1.276.593.69.758 1.457.76 1.72l-.008.002-.014.002zM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4m3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0M6.936 9.28a6 6 0 0 0-1.23-.247A7 7 0 0 0 5 9c-4 0-5 3-5 4q0 1 1 1h4.216A2.24 2.24 0 0 1 5 13c0-1.01.377-2.042 1.09-2.904.243-.294.526-.569.846-.816M4.92 10A5.5 5.5 0 0 0 4 13H1c0-.26.164-1.03.76-1.724.545-.636 1.492-1.256 3.16-1.275ZM1.5 5.5a3 3 0 1 1 6 0 3 3 0 0 1-6 0m3-2a2 2 0 1 0 0 4 2 2 0 0 0 0-4" />
                                </svg>
                                <span class="ml-2">Lihat Participant</span>
                            </a>
                        </td>
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
        {{ $exams->appends(['search' => request('search')])->links() }}
    </div>
</div>

    <script>
        document.querySelectorAll('.btn-delete').forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                let jenjangId = this.getAttribute('data-id');
                let deleteUrl = "{{ route('referensi.jenjang.delete', ':id') }}".replace(':id', jenjangId);

                Swal.fire({
                    title: "Apakah Anda yakin?",
                    text: "Data akan dihapus secara permanen!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#d33",
                    cancelButtonColor: "#3085d6",
                    confirmButtonText: "Ya, Hapus!",
                    cancelButtonText: "Batal"
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = deleteUrl;
                    }
                });
            });
        });
    </script>
@endsection
