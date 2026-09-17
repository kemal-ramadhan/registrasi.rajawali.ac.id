@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="card shadow-sm mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h5 class="m-0 font-weight-bold text-primary">Data Peminat Belum Memilih Jalur & Prodi</h5>
            <a href="{{ route('report.belumMemilihProdi.export', request()->all()) }}" class="btn btn-success btn-sm">
                <i class="fas fa-file-excel"></i> Export Excel
            </a>
        </div>
        <div class="card-body">
            
            <form action="{{ route('report.belumMemilihProdi') }}" method="GET" class="mb-4">
                <div class="row align-items-end">
                    <div class="col-md-4 mb-3">
                        <label>Cari (Nama/Email/Telepon)</label>
                        <input type="text" name="search" class="form-control" placeholder="Masukkan kata kunci..." value="{{ request('search') }}">
                    </div>
                    <div class="col-md-3 mb-3">
                        <label>Tanggal Registrasi (Mulai)</label>
                        <input type="date" name="start_date" class="form-control" value="{{ request('start_date') }}">
                    </div>
                    <div class="col-md-3 mb-3">
                        <label>Tanggal Registrasi (Sampai)</label>
                        <input type="date" name="end_date" class="form-control" value="{{ request('end_date') }}">
                    </div>
                    <div class="col-md-2 mb-3">
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="fas fa-search"></i> Filter
                        </button>
                    </div>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover">
                    <thead class="thead-light">
                        <tr>
                            <th width="5%">No</th>
                            <th>No. Registrasi / ID</th>
                            <th>Nama Lengkap</th>
                            <th>Email</th>
                            <th>No Telepon</th>
                            <th>Tanggal Registrasi Akun</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($datas as $key => $data)
                        <tr>
                            <td>{{ $datas->firstItem() + $key }}</td>
                            <td>{{ $data->created_at->format('Ymd') }}{{ $data->id }}</td>
                            <td>{{ $data->name }}</td>
                            <td>{{ $data->email }}</td>
                            <td>{{ $data->phone ?? '-' }}</td>
                            <td>{{ $data->created_at->format('d-m-Y H:i:s') }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center font-italic text-muted">
                                Tidak ada data peminat yang belum memilih jalur/prodi pada kriteria pencarian ini.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                {{ $datas->withQueryString()->links() }}
            </div>
            
        </div>
    </div>
</div>
@endsection