@extends('customer.template.template', ['title' => 'Menu Utama', 'menu' => 'pendaftaran'])

@section('content')
    <div class="w-full mb-20">
        <div class="w-full">
            {{-- Breadcrumb --}}
            <div class="w-full bg-white md:flex items-center p-5 rounded-2xl outline outline-1 outline-gray-200 mb-5">
                <div class="flex gap-2">
                    <small class="font-sora flex gap-2">
                        <span>
                            <a href="{{ route('registration.option', ['id' => $programOption->id]) }}"
                                class="font-bold text-primary">Pendaftaran / </a>
                            <a href="{{ route('registration.option.paymant', ['id' => $programOption->id]) }}"
                                class="font-bold text-primary">Pembayaran / </a>
                            <a href="{{ route('registration.option.document', ['id' => $programOption->id]) }}"
                                class="font-bold text-primary">Persyaratan / </a>
                            <a href="{{ route('registration.option.test', ['id' => $programOption->id]) }}"
                                class="">Kartu Peserta </a>
                        </span>
                    </small>
                </div>
            </div>

            {{-- kontent --}}
            <div class="md:col-span-6 p-5 bg-white outline outline-1 outline-gray-200 rounded-3xl">
                <form action="{{ route('registration.option.document.store') }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="program_option_id" value="{{ $programOption->id }}">

                    <div class="flex gap-2">
                        <h1 class="font-sora font-semibold text-1xl">Persyaratan Jalur</h1>
                    </div>
                    <hr class="my-3">

                    {{-- Dokumen Awal --}}
                    <h1 class="font-sora font-semibold mb-5">Dokumen Awal</h1>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                        @php
                            $dokumenFields = [
                                'personal_foto' => 'Pas Foto Latar Merah',
                                'personal_card' => 'Kartu Identitas',
                                // 'family_foto' => 'Foto Keluarga',
                                // 'family_card' => 'Kartu Keluarga',
                            ];
                        @endphp

                        @foreach ($dokumenFields as $field => $label)
                            <div class="flex flex-col mb-3">
                                <label for="{{ $field }}" class="font-sora font-semibold">{{ $label }}</label>

                                @if (!empty($dokumenAwal->$field))
                                    <div class="relative mt-2 flex flex-col gap-2 justify-start items-start">
                                        {{-- Gambar Dokumen --}}
                                        @php
                                            $filePath = 'storage/' . $dokumenAwal->$field;
                                            $extension = pathinfo($filePath, PATHINFO_EXTENSION);
                                        @endphp

                                        @if (in_array(strtolower($extension), ['jpg', 'jpeg', 'png', 'gif', 'webp']))
                                            <img src="{{ asset($filePath) }}" alt="Dokumen"
                                                class="max-w-30 min-w-25 rounded-md border border-gray-300">
                                        @elseif(strtolower($extension) === 'pdf')
                                            <iframe src="{{ asset($filePath) }}"
                                                class="w-full h-96 rounded-md border border-gray-300"></iframe>
                                        @else
                                            <p class="text-red-500">Format file tidak didukung.</p>
                                        @endif


                                        {{-- Tombol Hapus di Pojok Kanan Atas --}}
                                        <button type="button"
                                            onclick="deleteFile('{{ route('registration.option.document.delete', ['field' => $field]) }}')"
                                            class="absolute -top-2 -right-2 bg-red-500 text-white p-1 rounded-full shadow-md hover:bg-red-700 transition">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24"
                                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round">
                                                <polyline points="3 6 5 6 21 6"></polyline>
                                                <path
                                                    d="M19 6l-2 14a2 2 0 0 1-2 2H9a2 2 0 0 1-2-2L5 6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                                </path>
                                                <line x1="10" y1="11" x2="10" y2="17"></line>
                                                <line x1="14" y1="11" x2="14" y2="17"></line>
                                            </svg>
                                        </button>
                                    </div>
                                @else
                                    <input type="file" name="{{ $field }}" id="input-{{ $field }}"
                                        class="hidden" onchange="previewFile(event, '{{ $field }}')">

                                    <label for="input-{{ $field }}"
                                        class="cursor-pointer flex items-center justify-center w-full px-4 py-6 bg-white text-blue-600 rounded-xl border-2 border-dashed border-gray-300 hover:bg-blue-50 transition">
                                        <div class="flex flex-col items-center" id="preview-wrapper-{{ $field }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 mb-2 text-blue-400"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M4 16v1a2 2 0 002 2h12a2 2 0 002-2v-1M12 12v9m0-9L8.5 15.5M12 12l3.5 3.5M12 3v9" />
                                            </svg>
                                            <p class="text-sm text-gray-500">Klik untuk unggah atau seret ke sini</p>
                                            <p class="text-xs text-gray-400 mt-1">Max: 2MB, jpg/png/pdf</p>
                                        </div>
                                    </label>

                                    {{-- Tempat preview --}}
                                    <div class="mt-3" id="preview-wrapper-{{ $field }}">
                                        <img id="preview-image-{{ $field }}" class="max-w-xs rounded hidden" />
                                        <iframe id="preview-pdf-{{ $field }}"
                                            class="w-full h-64 rounded border hidden"></iframe>
                                    </div>
                                    @error($field)
                                        <small class="text-red-500"><i>{{ $message }}</i></small>
                                    @enderror
                                @endif
                            </div>
                        @endforeach
                    </div>
                    <div class="flex flex-col gap-2 outline outline-1 outline-gray-200 p-5 rounded-3xl my-5">
                        <div class="flex flex-col gap-3">
                            <span>Catatan</span>
                            @if ($dokumenAwal && $dokumenAwal->description)
                                <span class="text-xs font-thin">{{ $dokumenAwal->description }}</span>
                            @else
                                <span class="text-xs font-thin">Tidak ada catatan dari admin.</span>
                            @endif
                        </div>
                        <div class="flex items-center justify-between">
                            @isset($dokumenAwal)
                                <span
                                    class="{{ ($dokumenAwal->status ?? '') === 'Tidak Sesuai' ? 'bg-red-500' : 'bg-green-500' }} p-2 rounded-full bg-opacity-80 text-xs">
                                    {{ $dokumenAwal->status ?? '-' }}
                                </span>
                            @else
                            @endisset
                        </div>
                    </div>
                    <hr class="my-3">

                    {{-- Dokumen Persyaratan Jalur --}}
                    <h1 class="font-sora font-semibold mb-5">Dokumen Persyaratan Jalur</h1>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-3 mb-5">
                        @foreach ($dokumenSyarats as $syarat)
                            @php
                                $dokumenRequirement = \App\Models\DocumentRequirement::where([
                                    'program_option_id' => $programOption->id,
                                    'registration_dokumen_id' => $syarat->id,
                                ])->first();
                            @endphp

                            <div class="flex flex-col mb-3">
                                <label for="{{ $syarat->slug_name }}"
                                    class="font-sora font-semibold">{{ $syarat->dokumen_name }}</label>

                                {{-- Deskripsi/Panduan dari Admin (tampil selalu, sebelum & sesudah upload) --}}
                                @if ($syarat->description)
                                    <div class="mt-2 mb-2 p-3 bg-blue-50 rounded-xl text-xs text-gray-600 break-words [&_a]:text-blue-600 [&_a]:underline [&_a]:break-all">
                                        {!! preg_replace('/(https?:\/\/[^\s<]+)/', '<a href="$1" target="_blank" rel="noopener">$1</a>', $syarat->description) !!}
                                    </div>
                                @endif

                                @if ($dokumenRequirement && $dokumenRequirement->file)
                                    <div class="relative mt-2 flex flex-col gap-2 justify-start items-start">

                                        @php
                                            $filePath = 'storage/' . $dokumenRequirement->file;
                                            $extension = pathinfo($filePath, PATHINFO_EXTENSION);
                                        @endphp

                                        @if (in_array(strtolower($extension), ['jpg', 'jpeg', 'png', 'gif', 'webp']))
                                            <img src="{{ asset($filePath) }}" alt="Dokumen"
                                                class="max-w-30 min-w-25 rounded-md border border-gray-300">
                                        @elseif(strtolower($extension) === 'pdf')
                                            <iframe src="{{ asset($filePath) }}"
                                                class="w-full h-96 rounded-md border border-gray-300"></iframe>
                                        @else
                                            <p class="text-red-500">Format file tidak didukung.</p>
                                        @endif


                                        {{-- Tombol Hapus di Pojok Kanan Atas --}}
                                        <button type="button"
                                            onclick="deleteFile('{{ route('registration.option.document.syarat.delete', ['id' => $dokumenRequirement->id]) }}')"
                                            class="absolute -top-2 -right-2 bg-red-500 text-white p-1 rounded-full shadow-md hover:bg-red-700 transition">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24"
                                                fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round">
                                                <polyline points="3 6 5 6 21 6"></polyline>
                                                <path
                                                    d="M19 6l-2 14a2 2 0 0 1-2 2H9a2 2 0 0 1-2-2L5 6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                                </path>
                                                <line x1="10" y1="11" x2="10" y2="17">
                                                </line>
                                                <line x1="14" y1="11" x2="14" y2="17">
                                                </line>
                                            </svg>
                                        </button>
                                        <div
                                            class="flex flex-col gap-2 outline outline-1 outline-gray-200 p-5 rounded-3xl">
                                            <div class="flex flex-col gap-3">
                                                <span>Catatan Admin</span>
                                                @if ($dokumenRequirement->description)
                                                    <span
                                                        class="text-xs font-thin break-words [&_a]:text-blue-600 [&_a]:underline [&_a]:break-all">{!! preg_replace('/(https?:\/\/[^\s<]+)/', '<a href="$1" target="_blank" rel="noopener">$1</a>', $dokumenRequirement->description) !!}</span>
                                                @else
                                                    <span class="text-xs font-thin">Tidak ada catatan dari admin.</span>
                                                @endif
                                            </div>
                                            <div class="flex items-center justify-between">
                                                <span
                                                    class="{{ $dokumenRequirement->status === 'Tidak Sesuai' ? 'bg-red-500' : 'bg-green-500' }} p-2 rounded-full bg-opacity-80 text-xs">
                                                    {{ $dokumenRequirement->status }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <input type="file" name="files[{{ $syarat->slug_name }}]" id="input-{{ $syarat->slug_name }}"
                                        class="hidden" onchange="previewFile(event, '{{ $syarat->slug_name }}')">
                                        
                                    <input type="hidden" name="dokumen_ids[{{ $syarat->slug_name }}]"
                                    value="{{ $syarat->id }}">

                                    <label for="input-{{ $syarat->slug_name }}"
                                        class="cursor-pointer flex items-center justify-center w-full px-4 py-6 bg-white text-blue-600 rounded-xl border-2 border-dashed border-gray-300 hover:bg-blue-50 transition">
                                        <div class="flex flex-col items-center" id="preview-wrapper-{{ $syarat->slug_name }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 mb-2 text-blue-400"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M4 16v1a2 2 0 002 2h12a2 2 0 002-2v-1M12 12v9m0-9L8.5 15.5M12 12l3.5 3.5M12 3v9" />
                                            </svg>
                                            <p class="text-sm text-gray-500">Klik untuk unggah atau seret ke sini</p>
                                            <p class="text-xs text-gray-400 mt-1">Max: 2MB, jpg/png/pdf</p>
                                        </div>
                                    </label>

                                    {{-- Tempat preview --}}
                                    <div class="mt-3" id="preview-wrapper-{{ $syarat->slug_name}}">
                                        <img id="preview-image-{{ $syarat->slug_name}}" class="max-w-xs rounded hidden" />
                                        <iframe id="preview-pdf-{{ $syarat->slug_name}}"
                                            class="w-full h-64 rounded border hidden"></iframe>
                                    </div>
                                    @error($field)
                                        <small class="text-red-500"><i>{{ $message }}</i></small>
                                    @enderror
                                @endif
                            </div>
                        @endforeach
                    </div>

                    <div class="flex items-center justify-between w-full mt-auto">
                        <a href="{{ route('registration.option', ['id' => $programOption->id]) }}"
                            class="font-sora text-gray-900 bg-gray-100 hover:bg-gray-200 py-2 px-3 rounded-full text-center">Kembali</a>
                        <button id="submit-btn"
                            class="font-sora text-white bg-primary hover:bg-primary py-2 px-3 rounded-full text-center"
                            type="submit">
                            <span id="btn-text">Selanjutnya</span>
                            <svg id="loading-spinner" class="hidden animate-spin h-5 w-5 text-white"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                    stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z">
                                </path>
                            </svg>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    {{-- Script untuk hapus file --}}
    <script>
        function deleteFile(url) {
            if (confirm("Apakah Anda yakin ingin menghapus dokumen ini?")) {
                window.location.href = url;
            }
        }
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const form = document.querySelector("form");
            const submitBtn = document.getElementById("submit-btn");
            const btnText = document.getElementById("btn-text");
            const loadingSpinner = document.getElementById("loading-spinner");

            form.addEventListener("submit", function() {
                submitBtn.disabled = true; // Nonaktifkan tombol
                btnText.textContent = "Loading..."; // Ubah teks tombol
                loadingSpinner.classList.remove("hidden"); // Tampilkan spinner
            });
        });
    </script>

    <script>
        function previewFile(event, fieldName) {
            const file = event.target.files[0];
            const imagePreview = document.getElementById('preview-image-' + fieldName);
            const pdfPreview = document.getElementById('preview-pdf-' + fieldName);

            if (!file) return;

            const fileType = file.type;

            // Reset semua preview
            imagePreview.classList.add('hidden');
            pdfPreview.classList.add('hidden');

            const reader = new FileReader();

            reader.onload = function(e) {
                if (fileType.startsWith('image/')) {
                    imagePreview.src = e.target.result;
                    imagePreview.classList.remove('hidden');
                } else if (fileType === 'application/pdf') {
                    pdfPreview.src = e.target.result;
                    pdfPreview.classList.remove('hidden');
                } else {
                    alert("File tidak didukung untuk preview.");
                }
            };

            reader.readAsDataURL(file);
        }
    </script>



    </div>
@endsection