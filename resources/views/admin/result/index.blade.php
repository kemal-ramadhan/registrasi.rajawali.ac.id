@extends('admin.template.template', ['title' => 'Proses Seleksi'])

@section('content')

    <div class="w-full">
        <div class="flex items-center justify-between mb-3">
            <h1 class="font-sora font-semibold">Daftar Pesrta</h1>
            <form method="GET" class="flex gap-2">
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
                </div>
            </form>
        </div>

        <div class="overflow-x-auto bg-white shadow-md rounded-lg">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr class="text-left text-sm font-semibold text-gray-600">
                        <th class="px-4 py-3">Nama</th>
                        <th class="px-4 py-3">Mulai</th>
                        <th class="px-4 py-3">Selesai</th>
                        <th class="px-4 py-3">Nilai</th>
                        <th class="px-4 py-3">Token</th>
                        <th class="px-4 py-3">Status</th>
                        <th class="px-4 py-3">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-sm">
                    @forelse ($participants as $p)
                        <tr>
                            <td class="px-4 py-2">{{ $p->user->name ?? '-' }}</td>
                            <td class="px-4 py-2">{{ $p->start_date ?? '-' }}</td>
                            <td class="px-4 py-2">{{ $p->end_date ?? '-' }}</td>
                            <td class="px-4 py-2">{{ $p->point ?? 0 }}</td>
                            <td class="px-4 py-2">{{ $p->token ?? '-' }}</td>
                            <td class="px-4 py-2">
                                @php
                                    $statusColor = match ($p->status) {
                                        'not_started' => 'bg-gray-200 text-gray-800',
                                        'in_progress' => 'bg-yellow-200 text-yellow-800',
                                        'finished' => 'bg-green-200 text-green-800',
                                        default => 'bg-red-200 text-red-800',
                                    };
                                    @endphp
                                <span class="px-2 py-1 rounded text-xs font-semibold {{ $statusColor }}">
                                    {{ ucfirst(str_replace('_', ' ', $p->status)) }}
                                </span>
                            </td>
                            <td class="px-4 py-2">
                                @if ($exam->type == 'CBT')
                                <a href="{{ route('result.show', ['exam' => $p->exams_id, 'user' => $p->user_id]) }}" class="bg-primary text-white py-1 px-2 text-xs rounded-md text-center">Periksa Soal</a>
                                @endif
                                <a href="{{ route('result.nilai', ['exam' => $p->exams_id, 'user' => $p->user_id]) }}" class="bg-primary text-white py-1 px-2 text-xs rounded-md text-center">Nilai</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-4 text-gray-500">Tidak ada data peserta.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $participants->appends(['search' => $search])->links() }}
        </div>
    </div>
@endsection
