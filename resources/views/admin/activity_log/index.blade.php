@extends('admin.template.template', ['title' => 'Log Aktivitas'])

@section('content')
<div class="bg-white p-5 rounded-2xl flex flex-col gap-6 w-full shadow-sm">

    {{-- Header --}}
    <div class="flex flex-wrap md:flex-nowrap gap-5 items-center justify-between border-b pb-4">
        <div class="flex gap-3 items-center">
            <div class="p-2 rounded-xl bg-primary/10 text-primary">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25zM6.75 12h.008v.008H6.75V12zm0 3h.008v.008H6.75V15zm0 3h.008v.008H6.75V18z" />
                </svg>
            </div>
            <div>
                <h1 class="font-sora font-semibold text-xl text-gray-800">Log Aktivitas Sistem</h1>
                <p class="text-xs text-gray-500 mt-1">Pantau seluruh perubahan data dan aktivitas pengguna.</p>
            </div>
        </div>
    </div>

    {{-- Filter Panel --}}
    <form method="GET" action="{{ route('activitylog.index') }}" class="bg-gray-50 p-4 rounded-xl border border-gray-100 flex flex-col gap-4">
        <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-5 gap-3">
            
            <!-- Pencarian Teks -->
            <div class="flex flex-col gap-1">
                <label class="text-xs font-semibold text-gray-700">Pencarian</label>
                <input type="text" name="search" value="{{ $search }}" placeholder="Nama, email, deskripsi..." class="px-3 py-2 border rounded-md outline-none focus:border-primary focus:ring-1 focus:ring-primary text-sm bg-white">
            </div>

            <!-- Filter Target Data (Model) -->
            <div class="flex flex-col gap-1">
                <label class="text-xs font-semibold text-gray-700">Target Data</label>
                <select name="subject_type" class="px-3 py-2 border rounded-md outline-none focus:border-primary focus:ring-1 focus:ring-primary text-sm bg-white">
                    <option value="">Semua Data</option>
                    @foreach($subjectTypes as $type)
                        <option value="{{ $type }}" {{ $subjectType == $type ? 'selected' : '' }}>
                            {{ $modelLabels[$type] ?? class_basename($type) }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Filter Event -->
            <div class="flex flex-col gap-1">
                <label class="text-xs font-semibold text-gray-700">Jenis Aktivitas</label>
                <select name="event" class="px-3 py-2 border rounded-md outline-none focus:border-primary focus:ring-1 focus:ring-primary text-sm bg-white">
                    <option value="">Semua Aktivitas</option>
                    <option value="created" {{ $event == 'created' ? 'selected' : '' }}>Created (Dibuat)</option>
                    <option value="updated" {{ $event == 'updated' ? 'selected' : '' }}>Updated (Diubah)</option>
                    <option value="deleted" {{ $event == 'deleted' ? 'selected' : '' }}>Deleted (Dihapus)</option>
                </select>
            </div>

            <!-- Filter Tanggal Mulai -->
            <div class="flex flex-col gap-1">
                <label class="text-xs font-semibold text-gray-700">Dari Tanggal</label>
                <input type="date" name="start_date" value="{{ $startDate }}" class="px-3 py-2 border rounded-md outline-none focus:border-primary focus:ring-1 focus:ring-primary text-sm bg-white">
            </div>

            <!-- Filter Tanggal Akhir -->
            <div class="flex flex-col gap-1">
                <label class="text-xs font-semibold text-gray-700">Sampai Tanggal</label>
                <input type="date" name="end_date" value="{{ $endDate }}" class="px-3 py-2 border rounded-md outline-none focus:border-primary focus:ring-1 focus:ring-primary text-sm bg-white">
            </div>
            
        </div>

        <div class="flex items-center justify-between border-t pt-3 mt-1">
            <!-- Tampilkan Baris -->
            <div class="flex items-center gap-2">
                <label class="text-xs font-semibold text-gray-700">Tampilkan:</label>
                <select name="per_page" onchange="this.form.submit()" class="px-2 py-1 border rounded-md outline-none focus:border-primary text-xs bg-white">
                    <option value="10" {{ $perPage == 10 ? 'selected' : '' }}>10</option>
                    <option value="25" {{ $perPage == 25 ? 'selected' : '' }}>25</option>
                    <option value="50" {{ $perPage == 50 ? 'selected' : '' }}>50</option>
                    <option value="100" {{ $perPage == 100 ? 'selected' : '' }}>100</option>
                </select>
                <span class="text-xs text-gray-500">baris</span>
            </div>

            <div class="flex gap-2">
                <a href="{{ route('activitylog.index') }}" class="px-4 py-2 text-sm font-semibold text-gray-600 bg-white border border-gray-300 rounded-md hover:bg-gray-100 transition-colors">
                    Reset Filter
                </a>
                <button type="submit" class="px-4 py-2 text-sm font-semibold text-white bg-primary rounded-md hover:bg-primary/90 transition-colors flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-3 h-3" viewBox="0 0 16 16">
                        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
                    </svg>
                    Terapkan
                </button>
            </div>
        </div>
    </form>

    {{-- Daftar Log --}}
    <div class="w-full overflow-x-auto mt-2 rounded-xl border border-gray-200">
        <table class="w-full border-collapse min-w-max text-sm text-gray-700">
            <thead class="bg-gray-100 border-b border-gray-200">
                <tr>
                    <th class="px-4 py-3 text-left font-semibold">Waktu</th>
                    <th class="px-4 py-3 text-left font-semibold">Pelaku (Aktor)</th>
                    <th class="px-4 py-3 text-left font-semibold">Aktivitas</th>
                    <th class="px-4 py-3 text-left font-semibold">Target Data</th>
                    <th class="px-4 py-3 text-left font-semibold">Detail Perubahan</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($logs as $log)
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="px-4 py-3 whitespace-nowrap align-top">
                        {{ $log->created_at->format('d M Y') }} <br>
                        <span class="text-xs text-gray-400">{{ $log->created_at->format('H:i:s') }}</span>
                    </td>
                    <td class="px-4 py-3 align-top">
                        @if($log->causer)
                            <span class="font-bold text-primary">{{ $log->causer->name }}</span> <br>
                            <span class="text-xs text-gray-500">{{ $log->causer->email }} ({{ $log->causer->role }})</span>
                        @else
                            <span class="text-gray-500 italic">Sistem / Guest</span>
                        @endif
                    </td>
                    <td class="px-4 py-3 align-top">
                        @php
                            $badgeColor = match($log->event) {
                                'created' => 'bg-green-100 text-green-800 border-green-200',
                                'updated' => 'bg-blue-100 text-blue-800 border-blue-200',
                                'deleted' => 'bg-red-100 text-red-800 border-red-200',
                                default => 'bg-gray-100 text-gray-800 border-gray-200',
                            };
                        @endphp
                        <span class="px-3 py-1 rounded-full text-[11px] font-bold border {{ $badgeColor }}">
                            {{ strtoupper($log->event) }}
                        </span>
                    </td>
                    <td class="px-4 py-3 text-gray-700 align-top">
                        @php
                            $modelName = $modelLabels[$log->subject_type] ?? class_basename($log->subject_type);
                        @endphp
                        <span class="font-semibold">{{ $modelName }}</span> <br>
                        <span class="text-[11px] text-gray-400">ID Data: {{ $log->subject_id }}</span>
                    </td>
                    <td class="px-4 py-3 align-top w-1/3">
                        @if($log->properties && count($log->properties) > 0)
                            <button type="button" @click="document.getElementById('detail-{{ $log->id }}').classList.toggle('hidden')" class="text-primary hover:text-primary/80 text-xs font-semibold flex items-center gap-1 transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                  <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                  <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                Toggle Data JSON
                            </button>
                            <div id="detail-{{ $log->id }}" class="hidden mt-3 p-3 bg-gray-100 border rounded-lg text-xs overflow-x-auto shadow-inner">
                                @if(isset($log->properties['old']))
                                    <div class="mb-3">
                                        <strong class="text-red-600 block mb-1">Data Lama (Before):</strong>
                                        <pre class="whitespace-pre-wrap text-[11px] text-gray-700 font-mono bg-white p-2 rounded border">{{ json_encode($log->properties['old'], JSON_PRETTY_PRINT) }}</pre>
                                    </div>
                                @endif
                                @if(isset($log->properties['attributes']))
                                    <div>
                                        <strong class="text-green-600 block mb-1">Data Baru (After):</strong>
                                        <pre class="whitespace-pre-wrap text-[11px] text-gray-700 font-mono bg-white p-2 rounded border">{{ json_encode($log->properties['attributes'], JSON_PRETTY_PRINT) }}</pre>
                                    </div>
                                @endif
                            </div>
                        @else
                            <span class="text-gray-400 italic text-xs">Tidak ada log detail.</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center py-8 text-gray-500 font-medium">Tidak ada aktivitas yang sesuai dengan filter.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-2">
        {{ $logs->appends(request()->query())->links() }}
    </div>

</div>
@endsection