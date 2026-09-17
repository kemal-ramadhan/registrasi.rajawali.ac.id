@extends('admin.template.template', ['title' => 'Report'])

@section('content')
<div class="bg-white rounded-2xl p-5">
    <h1 class="text-lg">Laporan Data</h1>
    <p>Ini adalah halaman laporan data. Di sini Anda dapat melihat dan mengelola laporan terkait sistem pendaftaran.</p>

    <form method="GET" action="{{ route('reports.index') }}">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-4 mt-5">
            <div class="flex flex-col rounded-lg gap-3">
                <label for="">Tanggal Mulai</label>
                <input type="date" name="start_date" value="{{ request('start_date') }}"
                    class="px-4 py-2 w-full border rounded-md outline outline-1 outline-primary">
            </div>
            <div class="flex flex-col rounded-lg gap-3">
                <label for="">Tanggal Selesai</label>
                <input type="date" name="end_date" value="{{ request('end_date') }}"
                    class="px-4 py-2 w-full border rounded-md outline outline-1 outline-primary">
            </div>
            <div class="flex flex-col rounded-lg gap-3">
                <label for="">Jalur Pendaftaran</label>
                <select name="registration_path_id" id="registration_path_id"
                    class="js-example-basic-single-jalur form-control px-4 py-2 w-full border rounded-md outline outline-1 outline-primary">
                    <option value="">Semua Jalur</option>
                    @foreach ($registrations as $registration)
                    <option value="{{ $registration->id }}" {{ request('registration_path_id')==$registration->id ?
                        'selected' : '' }}>
                        {{ $registration->name }} - {{ $registration->title }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="flex flex-col rounded-lg gap-3">
                <label for="">Program Studi</label>
                <select name="departement_id" id="departement_id"
                    class="js-example-basic-single-departemen form-control px-4 py-2 w-full border rounded-md outline outline-1 outline-primary">
                    <option value="">Semua Departemen</option>
                    @foreach ($departements as $departement)
                    <option value="{{ $departement->id }}" {{ request('departement_id')==$departement->id ?
                        'selected' : '' }}>
                        {{ $departement->name }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="flex flex-col rounded-lg gap-3">
                @php
                $statuses = [
                'Belum Memilih Program',
                'Upload Dokumen',
                'Pembayaran',
                'Verifikasi Dokumen',
                'Proses Seleksi',
                'Revisi Dokumen',
                'Daftar Ulang',
                'Generate NIM',
                'Lulus',
                ];
                @endphp
                <label for="">Status</label>
                <select name="status" id="status"
                    class="js-example-basic-single form-control px-4 py-2 w-full border rounded-md outline outline-1 outline-primary">
                    <option value="">Semua Status</option>
                    @foreach ($statuses as $status)
                    <option value="{{ $status }}" {{ request('status')==$status ? 'selected' : '' }}>
                        {{ $status }}
                    </option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="flex gap-3 mt-5 justify-end">
            <button type="submit"
                class="px-4 py-2 bg-primary text-white rounded-md hover:bg-primary/95 transition duration-300">
                Search Data
            </button>
            <a href="{{ route('report.export', request()->all()) }}"
                class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
                Export Excel
            </a>
        </div>
    </form>
</div>

<div class="bg-white p-5 rounded-xl">
    <div class="w-full overflow-x-auto">
        <!-- Alert Error / Success (Tempatkan di atas Table) -->
@if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
        <span class="block sm:inline">{{ session('success') }}</span>
    </div>
@endif

@if($errors->any())
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
        <ul class="list-disc pl-5">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="table-responsive">
    <table class="min-w-full border-collapse border border-gray-300">
        <thead>
            <tr class="bg-gray-100">
                <!-- Sesuaikan header yang ada sebelumnya... -->
                <th class="border border-gray-300 px-4 py-2">No</th>
                <th class="border border-gray-300 px-4 py-2">Nama</th>
                <th class="border border-gray-300 px-4 py-2">Email</th>
                <th class="border border-gray-300 px-4 py-2">Telepon</th>
                <th class="border border-gray-300 px-4 py-2">Jalur Pendaftaran</th>
                <th class="border border-gray-300 px-4 py-2">Program Studi</th>
                <th class="border border-gray-300 px-4 py-2">Status</th>
                <!-- Kolom Aksi Baru -->
                <th class="border border-gray-300 px-4 py-2 text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($datas as $key => $data)
            <tr>
                <td class="border border-gray-300 px-4 py-2">{{ $datas->firstItem() + $key }}</td>
                <td class="border border-gray-300 px-4 py-2">{{ $data->user?->name ?? '-' }}</td>
                <td class="border border-gray-300 px-4 py-2">{{ $data->user?->email ?? '-' }}</td>
                <td class="border border-gray-300 px-4 py-2">{{ $data->user?->phone ?? '-' }}</td>
                <td class="border border-gray-300 px-4 py-2">
                    {{ $data->registrationPath?->name ?? '-' }} - {{ $data->registrationPath?->title ?? '-' }}
                </td>
                <td class="border border-gray-300 px-4 py-2">{{ $data->departement?->name ?? '-' }}</td>
                <td class="border border-gray-300 px-4 py-2">{{ $data->status ?? '-' }}</td>
                
                <!-- Kolom Aksi (Tombol Edit dan Hapus) -->
                <td class="border border-gray-300 px-4 py-2 text-center align-middle">
                    @if($data->user)
                        <div class="flex flex-col gap-2 justify-center items-center">
                            <!-- Tombol Edit Email -->
                            <button type="button" onclick="editEmail({{ $data->user->id }}, '{{ $data->user->email }}')" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-3 rounded text-xs w-full">
                                Edit Email
                            </button>

                            <!-- Form Hidden untuk Submit Update Email -->
                            <form id="edit-email-form-{{ $data->user->id }}" action="{{ route('report.updateEmail', $data->user->id) }}" method="POST" style="display: none;">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="email" value="">
                            </form>

                            <!-- Tombol Hapus Pendaftar -->
                            <form action="{{ route('report.destroyUser', $data->user->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data pendaftar ini secara permanen?');" class="w-full">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-3 rounded text-xs w-full">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    @else
                        -
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="8" class="text-center py-4 text-gray-500 font-italic">Tidak ada data yang ditemukan.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<!-- Pagination Link -->
<div class="mt-4">
    {{ $datas->withQueryString()->links() }}
</div>

<!-- Script Javascript untuk trigger Form Edit Email -->
<script>
    function editEmail(userId, currentEmail) {
        let newEmail = prompt("Ubah email pendaftar:", currentEmail);
        
        // Memastikan input tidak kosong, tidak batal, dan berbeda dengan email sebelumnya
        if (newEmail !== null && newEmail.trim() !== "" && newEmail !== currentEmail) {
            let form = document.getElementById('edit-email-form-' + userId);
            form.querySelector('input[name="email"]').value = newEmail.trim();
            form.submit();
        }
    }
</script>    </div>
    <div class="">
        {{ $datas->appends([
        'search' => request('search'),
        'status' => request('status'),
        'registration_path_id' => request('registration_path_id'),
        'start_date' => request('start_date'),
        'end_date' => request('end_date'),
        ])->links() }}
    </div>
</div>

<script>
    $('.js-example-basic-single').select2({
    });
</script>
<script>
    $('.js-example-basic-single-departemen').select2({
    });
</script>
<script>
    $('.js-example-basic-single-jalur').select2({
    });
</script>
@endsection