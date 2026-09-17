@extends('admin.template.template', ['title' => 'Biaya Perkuliahan'])

@section('content')
<div class="bg-white p-5 rounded-2xl flex flex-col gap-5">
    <div class="flex items-center justify-between">
        <h1 class="font-sora font-semibold">Daftar Biaya Perkuliahan</h1>
        <form method="GET" action="{{ route('biayareferensi.index') }}" class="flex gap-2">
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
                <a href="{{ route('biayareferensi.create') }}"
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
                    <th class="border border-gray-300 px-4 py-2">Biaya</th>
                    <th class="border border-gray-300 px-4 py-2">Description</th>
                    <th class="border border-gray-300 px-4 py-2">Nominal</th>
                    <th class="border border-gray-300 px-4 py-2">Type Pembayaran</th>
                    <th class="border border-gray-300 px-4 py-2">Status</th>
                    <th class="border border-gray-300 px-4 py-2">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($biayas as $biaya)
                    <tr>
                        <td class="border border-gray-300 px-4 py-2">{{ $loop->iteration }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $biaya->biaya }}</td>
                        <td class="border border-gray-300 px-4 py-2">{!! $biaya->description !!}</td>
                        <td class="border border-gray-300 px-4 py-2">Rp {{ number_format($biaya->nominal, 0, ',', '.') }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $biaya->type }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $biaya->status }}</td>
                        <td class="border border-gray-300 px-4 py-2 text-center">
                            <a href="{{ route('biayareferensi.show', $biaya->id) }}" class="bg-primary hover:bg-primary-hover text-white py-1 px-3 rounded-md">Setting</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="">
        {{ $biayas->appends(['search' => request('search')])->links() }}
    </div>
</div>
@endsection
