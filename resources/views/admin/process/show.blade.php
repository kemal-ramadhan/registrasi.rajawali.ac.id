@extends('admin.template.template', ['title' => 'Process'])

@section('content')
    <div class="w-full font-sora p-4 bg-white rounded-lg shadow-lg">
        <div class="flex border-b">
            <button class="tab-link px-4 py-2 text-gray-600 border-b-2 border-transparent focus:outline-none"
                data-tab="tab1">Pendaftaran</button>
            <button class="tab-link px-4 py-2 text-gray-600 border-b-2 border-transparent focus:outline-none"
                data-tab="tab2">Biodata</button>
            <button class="tab-link px-4 py-2 text-gray-600 border-b-2 border-transparent focus:outline-none"
                data-tab="tab3">Dokumen Persyaran</button>
            <button class="tab-link px-4 py-2 text-gray-600 border-b-2 border-transparent focus:outline-none"
                data-tab="tab4">Pembayaran</button>
            <button class="tab-link px-4 py-2 text-gray-600 border-b-2 border-transparent focus:outline-none"
                data-tab="tab5">Seleksi</button>
            <button class="tab-link px-4 py-2 text-gray-600 border-b-2 border-transparent focus:outline-none"
                data-tab="tab6">Final</button>
        </div>
        <div class="p-4">
            <div id="tab1" class="tab-content">
                <div class="grid grid-cols-1 md:grid-cols-5 gap-5 items-start">
                    <div
                        class="outline outline-1 outline-primary p-5 rounded-xl flex justify-between w-full col-span-1 md:col-span-3">
                        <div class="flex flex-col gap-1">
                            <h1 class="font-sora text-lg font-semibold">{{ $registrationPath->name }}</h1>
                            <div class="flex gap-5 items-center my-3">
                                <span class="flex gap-2 font-semibold font-sora bg-gray-200 p-2 rounded-xl">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                        class="bi bi-exclamation-circle w-3" viewBox="0 0 16 16">
                                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16" />
                                        <path
                                            d="M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0M7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0z" />
                                    </svg>
                                    {{ $registrationPath->name }}
                                </span>
                                <span class="flex gap-2 font-semibold font-sora bg-gray-200 p-2 rounded-xl">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                        class="bi bi-calendar-week w-3" viewBox="0 0 16 16">
                                        <path
                                            d="M11 6.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm-3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm-5 3a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5z" />
                                        <path
                                            d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5M1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4z" />
                                    </svg>
                                    <span class="text-xs">
                                        {{ $registrationPath->start_date }} s.d
                                        {{ $registrationPath->end_date }}
                                    </span>
                                </span>
                                <span class="flex gap-2 font-semibold font-sora bg-gray-200 p-2 rounded-xl">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                        class="bi bi-credit-card-2-front w-3" viewBox="0 0 16 16">
                                        <path
                                            d="M14 3a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1zM2 2a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2z" />
                                        <path
                                            d="M2 5.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5zm0 3a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5m3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5m3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5m3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5" />
                                    </svg>
                                    Rp. {{ number_format($registrationPath->amount, 0, ',', '.') }}
                                </span>
                            </div>
                            <h1 class="text-xs">{{ $registrationPath->title }}</h1>
                            <p>{!! $registrationPath->description !!}</p>
                        </div>
                    </div>
                    <div class="outline outline-1 outline-primary p-5 rounded-xl col-span-1 md:col-span-2">
                        <div class="flex gap-5 items-center">
                            <div>
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}" alt="Profile"
                                    class="w-20 rounded-full">
                            </div>
                            <div class="flex flex-col gap-1">
                                <h1 class="font-sora text-xs font-bold">{{ $user->name }}</h1>
                                <small class="font-sora text-xs font-thin">{{ $user->email }}</small>
                                <small class="font-sora text-xs font-thin">{{ $user->phone }}</small>
                            </div>
                        </div>
                        <hr class="my-3">
                        <div class="flex flex-col gap-5">
                            <table class="w-full border-collapse border border-gray-300">
                                <tr class="border-b border-gray-300">
    <td class="p-3 font-semibold bg-gray-100">Nomor Pendaftaran</td>
    <td class="p-3">{{ $user->created_at->format('Ymd') }}{{ $user->id }}-{{ $programOption->id }}</td>
