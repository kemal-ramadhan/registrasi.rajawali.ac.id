@extends('admin.template.template', ['title' => 'Mahasiswa'])

@section('content')
    <div class="bg-white p-5 rounded-2xl flex flex-col gap-5">
        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 sm:gap-6">
            <div>
                <h1 class="font-sora font-semibold text-lg sm:text-xl">Data</h1>
            </div>
            <div class="w-full sm:w-auto">
                <form method="GET" action="{{ route('mahasiswa.index') }}"
                    class="flex flex-col sm:flex-row flex-wrap gap-4 w-full sm:items-end">
                    <div class="w-full sm:w-auto">
                        <input type="text" name="search" id="search" value="{{ request('search') }}"
                            class="px-4 py-2 w-full sm:min-w-[300px] border rounded-md outline outline-1 outline-primary"
                            placeholder="Nama / Email / Telepon">
                    </div>

                    <div class="w-full sm:w-auto">
                        <input type="date" name="start_date" id="start_date" value="{{ request('start_date') }}"
                            class="px-4 py-2 w-full sm:min-w-[300px] border rounded-md outline outline-1 outline-primary">
                    </div>

                    <div class="w-full sm:w-auto">
                        <input type="date" name="end_date" id="end_date" value="{{ request('end_date') }}"
                            class="px-4 py-2 w-full sm:min-w-[300px] border rounded-md outline outline-1 outline-primary">
                    </div>

                    <div class="w-full sm:w-auto">
                        <button type="submit"
                            class="w-full sm:w-auto p-3 bg-primary rounded-md hover:bg-gray-900 text-white flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-search w-4 h-4"
                                viewBox="0 0 16 16">
                                <path
                                    d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
                            </svg>
                        </button>
                    </div>
                </form>
            </div>
        </div>


        <div class="w-full overflow-x-auto">
            <table class="w-full border-collapse border border-gray-300 min-w-max">
                <thead>
                    <tr>
                        <th class="border border-gray-300 px-4 py-2">#</th>
                        <th class="border border-gray-300 px-4 py-2">Nama Lengkap</th>
                        <th class="border border-gray-300 px-4 py-2">Email</th>
                        <th class="border border-gray-300 px-4 py-2">No Telephone</th>
                        <th class="border border-gray-300 px-4 py-2">Tanggal Pendaftaran</th>
                        <th class="border border-gray-300 px-4 py-2">Verifikasi Email</th>
                        <th class="border border-gray-300 px-4 py-2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($students as $student)
                        <tr>
                            <td class="border border-gray-300 px-4 py-2">{{ $loop->iteration }}</td>
                            <td class="border border-gray-300 px-4 py-2 whitespace-nowrap">{{ $student->name }}</td>
                            <td class="border border-gray-300 px-4 py-2 whitespace-nowrap">{{ $student->email }}</td>
                            <td class="border border-gray-300 px-4 py-2 whitespace-nowrap">{{ $student->phone }}</td>
                            <td class="border border-gray-300 px-4 py-2 whitespace-nowrap">{{ $student->created_at }}</td>
                            <td class="border border-gray-300 px-4 py-2 whitespace-nowrap">
                                @if ($student->email_verified_at)
                                    {{ $student->email_verified_at }}
                                @else
                                    <form action="{{ route('mahasiswa.update', $student->id) }}" method="post"
                                        id="myForm">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" id="verifikasi"
                                            class="py-2 px-3 bg-primary rounded-md text-white text-xs">Verifikasi</button>
                                    </form>
                                @endif
                            </td>
                            <td class="border border-gray-300 px-4 py-2">
                                <a href="{{ route('mahasiswa.show', $student->id) }}"
                                    class="px-2 py-1 flex items-center w-fit font-thin bg-primary text-white rounded-md">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                        class="bi bi-pencil-square w-3" viewBox="0 0 16 16">
                                        <path
                                            d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                        <path fill-rule="evenodd"
                                            d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                                    </svg>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center border border-gray-300 px-4 py-2">Data tidak ditemukan
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="">
            {{ $students->appends(['search' => request('search')])->links() }}
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const deleteButtons = document.querySelectorAll(".btn-delete");

            deleteButtons.forEach(button => {
                button.addEventListener("click", function() {
                    const form = this.closest("form");

                    Swal.fire({
                        title: "Apakah Anda yakin?",
                        text: "Data akan dihapus secara permanen!",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#d33",
                        cancelButtonColor: "#3085d6",
                        confirmButtonText: "Ya, hapus!",
                        cancelButtonText: "Batal"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });
        });
    </script>

    <script>
        document.getElementById('verifikasi').addEventListener('click', function(e) {
            Swal.fire({
                title: "Verifikasi Akun Secara Paksa?",
                text: "Data akan diverifikasi!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya, Verifikasi!",
                cancelButtonText: "Batal"
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('myForm').submit(); // Ganti dengan ID form kamu
                }
            });
        });
    </script>
@endsection
