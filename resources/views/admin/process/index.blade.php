@extends('admin.template.template', ['title' => 'Process'])

@section('content')
<div class="bg-white p-5 rounded-2xl flex flex-col gap-5">

    {{-- HEADER TABS --}}
    <div class="flex items-center justify-between flex-wrap gap-3">
        <div class="flex items-center gap-2 flex-wrap">
            <a href="{{ route('process.index', ['tab' => 'aktif']) }}"
                class="py-2 px-4 rounded-md border border-primary text-sm font-medium
                {{ $tab == 'aktif' ? 'bg-primary text-white' : 'hover:bg-primary hover:text-white' }}">
                Data Aktif
            </a>
            <a href="{{ route('process.index', ['tab' => 'terhapus']) }}"
                class="py-2 px-4 rounded-md border border-red-500 text-sm font-medium
                {{ $tab == 'terhapus' ? 'bg-red-500 text-white' : 'text-red-500 hover:bg-red-500 hover:text-white' }}">
                Recycle Bin
            </a>
            <a href="{{ route('process.index', ['tab' => 'statistik']) }}"
                class="py-2 px-4 rounded-md border border-yellow-500 text-sm font-medium
                {{ $tab == 'statistik' ? 'bg-yellow-500 text-white' : 'text-yellow-600 hover:bg-yellow-500 hover:text-white' }}">
                Statistik Double Daftar
            </a>
        </div>
        <form method="GET" action="{{ route('process.index') }}" class="flex gap-2">
            <input type="hidden" name="tab" value="{{ $tab }}">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama/email/no HP..."
                class="px-4 py-2 min-w-[250px] border rounded-md outline outline-1 outline-primary text-sm">
            <button type="submit" class="p-3 bg-primary rounded-md hover:bg-gray-900 text-white">
                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-3" viewBox="0 0 16 16">
                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
                </svg>
            </button>
        </form>
    </div>

    {{-- FLASH MESSAGE --}}
    @if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-800 px-4 py-3 rounded-md text-sm">
        ? {{ session('success') }}
    </div>
    @endif
    @if(session('error'))
    <div class="bg-red-100 border border-red-400 text-red-800 px-4 py-3 rounded-md text-sm">
        ? {{ session('error') }}
    </div>
    @endif

    {{-- ============================================================ --}}
    {{-- TAB: STATISTIK --}}
    {{-- ============================================================ --}}
    @if($tab === 'statistik')

    <div class="grid grid-cols-2 gap-4 text-sm">
        <div class="bg-red-50 border border-red-200 rounded-xl p-3">
            <span class="font-bold text-red-700">Double Jalur+Prodi Sama</span>
            <span class="ml-2 bg-red-500 text-white px-2 py-0.5 rounded-full text-xs">{{ count($stats['double_same']) }}</span>
        </div>
        <div class="bg-orange-50 border border-orange-200 rounded-xl p-3">
            <span class="font-bold text-orange-700">Daftar lebih dari 2 Jalur</span>
            <span class="ml-2 bg-orange-500 text-white px-2 py-0.5 rounded-full text-xs">{{ count($stats['multi_jalur']) }}</span>
        </div>
        <div class="bg-yellow-50 border border-yellow-200 rounded-xl p-3">
            <span class="font-bold text-yellow-700">LULUS lebih dari 1 Jalur</span>
            <span class="ml-2 bg-yellow-500 text-white px-2 py-0.5 rounded-full text-xs">{{ count($stats['multi_lulus']) }}</span>
        </div>
        <div class="bg-purple-50 border border-purple-200 rounded-xl p-3">
            <span class="font-bold text-purple-700">Daftar Ulang + Lulus</span>
            <span class="ml-2 bg-purple-500 text-white px-2 py-0.5 rounded-full text-xs">{{ count($stats['daftar_ulang_lulus']) }}</span>
        </div>
    </div>

    {{-- Double Same --}}
    @if(count($stats['double_same']) > 0)
    <div>
        <h3 class="font-bold text-red-700 mb-2">Double Daftar � Jalur dan Prodi Sama</h3>
        <div class="overflow-x-auto">
        <table class="w-full border-collapse border border-gray-300 text-xs min-w-max">
            <thead class="bg-red-100">
                <tr>
                    <th class="border px-3 py-2">#</th>
                    <th class="border px-3 py-2">Nama</th>
                    <th class="border px-3 py-2">No HP</th>
                    <th class="border px-3 py-2">Jalur</th>
                    <th class="border px-3 py-2">Prodi</th>
                    <th class="border px-3 py-2">PO IDs</th>
                    <th class="border px-3 py-2">Statuses</th>
                    <th class="border px-3 py-2">Jumlah</th>
                </tr>
            </thead>
            <tbody>
                @foreach($stats['double_same'] as $i => $row)
                <tr class="hover:bg-red-50">
                    <td class="border px-3 py-1">{{ $i+1 }}</td>
                    <td class="border px-3 py-1 font-medium">{{ $row->name }}</td>
                    <td class="border px-3 py-1">{{ $row->phone }}</td>
                    <td class="border px-3 py-1">{{ $row->jalur }}</td>
                    <td class="border px-3 py-1">{{ $row->prodi }}</td>
                    <td class="border px-3 py-1 text-gray-500">{{ $row->po_ids }}</td>
                    <td class="border px-3 py-1">{{ $row->statuses }}</td>
                    <td class="border px-3 py-1 text-center font-bold text-red-600">{{ $row->jumlah }}x</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        </div>
    </div>
    @endif

    {{-- Multi Jalur --}}
    @if(count($stats['multi_jalur']) > 0)
    <div>
        <h3 class="font-bold text-orange-700 mb-2">Pendaftar lebih dari 2 Jalur Berbeda</h3>
        <div class="overflow-x-auto">
        <table class="w-full border-collapse border border-gray-300 text-xs min-w-max">
            <thead class="bg-orange-100">
                <tr>
                    <th class="border px-3 py-2">#</th>
                    <th class="border px-3 py-2">Nama</th>
                    <th class="border px-3 py-2">No HP</th>
                    <th class="border px-3 py-2">Jumlah Jalur</th>
                    <th class="border px-3 py-2">Jalur</th>
                    <th class="border px-3 py-2">Prodi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($stats['multi_jalur'] as $i => $row)
                <tr class="hover:bg-orange-50">
                    <td class="border px-3 py-1">{{ $i+1 }}</td>
                    <td class="border px-3 py-1 font-medium">{{ $row->name }}</td>
                    <td class="border px-3 py-1">{{ $row->phone }}</td>
                    <td class="border px-3 py-1 text-center font-bold text-orange-600">{{ $row->jumlah_jalur }}x</td>
                    <td class="border px-3 py-1 text-gray-600">{{ $row->jalur_list }}</td>
                    <td class="border px-3 py-1 text-gray-600">{{ $row->prodi_list }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        </div>
    </div>
    @endif

    {{-- Multi Lulus --}}
    @if(count($stats['multi_lulus']) > 0)
    <div>
        <h3 class="font-bold text-yellow-700 mb-2">Pendaftar LULUS di lebih dari 1 Jalur</h3>
        <div class="overflow-x-auto">
        <table class="w-full border-collapse border border-gray-300 text-xs min-w-max">
            <thead class="bg-yellow-100">
                <tr>
                    <th class="border px-3 py-2">#</th>
                    <th class="border px-3 py-2">Nama</th>
                    <th class="border px-3 py-2">No HP</th>
                    <th class="border px-3 py-2">Jumlah Lulus</th>
                    <th class="border px-3 py-2">Jalur</th>
                    <th class="border px-3 py-2">Prodi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($stats['multi_lulus'] as $i => $row)
                <tr class="hover:bg-yellow-50">
                    <td class="border px-3 py-1">{{ $i+1 }}</td>
                    <td class="border px-3 py-1 font-medium">{{ $row->name }}</td>
                    <td class="border px-3 py-1">{{ $row->phone }}</td>
                    <td class="border px-3 py-1 text-center font-bold text-yellow-600">{{ $row->jumlah_lulus }}x</td>
                    <td class="border px-3 py-1 text-gray-600">{{ $row->jalur_list }}</td>
                    <td class="border px-3 py-1 text-gray-600">{{ $row->prodi_list }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        </div>
    </div>
    @endif

    {{-- Daftar Ulang + Lulus --}}
    @if(count($stats['daftar_ulang_lulus']) > 0)
    <div>
        <h3 class="font-bold text-purple-700 mb-2">Pendaftar dengan Status Daftar Ulang dan Lulus</h3>
        <div class="overflow-x-auto">
        <table class="w-full border-collapse border border-gray-300 text-xs min-w-max">
            <thead class="bg-purple-100">
                <tr>
                    <th class="border px-3 py-2">#</th>
                    <th class="border px-3 py-2">Nama</th>
                    <th class="border px-3 py-2">No HP</th>
                    <th class="border px-3 py-2">Statuses</th>
                    <th class="border px-3 py-2">Jalur</th>
                    <th class="border px-3 py-2">Prodi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($stats['daftar_ulang_lulus'] as $i => $row)
                <tr class="hover:bg-purple-50">
                    <td class="border px-3 py-1">{{ $i+1 }}</td>
                    <td class="border px-3 py-1 font-medium">{{ $row->name }}</td>
                    <td class="border px-3 py-1">{{ $row->phone }}</td>
                    <td class="border px-3 py-1 font-medium text-purple-700">{{ $row->statuses }}</td>
                    <td class="border px-3 py-1 text-gray-600">{{ $row->jalur_list }}</td>
                    <td class="border px-3 py-1 text-gray-600">{{ $row->prodi_list }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        </div>
    </div>
    @endif

    {{-- ============================================================ --}}
    {{-- TAB: RECYCLE BIN --}}
    {{-- ============================================================ --}}
    @elseif($tab === 'terhapus')

    <div class="flex items-center justify-between">
        <p class="text-sm text-gray-500">Data yang dihapus akan otomatis terhapus permanen setelah 30 hari.</p>
        <form method="POST" action="{{ route('process.clean-old') }}" onsubmit="return confirm('Hapus permanen semua data > 30 hari?')">
            @csrf
            <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-md text-sm hover:bg-red-700">
                Hapus Permanen Data lebih dari 30 Hari
            </button>
        </form>
    </div>

    <div class="w-full overflow-x-auto">
        <table class="w-full border-collapse border border-gray-300 min-w-max text-sm">
            <thead class="bg-red-50">
                <tr>
                    <th class="border px-4 py-2">#</th>
                    <th class="border px-4 py-2">Nomor Pendaftaran</th>
                    <th class="border px-4 py-2">NIM</th>
                    <th class="border px-4 py-2">Nama</th>
                    <th class="border px-4 py-2">Email</th>
                    <th class="border px-4 py-2">Jalur</th>
                    <th class="border px-4 py-2">Prodi</th>
                    <th class="border px-4 py-2">Status</th>
                    <th class="border px-4 py-2">Dihapus</th>
                    <th class="border px-4 py-2">Sisa Hari</th>
                    <th class="border px-4 py-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($datas as $data)
                @php
                    $sisaHari = now()->diffInDays($data->deleted_at->addDays(30), false);
                @endphp
                <tr class="hover:bg-red-50">
                    <td class="border px-4 py-2">{{ $loop->iteration }}</td>
                    <td class="border px-4 py-2 text-xs text-gray-500">{{ $data->user?->created_at?->format('Ymd') }}{{ $data->user_id }}-{{ $data->id }}</td>
                    <td class="border px-4 py-2 text-xs">{{ $data->mahasiswa?->nim ?? '-' }}</td>
                    <td class="border px-4 py-2 font-medium">{{ $data->user?->name ?? '-' }}</td>
                    <td class="border px-4 py-2 text-xs">{{ $data->user?->email }}</td>
                    <td class="border px-4 py-2 text-xs">{{ $data->registrationPath?->name }} - {{ $data->registrationPath?->title }}</td>
                    <td class="border px-4 py-2">{{ $data->departement?->name }}</td>
                    <td class="border px-4 py-2">
                        <span class="px-2 py-0.5 rounded-full text-xs bg-gray-100">{{ $data->status }}</span>
                    </td>
                    <td class="border px-4 py-2 text-xs text-gray-500">{{ $data->deleted_at?->format('d/m/Y H:i') }}</td>
                    <td class="border px-4 py-2 text-center">
                        <span class="{{ $sisaHari <= 7 ? 'text-red-600 font-bold' : 'text-gray-600' }}">
                            {{ max(0, $sisaHari) }} hari
                        </span>
                    </td>
                    <td class="border px-4 py-2">
                        <div class="flex gap-1">
                            <form method="POST" action="{{ route('process.restore', $data->id) }}">
                                @csrf
                                <button type="submit" class="px-2 py-1 bg-green-500 text-white rounded text-xs hover:bg-green-600">
                                    Pulihkan
                                </button>
                            </form>
                            <form method="POST" action="{{ route('process.force-delete', $data->id) }}"
                                onsubmit="return confirm('Hapus permanen? Tidak bisa dipulihkan!')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-2 py-1 bg-red-600 text-white rounded text-xs hover:bg-red-700">
                                    Hapus Permanen
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="10" class="border px-4 py-8 text-center text-gray-400">Tidak ada data di recycle bin</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    {{ $datas->appends(['tab' => 'terhapus', 'search' => request('search')])->links() }}

    {{-- ============================================================ --}}
    {{-- TAB: AKTIF --}}
    {{-- ============================================================ --}}
    @else

    {{-- Filter status --}}
    <div class="flex items-center gap-1 flex-wrap">
        <span class="bg-primary p-3 text-white rounded-md">
            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-3" viewBox="0 0 16 16">
                <path d="M6 10.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5m-2-3a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5m-2-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5"/>
            </svg>
        </span>
        @foreach(['', 'Pembayaran', 'Upload Dokumen', 'Verifikasi Dokumen', 'Revisi Dokumen', 'Proses Seleksi', 'Daftar Ulang', 'Generate NIM', 'LULUS'] as $s)
        <a href="{{ route('process.index', ['status' => $s, 'tab' => 'aktif']) }}"
            class="py-1.5 px-3 text-sm outline outline-1 outline-primary rounded-md hover:bg-primary hover:text-white
            {{ request('status') == $s ? 'bg-primary text-white' : '' }}">
            {{ $s === '' ? 'All' : $s }}
        </a>
        @endforeach
    </div>

    <div class="w-full overflow-x-auto">
        <table class="w-full border-collapse border border-gray-300 min-w-max text-sm">
            <thead class="bg-gray-50">
                <tr>
                    <th class="border px-4 py-2">#</th>
                    <th class="border px-4 py-2">Nomor Pendaftaran</th>
                    <th class="border px-4 py-2">NIM</th>
                    <th class="border px-4 py-2">Nama Lengkap</th>
                    <th class="border px-4 py-2">Email</th>
                    <th class="border px-4 py-2">No Telephone</th>
                    <th class="border px-4 py-2">Registration Path</th>
                    <th class="border px-4 py-2">Pilihan Program Studi</th>
                    <th class="border px-4 py-2">Tanggal Pendaftaran</th>
                    <th class="border px-4 py-2">Status</th>
                    <th class="border px-4 py-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($datas as $data)
                <tr class="hover:bg-gray-50">
                    <td class="border px-4 py-2">{{ $loop->iteration }}</td>
                    <td class="border px-4 py-2 text-xs text-gray-500">{{ $data->user?->created_at?->format('Ymd') }}{{ $data->user_id }}-{{ $data->id }}</td>
                    <td class="border px-4 py-2 text-xs">{{ $data->mahasiswa?->nim ?? '-' }}</td>
                    <td class="border px-4 py-2 font-medium">{{ $data->user?->name ?? '-' }}</td>
                    <td class="border px-4 py-2 text-xs">{{ $data->user?->email }}</td>
                    <td class="border px-4 py-2">{{ $data->user?->phone }}</td>
                    <td class="border px-4 py-2 text-xs">{{ $data->registrationPath?->name ?? '-' }} - {{ $data->registrationPath?->title ?? '-' }}</td>
                    <td class="border px-4 py-2">{{ $data->departement?->name }}</td>
                    <td class="border px-4 py-2 text-xs">{{ $data->created_at }}</td>
                    <td class="border px-4 py-2">
                        <span class="px-2 py-0.5 rounded-full text-xs
                            {{ $data->status == 'LULUS' ? 'bg-green-100 text-green-700' :
                               ($data->status == 'Daftar Ulang' ? 'bg-blue-100 text-blue-700' :
                               ($data->status == 'Generate NIM' ? 'bg-purple-100 text-purple-700' :
                               ($data->status == 'Proses Seleksi' ? 'bg-yellow-100 text-yellow-700' :
                               'bg-gray-100 text-gray-600'))) }}">
                            {{ $data->status }}
                        </span>
                    </td>
                    <td class="border px-4 py-2">
                        <div class="flex gap-1">
                            <a href="{{ route('process.show', $data->id) }}"
                                class="px-2 py-1 bg-primary text-white rounded text-xs hover:bg-gray-800">Edit
                                
                            </a>
                            <form method="POST" action="{{ route('process.soft-delete', $data->id) }}"
                                onsubmit="return confirm('Pindahkan ke recycle bin?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-2 py-1 bg-red-500 text-white rounded text-xs hover:bg-red-700">Hapus
                                    
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="10" class="border px-4 py-8 text-center text-gray-400">Tidak ada data</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    {{ $datas->appends(['search' => request('search'), 'status' => request('status'), 'tab' => 'aktif'])->links() }}

    @endif

</div>
@endsection