</tr>                                <tr class="border-b border-gray-300">
                                    <td class="p-3 font-semibold bg-gray-100">Tanggal Registrasi</td>
                                    <td class="p-3">{{ $programOption->created_at }}</td>
                                </tr>
                                <tr class="border-b border-gray-300">
                                    <td class="p-3 font-semibold bg-gray-100">Jalur Pilihan</td>
                                    <td class="p-3">{{ $programOption->registrationPath->name }},
                                        {{ $programOption->registrationPath->title }}</td>
                                </tr>
                                <tr class="border-b border-gray-300">
                                    <td class="p-3 font-semibold bg-gray-100">Pilihan</td>
                                    <td class="p-3">{{ $programOption->departement->name }}</td>
                                </tr>
                                <tr class="border-b border-gray-300">
                                    <td class="p-3 font-semibold bg-gray-100">Status Registrasi</td>
                                    <td class="p-3">{{ $programOption->status }}</td>
                                </tr>
                                <tr class="border-b border-gray-300">
                                    <td class="p-3 font-semibold bg-gray-100">NIM</td>
                                    <td class="p-3">{{ $mahasiswa->nim ?? '-' }}</td>
                                </tr>
                                <tr class="border-b border-gray-300">
                                    <td class="p-3 font-semibold bg-gray-100">Tahun Angkatan</td>
                                    <td class="p-3">{{ $mahasiswa->angkatan ?? '-' }}</td>
                                </tr>
                            </table>
                        </div>
                        <hr class="my-3">
                        <div class="flex flex-col gap-3">
                            <label for="">Ubah Status Registrasi</label>
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
                                    'LULUS',
                                ];
                            @endphp

