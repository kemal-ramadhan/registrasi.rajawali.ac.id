@extends('admin.template.template', ['title' => 'Setting Dokumen Jalur Pendaftaran'])

@section('content')
    <div class="bg-white p-5 rounded-xl md:flex gap-3 md:justify-between">
        <div class="w-full md:w-3/4">
            <h1 class="font-sora font-semibold text-lg">{{ $registration->name }} - {{ $registration->title }}</h1>
            <p class="mt-3">{!! $registration->description !!}</p>
        </div>
        <div class="w-full md:w-1/4 flex flex-col gap-3">
            <span class="flex gap-2 font-semibold font-sora">
                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-exclamation-circle w-3"
                    viewBox="0 0 16 16">
                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16" />
                    <path
                        d="M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0M7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0z" />
                </svg>
                {{ $registration->name }}
            </span>
            <span class="flex gap-2 font-semibold font-sora">
                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-calendar-week w-3"
                    viewBox="0 0 16 16">
                    <path
                        d="M11 6.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm-3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm-5 3a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5z" />
                    <path
                        d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5M1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4z" />
                </svg>
                {{ $registration->start_date }}
                {{ $registration->end_date }}
            </span>
            <span class="flex gap-2 font-semibold font-sora">
                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-credit-card-2-front w-3"
                    viewBox="0 0 16 16">
                    <path
                        d="M14 3a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1zM2 2a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2z" />
                    <path
                        d="M2 5.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5zm0 3a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5m3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5m3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5m3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5" />
                </svg>
                Rp. {{ number_format($registration->amount, 0, ',', '.') }}
            </span>
            <span class="flex gap-2 font-semibold font-sora">
                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-hourglass-split w-3"
                    viewBox="0 0 16 16">
                    <path
                        d="M2.5 15a.5.5 0 1 1 0-1h1v-1a4.5 4.5 0 0 1 2.557-4.06c.29-.139.443-.377.443-.59v-.7c0-.213-.154-.451-.443-.59A4.5 4.5 0 0 1 3.5 3V2h-1a.5.5 0 0 1 0-1h11a.5.5 0 0 1 0 1h-1v1a4.5 4.5 0 0 1-2.557 4.06c-.29.139-.443.377-.443.59v.7c0 .213.154.451.443.59A4.5 4.5 0 0 1 12.5 13v1h1a.5.5 0 0 1 0 1zm2-13v1c0 .537.12 1.045.337 1.5h6.326c.216-.455.337-.963.337-1.5V2zm3 6.35c0 .701-.478 1.236-1.011 1.492A3.5 3.5 0 0 0 4.5 13s.866-1.299 3-1.48zm1 0v3.17c2.134.181 3 1.48 3 1.48a3.5 3.5 0 0 0-1.989-3.158C8.978 9.586 8.5 9.052 8.5 8.351z" />
                </svg>
                @if ($registration->status === 'open')
                    <span class="py-1 px-2 bg-primary rounded-xl text-white text-xs">{{ $registration->status }}</span>
                @else
                    <span class="py-1 px-2 bg-red-500 rounded-xl text-white text-xs">{{ $registration->status }}</span>
                @endif
            </span>
            <hr>
            <div class="flex gap-1">
                <a href="{{ route('registration.edit', $registration->id) }}" class="px-2 py-1 flex gap-3 items-center w-fit font-thin bg-primary text-white rounded-md">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-pencil-square w-3" viewBox="0 0 16 16">
                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                    </svg>
                    registration
                </a>
                <a href="{{ route('registration.indexDocs', $registration->id) }}" class="px-2 py-1 flex gap-3 items-center w-fit font-thin bg-primary text-white rounded-md">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-pencil-square w-3" viewBox="0 0 16 16">
                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                    </svg>
                    Dokumen
                </a>
                <a href="{{ route('registration.indexDepartement', $registration->id) }}" class="px-2 py-1 flex gap-3 items-center w-fit font-thin bg-primary text-white rounded-md">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-pencil-square w-3" viewBox="0 0 16 16">
                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                    </svg>
                    Prodi
                </a>
            </div>
        </div>
    </div>

    <div class="bg-white p-5 rounded-2xl flex flex-col gap-5">
        <div class="mt-5 flex items-center justify-between">
            <h1 class="font-sora font-semibold">Dokumen Persyaratan</h1>
            <div x-data="{ open: false }">
                <!-- Tombol untuk membuka modal -->
                <button @click="open = true" class="p-3 bg-primary rounded-xl flex gap-2 items-center w-fit hover:bg-gray-900 text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-folder-plus w-3" viewBox="0 0 16 16">
                        <path d="m.5 3 .04.87a2 2 0 0 0-.342 1.311l.637 7A2 2 0 0 0 2.826 14H9v-1H2.826a1 1 0 0 1-.995-.91l-.637-7A1 1 0 0 1 2.19 4h11.62a1 1 0 0 1 .996 1.09L14.54 8h1.005l.256-2.819A2 2 0 0 0 13.81 3H9.828a2 2 0 0 1-1.414-.586l-.828-.828A2 2 0 0 0 6.172 1H2.5a2 2 0 0 0-2 2m5.672-1a1 1 0 0 1 .707.293L7.586 3H2.19q-.362.002-.683.12L1.5 2.98a1 1 0 0 1 1-.98z"/>
                        <path d="M13.5 9a.5.5 0 0 1 .5.5V11h1.5a.5.5 0 1 1 0 1H14v1.5a.5.5 0 1 1-1 0V12h-1.5a.5.5 0 0 1 0-1H13V9.5a.5.5 0 0 1 .5-.5"/>
                      </svg>
                      <span>Tambah Dokumen Persyaratan</span>
                </button>
            
                <!-- Modal -->
                <div x-show="open" class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50">
                    <div class="bg-white p-6 rounded-lg shadow-lg w-96">
                        <h2 class="text-xl font-bold mb-4">Tambah Dokumen Persyaratan</h2>
            
                        <!-- Form -->
                        <form action="{{ route('registration.storeDocs') }}" method="post">
                            @csrf
                            <input type="hidden" name="registration_path_id" value="{{ $registration->id }}">
                            <div class="mb-3">
                                <label class="block text-gray-700">Nama Dokumen</label>
                                <input type="text" name="dokumen_name" required class="w-full p-2 border rounded-lg">
                            </div>
            
                            <div class="mb-3">
                                <label class="block text-gray-700" required>Deskripsi</label>
                                <textarea name="description" class="w-full p-2 border rounded-lg"></textarea>
                            </div>
            
                            <div class="flex justify-end">
                                <button type="button" @click="open = false" class="mr-2 px-4 py-2 bg-gray-400 text-white rounded-lg">
                                    Batal
                                </button>
                                <button type="submit" class="px-4 py-2 bg-primary text-white rounded-lg">
                                    Simpan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>        
        </div>
        <div class="w-full overflow-x-auto">
            <table class="w-full border-collapse border border-gray-300 min-w-max">
                <thead>
                    <tr>
                        <th class="border border-gray-300 px-4 py-2">#</th>
                        <th class="border border-gray-300 px-4 py-2">Gelombang</th>
                        <th class="border border-gray-300 px-4 py-2">Deskripsi Dokumen</th>
                        <th class="border border-gray-300 px-4 py-2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($dokumens as $dokumen)
                        <tr>
                            <td class="border border-gray-300 px-4 py-2">{{ $loop->iteration }}</td>
                            <td class="border border-gray-300 px-4 py-2 whitespace-nowrap">{{ $dokumen->dokumen_name }}</td>                
                            <td class="border border-gray-300 px-4 py-2 whitespace-nowrap">{{ $dokumen->description }}</td>                
                            <td class="border border-gray-300 px-4 py-2 flex gap-1">
                                <a href="#" data-id="{{ $dokumen->id }}" class="btn-delete px-2 py-1 flex items-center w-fit font-thin bg-red-500 text-white rounded-md">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-trash3 w-3" viewBox="0 0 16 16">
                                        <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5"/>
                                    </svg>
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
    </div>

    <script>
        document.querySelectorAll('.btn-delete').forEach(button => {
            button.addEventListener('click', function (e) {
                e.preventDefault();
                let dokumenId = this.getAttribute('data-id');
                let deleteUrl = "{{ route('registration.dokumen.delete', ':id') }}".replace(':id', dokumenId);
        
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
