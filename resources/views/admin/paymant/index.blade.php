@extends('admin.template.template', ['title' => 'Pembayaran Mahasiswa'])

@section('content')
<div class="bg-white p-5 rounded-2xl flex flex-col gap-5">
    <div class="flex items-center justify-between">
        <h1 class="font-sora font-semibold">Detail Pembayaran</h1>
        <form method="GET" action="{{ route('mahasiswa-paymant.index') }}" class="flex gap-2">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari..." class="px-4 py-2 min-w-[300px] border rounded-full outline outline-1 outline-primary">
            <div class="flex gap-1">
                <button type="submit" class="p-3 bg-primary rounded-full hover:bg-gray-900 text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-search w-3" viewBox="0 0 16 16">
                        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
                      </svg>
                </button>
            </div>
        </form>
    </div>
    
    <div class="w-full overflow-x-auto">
        <table class="w-full border-collapse border border-gray-300 min-w-max">
            <thead>
                <tr>
                    <th class="border border-gray-300 px-4 py-2">#</th>
                    <th class="border border-gray-300 px-4 py-2">Nama Lengkap</th>
                    <th class="border border-gray-300 px-4 py-2">Email</th>
                    <th class="border border-gray-300 px-4 py-2">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($mahasiswas as $mahasiswa)
                    <tr>
                        <td class="border border-gray-300 px-4 py-2">{{ $loop->iteration }}</td>              
                        <td class="border border-gray-300 px-4 py-2 whitespace-nowrap">{{ $mahasiswa->name }}</td>                  
                        <td class="border border-gray-300 px-4 py-2 whitespace-nowrap">{{ $mahasiswa->email }}</td>                  
                        <td class="border border-gray-300 px-4 py-2 flex gap-1">
                            <a href="{{ route('mahasiswa-paymant.show', $mahasiswa->id) }}" class="px-2 py-1 flex items-center w-fit font-thin bg-primary text-white rounded-md">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-pencil-square w-3" viewBox="0 0 16 16">
                                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
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
    
    <div class="">
        {{ $mahasiswas->appends(['search' => request('search')])->links() }}
    </div>
</div>

<script>
    document.querySelectorAll('.btn-delete').forEach(button => {
        button.addEventListener('click', function (e) {
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