@if ($programOption->status == 'Generate NIM')
                                <form id="myForm" action="{{ route('process.generate.nim', $programOption->id) }}"
                                    method="post" class="flex items-center gap-3 w-full">
                                    @csrf
                                    <button type="button" onclick="confirmSubmit()"
                                        class="outline outline-1 outline-gray-500 p-3 w-full text-lg rounded-xl bg-primary text-white">Generate
                                        Nim dan Nyatakan Lulus</button>
                                </form>
                            @else
                                <form id="myForm" action="{{ route('process.update.status', $programOption->id) }}"
                                    method="post" class="flex items-center gap-3 w-full">
                                    @csrf
                                    <select name="status" id="status"
                                        class="outline outline-1 outline-gray-500 p-3 rounded-xl w-full">
                                        @foreach ($statuses as $status)
                                            <option value="{{ $status }}"
                                                {{ $programOption->status == $status ? 'selected' : '' }}>
                                                {{ $status }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @if ($programOption->status = 'LULUS' && $programOption->status != 'Generate NIM')
                                        <button type="button" onclick="confirmSubmit()"
                                            class="outline outline-1 outline-gray-500 p-3 rounded-xl bg-primary text-white">Update</button>
                                    @endif
                                </form>
                            @endif


                        </div>
                    </div>
                </div>
            </div>
            {{-- biodata --}}
            <div id="tab2" class="tab-content hidden">
                <div class="flex flex-col gap-3">
                    <table class="w-full border-collapse border border-gray-300">
                        {{-- Personal Data --}}
                        <tr class="border-b border-gray-300">
                            <td class="p-3 font-semibold bg-gray-100" colspan="2">Personal Data</td>
                        </tr>
                        <tr>
                            <td class="p-3 font-semibold bg-gray-100">Nama Lengkap</td>
                            <td class="p-3">{{ $user->name }}</td>
                        </tr>
                        <tr>
                            <td class="p-3 font-semibold bg-gray-100">Alamat Email</td>
                            <td class="p-3">{{ $user->email }}</td>
                        </tr>
                        <tr>
                            <td class="p-3 font-semibold bg-gray-100">No Telepon / WhatsApp</td>
                            <td class="p-3">{{ $user->phone }}</td>
                        </tr>
                        <tr>
                            <td class="p-3 font-semibold bg-gray-100">NIK</td>
                            <td class="p-3">{{ optional($personalData)->nik ?? 'Belum diisi' }}</td>
                        </tr>
                        <tr>
                            <td class="p-3 font-semibold bg-gray-100">NISN</td>
                            <td class="p-3">{{ optional($personalData)->nisn ?? 'Belum diisi' }}</td>
                        </tr>
                        <tr>
                            <td class="p-3 font-semibold bg-gray-100">Tempat, Tanggal Lahir</td>
                            <td class="p-3">{{ optional($personalData)->place_of_birth ?? '-' }},
                                {{ optional($personalData)->date_of_birth ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td class="p-3 font-semibold bg-gray-100">Agama</td>
                            <td class="p-3">{{ optional($personalData)->religion ?? 'Belum diisi' }}</td>
                        </tr>
                        <tr>
                            <td class="p-3 font-semibold bg-gray-100">Media Informasi PMB</td>
                            <td class="p-3">{{ optional($personalData)->media_information ?? 'Belum diisi' }}</td>
                        </tr>

                        {{-- Pendidikan --}}
                        <tr>
                            <td class="p-3 font-semibold bg-gray-100" colspan="2">Pendidikan Terakhir</td>
                        </tr>
                        <tr>
                            <td class="p-3 font-semibold bg-gray-100">Pendidikan Terakhir</td>
                            <td class="p-3">{{ optional($education)->last_education ?? 'Belum diisi' }}</td>
                        </tr>
                        <tr>
                            <td class="p-3 font-semibold bg-gray-100">Negara</td>
                            <td class="p-3">{{ optional($education)->country ?? 'Belum diisi' }}</td>
                        </tr>
                        <tr>
                            <td class="p-3 font-semibold bg-gray-100">Provinsi</td>
                            <td class="p-3">{{ optional($education)->province ?? 'Belum diisi' }}</td>
                        </tr>
                        <tr>
                            <td class="p-3 font-semibold bg-gray-100">Kota / Kabupaten</td>
                            <td class="p-3">{{ optional($education)->city ?? 'Belum diisi' }}</td>
                        </tr>
                        <tr>
                            <td class="p-3 font-semibold bg-gray-100">Jenis Sekolah</td>
                            <td class="p-3">{{ optional($education)->type ?? 'Belum diisi' }}</td>
                        </tr>
                        <tr>
                            <td class="p-3 font-semibold bg-gray-100">Nama Sekolah</td>
                            <td class="p-3">{{ optional($education)->name_of_institution ?? 'Belum diisi' }}</td>
                        </tr>
                        <tr>
                            <td class="p-3 font-semibold bg-gray-100">Jurusan / Program Studi</td>
                            <td class="p-3">{{ optional($education)->departement ?? 'Belum diisi' }}</td>
                        </tr>
                        <tr>
                            <td class="p-3 font-semibold bg-gray-100">Tahun Lulus</td>
                            <td class="p-3">{{ optional($education)->year_of_graduation ?? 'Belum diisi' }}</td>
                        </tr>
                        <tr>
                            <td class="p-3 font-semibold bg-gray-100">Nilai Akhir / GPA / IPK</td>
                            <td class="p-3">{{ optional($education)->grade ?? 'Belum diisi' }}</td>
                        </tr>

                        {{-- Alamat --}}
                        <tr>
                            <td class="p-3 font-semibold bg-gray-100" colspan="2">Alamat Pribadi</td>
                        </tr>
                        <tr>
                            <td class="p-3 font-semibold bg-gray-100">Negara</td>
                            <td class="p-3">{{ optional($address)->country ?? 'Belum diisi' }}</td>
                        </tr>
                        <tr>
                            <td class="p-3 font-semibold bg-gray-100">Provinsi</td>
                            <td class="p-3">{{ optional($address)->province ?? 'Belum diisi' }}</td>
                        </tr>
                        <tr>
                            <td class="p-3 font-semibold bg-gray-100">Kota / Kabupaten</td>
                            <td class="p-3">{{ optional($address)->city ?? 'Belum diisi' }}</td>
                        </tr>
                        <tr>
                            <td class="p-3 font-semibold bg-gray-100">Kecamatan</td>
                            <td class="p-3">{{ optional($address)->district ?? 'Belum diisi' }}</td>
                        </tr>
                        <tr>
                            <td class="p-3 font-semibold bg-gray-100">Kelurahan</td>
                            <td class="p-3">{{ optional($address)->village ?? 'Belum diisi' }}</td>
                        </tr>
                        <tr>
                            <td class="p-3 font-semibold bg-gray-100">Kode Pos</td>
                            <td class="p-3">{{ optional($address)->code ?? 'Belum diisi' }}</td>
                        </tr>
                        <tr>
                            <td class="p-3 font-semibold bg-gray-100">Alamat Lengkap</td>
                            <td class="p-3">{{ optional($address)->address ?? 'Belum diisi' }}</td>
                        </tr>

                        {{-- Penghasilan --}}
                        <tr>
                            <td class="p-3 font-semibold bg-gray-100" colspan="2">Penghasilan</td>
                        </tr>
                        <tr>
                            <td class="p-3 font-semibold bg-gray-100">Sumber Penghasilan</td>
                            <td class="p-3">{{ optional($income)->source ?? 'Belum diisi' }}</td>
                        </tr>
                        <tr>
                            <td class="p-3 font-semibold bg-gray-100">Penghasilan</td>
                            <td class="p-3">
                                Rp {{ optional($income)->amount ? number_format($income->amount, 0, ',', '.') : '0' }}
                            </td>
                        </tr>

                        {{-- Keluarga --}}
                        <tr>
                            <td class="p-3 font-semibold bg-gray-100" colspan="2">Keluarga</td>
                        </tr>
                        @forelse ($families as $familie)
                            <tr>
                                <td class="p-3 font-semibold bg-gray-100">Hubungan</td>
                                <td class="p-3">{{ $familie->relation }}</td>
                            </tr>
                            <tr>
                                <td class="p-3 font-semibold bg-gray-100">Nama Lengkap</td>
                                <td class="p-3">{{ $familie->name }}</td>
                            </tr>
                            <tr>
                                <td class="p-3 font-semibold bg-gray-100">Status</td>
                                <td class="p-3">{{ $familie->status }}</td>
                            </tr>
                            <tr>
                                <td class="p-3 font-semibold bg-gray-100">Nomor Telepon</td>
                                <td class="p-3">{{ $familie->phone }}</td>
                            </tr>
                            <tr>
                                <td class="p-3 font-semibold bg-gray-100">Pekerjaan</td>
                                <td class="p-3">{{ $familie->job }}</td>
                            </tr>
                            <tr>
                                <td class="p-3 font-semibold bg-gray-100">Pendidikan</td>
                                <td class="p-3">{{ $familie->education }}</td>
                            </tr>
                            <tr>
                                <td class="p-3 font-semibold bg-gray-100">Alamat</td>
                                <td class="p-3">{{ $familie->address }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td class="p-3 text-center" colspan="2">Belum ada data keluarga.</td>
                            </tr>
                        @endforelse
                    </table>
                </div>
            </div>
            <!-- Form Update Dokumen -->
            <form action="{{ route('process.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="hidden" name="program_option_id" value="{{ $programOption->id }}">
                <div id="tab3" class="tab-content hidden">
                    <div class="grid grid-cols-1">
                        @php
                            $dokumenFields = [
                                'personal_foto' => 'Pas Foto Latar Merah',
                                'personal_card' => 'Kartu Identitas',
                            ];
                        @endphp

                        <table class="w-full border-collapse border border-gray-300">
                            <thead>
                                <tr class="border-b border-gray-300">
                                    <td class="p-3 font-semibold bg-gray-100" colspan="4">Dokumen Awal</td>
                                </tr>
                                <tr class="bg-gray-100">
                                    <th class="border border-gray-300 p-3 text-left">Dokumen</th>
                                    <th class="border border-gray-300 p-3 text-left">File</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($dokumenFields as $field => $label)
                                    <tr>
                                        <td class="border border-gray-300 p-3 font-semibold text-sm">{{ $label }}
                                        </td>
                                        <td class="border border-gray-300 p-3 text-center">
                                            @if (!empty($dokumenAwal->$field))
                                                <div class="flex flex-col items-center space-y-2">
                                                    <img src="{{ asset('storage/' . $dokumenAwal->$field) }}"
                                                        alt="Dokumen"
                                                        class="w-16 h-16 object-cover rounded-md border border-gray-300 shadow-sm">
                                                    <a href="{{ asset('storage/' . $dokumenAwal->$field) }}"
                                                        target="_blank"
                                                        class="text-blue-600 hover:text-blue-800 text-sm font-semibold underline">
                                                        Lihat Dokumen
                                                    </a>
                                                </div>
                                            @else
                                                <input type="file" name="{{ $field }}"
                                                    class="py-2 px-3 border border-gray-300 w-full rounded-lg bg-white text-gray-700">
                                                @error($field)
                                                    <small class="text-red-500"><i>{{ $message }}</i></small>
                                                @enderror
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <hr class="my-3">
                        <table class="w-full border-collapse border border-gray-300">
                            <thead>
                                <tr class="border-b border-gray-300">
                                    <td class="p-3 font-semibold bg-gray-100" colspan="4">Komentar Dokumen Awal</td>
                                </tr>
                                <tr class="bg-gray-100">
                                    <th class="border border-gray-300 p-3 text-left">Dokumen</th>
                                    <th class="border border-gray-300 p-3 text-left">File</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="border border-gray-300 p-3">
                                        <textarea name="komentarDokumenAwal" cols="30" rows="3"
                                            class="outline outline-1 outline-gray-400 rounded-lg p-2 w-full text-sm">{{ $dokumenAwal->description ?? '' }}</textarea>
                                    </td>
                                    <td class="border border-gray-300 p-3">
                                        <select name="statusDokumenAwal"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-primary focus:border-primary bg-white text-gray-700 text-sm">
                                            <option value="{{ $dokumenAwal->status ?? '' }}" selected>
                                                {{ $dokumenAwal->status ?? '' }}</option>
                                            <option value="Sesuai">Sesuai</option>
                                            <option value="Tidak Sesuai">Tidak Sesuai</option>
                                        </select>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <hr class="my-3">
                    <div class="grid grid-cols-1">
                        <table class="w-full border-collapse border border-gray-300">
                            <thead>
                                <tr class="border-b border-gray-300">
                                    <td class="p-3 font-semibold bg-gray-100" colspan="4">Dokumen Persyaratan Jalur
                                    </td>
                                </tr>
                                <tr class="bg-gray-200">
                                    <th class="border border-gray-300 p-3">Nama Dokumen</th>
                                    <th class="border border-gray-300 p-3">File</th>
                                    <th class="border border-gray-300 p-3">Komentar</th>
                                    <th class="border border-gray-300 p-3">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($dokumenSyarats as $syarat)
                                    @php
                                        $dokumenRequirement = \App\Models\DocumentRequirement::where([
                                            'program_option_id' => $programOption->id,
                                            'registration_dokumen_id' => $syarat->id,
                                        ])->first();
                                    @endphp
                                    <tr>
                                        <td class="border border-gray-300 p-3 font-semibold">{{ $syarat->dokumen_name }}
                                        </td>
                                        <td class="border border-gray-300 p-3 text-center">
                                            @if ($dokumenRequirement && $dokumenRequirement->file)
                                                <div class="flex flex-col items-center space-y-2">
                                                    <img src="{{ asset('storage/' . $dokumenRequirement->file) }}"
                                                        alt="Dokumen"
                                                        class="w-16 h-16 object-cover rounded-md border border-gray-300 shadow-sm">
                                                    <a href="{{ asset('storage/' . $dokumenRequirement->file) }}"
                                                        target="_blank"
                                                        class="text-blue-600 hover:text-blue-800 text-sm font-semibold underline">
                                                        Lihat Dokumen
                                                    </a>
                                                </div>
                                            @endif
                                        </td>
                                        <td class="border border-gray-300 p-3">
                                            <textarea name="komentar[{{ $syarat->id }}]" cols="30" rows="2"
                                                class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-primary focus:border-primary bg-white text-gray-700">{{ $dokumenRequirement->description ?? '' }}</textarea>
                                        </td>
                                        {{-- <td class="border border-gray-300 p-3">
                                            <select name="status[{{ $syarat->id }}]"
                                                class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-primary focus:border-primary bg-white text-gray-700">
                                                <option value="Sesuai" {{ $dokumenRequirement->status == 'Sesuai' ? 'selected' : '' }}>
                                                    Sesuai
                                                </option>
                                                <option value="Tidak Sesuai" {{ $dokumenRequirement->status == 'Tidak Sesuai' ? 'selected' : '' }}>
                                                    Tidak Sesuai
                                                </option>
                                                <option value="Menunggu Verifikasi" {{ $dokumenRequirement->status == 'Menunggu Verifikasi' ? 'selected' : '' }}>
                                                    Menunggu Verifikasi
                                                </option>
                                            </select>                                             --}}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="flex items-center justify-end my-5">
                            <button type="submit"
                                class="px-4 py-2 bg-primary text-white font-semibold rounded-lg hover:bg-gray-900">
                                Simpan Perubahan
                            </button>
                        </div>
            </form>
        </div>
    </div>

    <div id="tab4" class="tab-content hidden">

        @if ($pembayaranBk)
            {{-- Pembayaran BK --}}
            <table class="w-full border-collapse border border-gray-300">
                <tr class="border-b border-gray-300">
                    <td class="p-3 font-semibold bg-gray-100" colspan="2">Riwayat Pembayaran Dari Guru BK</td>
                </tr>
                <tr class="border-b border-gray-300">
                    <td class="p-3 font-semibold bg-gray-100">Type Pembayaran</td>
                    <td class="p-3">{{ $pembayaranBk->type }}</td>
                </tr>
                <tr class="border-b border-gray-300">
                    <td class="p-3 font-semibold bg-gray-100">Nominal</td>
                    <td class="p-3">{{ $pembayaranBk->nominal }}</td>
                </tr>
                <tr class="border-b border-gray-300">
                    <td class="p-3 font-semibold bg-gray-100">Status Pembayaran Guru BK</td>
                    <td class="p-3">{{ $pembayaranBk->status_approve }}</td>
                </tr>
                <tr class="border-b border-gray-300">
                    <td class="p-3 font-semibold bg-gray-100">Status Approve Keuangan Kampus</td>
                    <td class="p-3">
                        <form id="myForm" action="{{ route('process.update.paymant.bk', $pembayaranBk->id) }}"
                            method="post" class="grid grid-cols-2 gap-3">
                            @csrf
                            <input type="hidden" name="paymant_id" value="{{ $paymants[0]->id }}">
                            <select name="status_keuangan"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-primary focus:border-primary bg-white text-gray-700">

                                <!-- Opsi 1: Status saat ini -->
                                <option value="{{ $pembayaranBk->status_keuangan }}" selected>
                                    {{ $pembayaranBk->status_keuangan }}</option>
                                <option value="Tagihan">Tagihan</option>
                                <option value="Success">Success</option>

                            </select>

                            <button type="submit" onclick="confirmSubmit()"
                                class="py-2 px-3 bg-primary rounded-lg text-white">Ubah Status</button>
                        </form>
                    </td>
                </tr>
            </table>
        @endif
        {{-- Pembayaran --}}
        <table class="w-full border-collapse border border-gray-300 mt-5">
            <tr class="border-b border-gray-300">
                <td class="p-3 font-semibold bg-gray-100" colspan="2">Riwayat Pembayaran Formulir Pendaftaran</td>
            </tr>
            @foreach ($paymants as $paymant)
                <tr class="border-b border-gray-300">
                    <td class="p-3 font-semibold bg-gray-100">Order ID</td>
                    <td class="p-3">{{ $paymant->merchant_order_id }}</td>
                </tr>
                <tr class="border-b border-gray-300">
                    <td class="p-3 font-semibold bg-gray-100">Metode Pembayaran</td>
                    <td class="p-3">{{ $paymant->payment_method }}</td>
                </tr>
                <tr class="border-b border-gray-300">
                    <td class="p-3 font-semibold bg-gray-100">Nominal</td>
                    <td class="p-3">{{ $paymant->amount }}</td>
                </tr>
                <tr class="border-b border-gray-300">
                    <td class="p-3 font-semibold bg-gray-100">Status</td>
                    <td class="p-3">
                        <form id="myForm" action="{{ route('process.update.paymant', $paymant->id) }}" method="post"
                            class="grid grid-cols-2 gap-3">
                            @csrf
                            <select name="status"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-primary focus:border-primary bg-white text-gray-700">

                                <!-- Opsi 1: Status saat ini -->

                                <option value="{{ $paymant->payment }}" selected>{{ $paymant->status }}</option>
                                <option value="EXPIRED">EXPIRED</option>

                                <!-- Opsi 2: Jika status saat ini bukan 'SUCCESS', tampilkan 'SUCCESS' -->
                                @if ($paymant->status !== 'SUCCESS')
                                    <option value="SUCCESS">SUCCESS</option>
                                    @endif
                            </select>

                            <button type="submit"
                                class="py-2 px-3 bg-primary rounded-lg text-white">Ubah Paksa Status</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
        <div class="mt-5">
            <table class="w-full border-collapse border border-gray-300">
                <tr class="border-b border-gray-300">
                    <td class="p-3 font-semibold bg-gray-100" colspan="2">Riwayat Pembayaran</td>
                </tr>
                @foreach ($paymantMahasiswas as $item)
                    <tr class="border-b border-gray-300">
                        <td class="p-3 font-semibold bg-gray-100">Pembayaran</td>
                        <td class="p-3">{{ $item->biaya->biaya }}</td>
                    </tr>
                    <tr class="border-b border-gray-300">
                        <td class="p-3 font-semibold bg-gray-100">Order ID</td>
                        <td class="p-3">{{ $item->merchant_order_id }}</td>
                    </tr>
                    <tr class="border-b border-gray-300">
                        <td class="p-3 font-semibold bg-gray-100">Metode Pembayaran</td>
                        <td class="p-3">{{ $item->payment_method }}</td>
                    </tr>
                    <tr class="border-b border-gray-300">
                        <td class="p-3 font-semibold bg-gray-100">Nominal</td>
                        <td class="p-3">{{ $item->amount }}</td>
                    </tr>
                    <tr class="border-b border-gray-300">
                        <td class="p-3 font-semibold bg-gray-100">Status</td>
                        <td class="p-3">
                            <form id="myForm" action="{{ route('process.update.paymantMahasiswa', $item->id) }}"
                                method="post" class="grid grid-cols-2 gap-3">
                                @csrf

                                <select name="status"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-primary focus:border-primary bg-white text-gray-700">

                                    <!-- Opsi 1: Status saat ini -->
                                    <option value="{{ $item->status }}" selected>{{ $item->status }}</option>
                                    <option value="EXPIRED">EXPIRED</option>

                                    <!-- Opsi 2: Jika status saat ini bukan 'SUCCESS', tampilkan 'SUCCESS' -->
                                    @if ($item->status !== 'SUCCESS')
                                        <option value="SUCCESS">SUCCESS</option>
                                    @endif


                                </select>

                                <button type="submit"
                                    class="py-2 px-3 bg-primary rounded-lg text-white">Ubah Paksa Status</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
    <div id="tab5" class="tab-content hidden">
        {{-- akun IKes Rajawali --}}
        @if ($exam)
            <div class="flex flex-col gap-3">
                <h1 class="font-sora font-semibold text-gray-800">Program Pilihan :
                    @foreach ($exam->registration_path->programOptions as $option)
                        {{ $option->departement->name ?? '-' }}
                    @endforeach
                </h1>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                    <div class="flex items-center gap-3 bg-opacity-10 bg-primary shadow-sm p-2 rounded-md">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                            class="bi bi-exclamation-circle w-3 h-3" viewBox="0 0 16 16">
                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16" />
                            <path
                                d="M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0M7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0z" />
                        </svg>
                        <span class="font-sora text-xs">{{ $exam->duration }} Menit</span>
                    </div>

                    <div class="flex items-center gap-3 bg-opacity-10 bg-primary shadow-sm p-2 rounded-md">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-calendar-week w-3 h-3"
                            viewBox="0 0 16 16">
                            <path
                                d="M11 6.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm-3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm-5 3a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5z" />
                            <path
                                d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5M1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4z" />
                        </svg>
                        @php
                            $start = date('d F Y', strtotime($exam->start_date));
                        @endphp

                        <span class="font-sora text-xs">{{ $start }}</span>
                    </div>

                    <div class="flex items-center gap-3 bg-opacity-10 bg-primary shadow-sm p-2 rounded-md">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-hourglass-split w-3 h-3"
                            viewBox="0 0 16 16">
                            <path
                                d="M2.5 15a.5.5 0 1 1 0-1h1v-1a4.5 4.5 0 0 1 2.557-4.06c.29-.139.443-.377.443-.59v-.7c0-.213-.154-.451-.443-.59A4.5 4.5 0 0 1 3.5 3V2h-1a.5.5 0 0 1 0-1h11a.5.5 0 0 1 0 1h-1v1a4.5 4.5 0 0 1-2.557 4.06c-.29.139-.443.377-.443.59v.7c0 .213.154.451.443.59A4.5 4.5 0 0 1 12.5 13v1h1a.5.5 0 0 1 0 1zm2-13v1c0 .537.12 1.045.337 1.5h6.326c.216-.455.337-.963.337-1.5V2zm3 6.35c0 .701-.478 1.236-1.011 1.492A3.5 3.5 0 0 0 4.5 13s.866-1.299 3-1.48zm1 0v3.17c2.134.181 3 1.48 3 1.48a3.5 3.5 0 0 0-1.989-3.158C8.978 9.586 8.5 9.052 8.5 8.351z" />
                        </svg>
                        <span class="font-sora text-xs">
                            Status Ujian:
                            <span
                                class="inline-block px-2 py-0.5 rounded-md text-xs font-semibold bg-green-100 text-green-700">
                                {{ $exam->pengerjaan }}
                            </span>
                        </span>
                    </div>
                </div>
                <hr class="my-3">
                <div class="max-w-3xl mx-auto bg-white border border-gray-200 rounded-2xl shadow-sm p-8">
                    <h2 class="text-2xl md:text-3xl font-semibold text-gray-800 mb-8">🧾 Detail Hasil Ujian</h2>

                    <dl class="space-y-6">
                        <div class="flex items-start justify-between">
                            <dt class="text-gray-500">⏱️ Mulai Ujian</dt>
                            <dd class="text-gray-900 font-medium">{{ $participant->start_date ?? '-' }}</dd>
                        </div>

                        <div class="flex items-start justify-between">
                            <dt class="text-gray-500">✅ Selesai Ujian</dt>
                            <dd class="text-gray-900 font-medium">{{ $participant->end_date ?? '-' }}</dd>
                        </div>

                        <div class="flex items-start justify-between">
                            <dt class="text-gray-500">📊 Nilai</dt>
                            <dd class="text-blue-600 text-lg font-semibold">{{ $participant->point ?? 0 }}</dd>
                        </div>

                        <div class="flex items-start justify-between">
                            <dt class="text-gray-500">🔐 Token</dt>
                            <dd class="text-gray-900 font-medium">{{ $participant->token ?? '-' }}</dd>
                        </div>

                        <div class="flex items-start justify-between">
                            <dt class="text-gray-500">📌 Status</dt>
                            @php
                                $statusColor = match ($participant->status ?? '-') {
                                    'not_started' => 'bg-gray-100 text-gray-700',
                                    'in_progress' => 'bg-yellow-100 text-yellow-800',
                                    'finished' => 'bg-green-100 text-green-800',
                                    default => 'bg-red-100 text-red-800',
                                };
                            @endphp
                            <dd>
                                <span class="px-3 py-1 rounded-full text-sm font-medium {{ $statusColor }}">
                                    {{ ucfirst(str_replace('_', ' ', $participant->status ?? '-')) }}
                                </span>
                            </dd>
                        </div>
                    </dl>
                </div>

                <div class="w-full md:w-1/2 md:mx-auto">
                    <!-- Tombol Dummy -->
                    <div class="mx-auto text-center mt-10">
                        <a href="{{ route('result.show', ['exam' => $exam->id, 'user' => $user->id]) }}"
                            class="bg-primary text-white py-2 px-3 rounded-md text-center">Periksa Seleksi</a>
                    </div>

                </div>
            </div>
        @else
            <div class="flex flex-col gap-3 items-center justify-center h-full">
                <img src="{{ asset('assets/icons/empty_data.svg') }}" alt="empty" class="w-40">
                <div class="text-center gap-2 flex flex-col items-center justify-center mb-5">
                    <h1 class="font-sora font-semibold text-2xl">Tidak Ada Seleksi Lisan Maupun Tulisan pada jalur ini
                    </h1>
                    <small class="font-sora font-semibold">Silahkan koordinasikan dan pilih menu bantuan jika ada masalah
                        atau kendala</small>
                </div>
            </div>
        @endif
    </div>
    <div id="tab6" class="tab-content hidden">
        {{-- akun IKes Rajawali --}}
        <div class="flex flex-col gap-3">
            <form action="{{ route('process.store') }}" id="myFormAkun" method="post"
                class="outline outline-1 outline-gray-500 p-3 rounded-xl w-full md:w-1/2">
                @csrf
                <input type="hidden" name="user_id" value="{{ $user->id }}">
                <input type="hidden" name="departement_id" value="{{ $programOption->departement->id }}">
                <h1 class="font-sora text-center my-3 font-bold text-1xl">Generate NIM</h1>

                @php
                    $userID = $user->id;
                    $userCODE = $user->created_at->format('Ymd');

                    $nim = $userID . $userCODE;
                @endphp
                <!-- Username Field -->
                <div class="flex flex-col gap-3 mb-3">
                    <label for="nim" class="font-sora font-semibold">Number Induk Mahasiswa (NIM)</label>
                    <input type="text" name="nim" value="{{ $mahasiswa ? $mahasiswa->nim : '' }}" required
                        class="px-4 py-2 border rounded-xl outline outline-1 h-10 outline-primary">
                    @error('nim')
                        <div>
                            <small class="text-red-500"><i>{{ $message }}</i></small>
                        </div>
                    @enderror
                </div>

                <!-- Password Field -->
                <div class="flex flex-col gap-3 mb-3">
                    <label for="angkatan" class="font-sora font-semibold">Angkatan</label>
                    <input type="text" name="angkatan" value="{{ $mahasiswa ? $mahasiswa->angkatan : '' }}"
                        class="px-4 py-2 border rounded-xl outline outline-1 h-10 outline-primary">
                    @error('angkatan')
                        <div>
                            <small class="text-red-500"><i>{{ $message }}</i></small>
                        </div>
                    @enderror
                </div>

                <!-- Submit Button -->
                {{-- <div class="flex items-center justify-end gap-3">
                    <button type="button" id="submitBtn"
                        class="py-3 px-5 text-center bg-primary text-white font-sora font-semibold rounded-lg">Simpan</button>
                </div> --}}
            </form>
        </div>
    </div>
    </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const tabs = document.querySelectorAll(".tab-link");
            const contents = document.querySelectorAll(".tab-content");

            tabs.forEach(tab => {
                tab.addEventListener("click", function() {
                    tabs.forEach(t => t.classList.remove("border-primary", "text-blue-500"));
                    contents.forEach(c => c.classList.add("hidden"));

                    this.classList.add("border-primary", "text-blue-500");
                    document.getElementById(this.dataset.tab).classList.remove("hidden");
                });
            });
        });
    </script>

    <script>
        function confirmSubmit() {
            Swal.fire({
                title: "Apakah Anda yakin?",
                text: "Status akan diperbarui!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya, Ubah!",
                cancelButtonText: "Batal"
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById("myForm").submit();
                }
            });
        }
    </script>

    <script>
        document.getElementById('submitBtn').addEventListener('click', function(e) {
            Swal.fire({
                title: "Apakah Anda yakin?",
                text: "Data akan disimpan!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya, Simpan!",
                cancelButtonText: "Batal"
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('myFormAkun').submit(); // Ganti dengan ID form kamu
                }
            });
        });
    </script>
@endsection
