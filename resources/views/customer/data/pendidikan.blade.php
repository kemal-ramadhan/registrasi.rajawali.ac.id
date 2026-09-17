@extends('customer.template.template', ['title' => 'Personal Data', 'menu' => 'profile'])

@section('content')
<div class="w-full">
    <div
        class="w-full bg-white hidden md:flex items-center justify-center p-5 rounded-2xl outline outline-1 outline-gray-200">
        <div class="flex flex-col md:flex-row md:items-center md:gap-3 font-medium font-sora space-y-3 md:space-y-0">

            <!-- Step 1 -->
            <div class="flex items-center gap-2">
                <div class="text-blue-600 bg-blue-100 rounded-md w-6 h-6 flex items-center justify-center shrink-0">
                    1</div>
                <a href="{{ route('personal.data.index') }}" class="text-blue-600 font-semibold hover:underline">Data
                    Pribadi</a>
            </div>

            <div class="hidden md:block text-gray-400">/</div>

            <!-- Step 2 -->
            <div class="flex items-center gap-2">
                <div class="text-gray-600 bg-blue-100 rounded-md w-6 h-6 flex items-center justify-center shrink-0">
                    2</div>
                <a href="{{ route('personal.data.pendidikan') }}"
                    class="text-blue-600 font-semibold hover:underline">Pendidikan Terakhir</a>
            </div>

            <div class="hidden md:block text-gray-400">/</div>

            <!-- Step 3 -->
            <div class="flex items-center gap-2">
                <div class="text-gray-600 bg-gray-200 rounded-md w-6 h-6 flex items-center justify-center shrink-0">
                    3</div>
                <a href="{{ route('personal.data.address') }}"
                    class="text-gray-700 hover:text-blue-600 hover:underline">Alamat Tempat Tinggal</a>
            </div>

            <div class="hidden md:block text-gray-400">/</div>

            <!-- Step 4 -->
            <div class="flex items-center gap-2">
                <div class="text-gray-600 bg-gray-200 rounded-md w-6 h-6 flex items-center justify-center shrink-0">
                    4</div>
                <a href="{{ route('personal.data.income') }}"
                    class="text-gray-700 hover:text-blue-600 hover:underline">Penghasilan</a>
            </div>

            <div class="hidden md:block text-gray-400">/</div>

            <!-- Step 5 -->
            <div class="flex items-center gap-2">
                <div class="text-gray-600 bg-gray-200 rounded-md w-6 h-6 flex items-center justify-center shrink-0">
                    5</div>
                <a href="{{ route('personal.data.family') }}"
                    class="text-gray-700 hover:text-blue-600 hover:underline">Data Orang Tua</a>
            </div>

        </div>
    </div>

    <form action="{{ route('personal.data.store.education') }}" method="post" class="mb-16 md:mb-0">
        @csrf
        <div class="w-full rounded-2xl bg-white mt-5 p-5 outline outline-1 outline-gray-200">
            <div class="">
                <div class="flex gap-2">
                    <h1 class="font-sora font-semibold">Pendidikan Terakhir</h1>
                </div>
                <small class="font-sora">LATEST EDUCATION</small>
            </div>
            <hr class="my-3">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                <div class="flex flex-col mb-3">
                    <label for="last_education" class="font-sora font-semibold">Pendidikan Terakhir</label>
                    <small class="font-sora"><i>Last Education</i></small>
                    <select name="last_education" id="last_education"
                        class="py-2 px-5 border border-gray-500 w-full rounded-md my-2 bg-transparent">
                        <option selected>Pendidikan Terakhir</option>
                        <option value="Strata Satu (S1)" {{ isset($personalData->last_education) &&
                            $personalData->last_education == 'Strata Satu (S1)' ? 'selected' : '' }}>
                            Strata Satu (S1)</option>
                        <option value="Strata Dua (S2)" {{ isset($personalData->last_education) &&
                            $personalData->last_education == 'Strata Dua (S2)' ? 'selected' : '' }}>
                            Strata Dua (S2)</option>
                        <option value="Diploma (D4)" {{ isset($personalData->last_education) &&
                            $personalData->last_education == 'Diploma (D4)' ? 'selected' : '' }}>
                            Diploma (D4)</option>
                        <option value="Diploma (D3)" {{ isset($personalData->last_education) &&
                            $personalData->last_education == 'Diploma (D3)' ? 'selected' : '' }}>
                            Diploma (D3)</option>
                        <option value="SMA/SMK Sederajat" {{ isset($personalData->last_education) &&
                            $personalData->last_education == 'SMA/SMK Sederajat' ? 'selected' : '' }}>
                            SMA/SMK Sederajat</option>
                    </select>
                    @error('last_education')
                    <div>
                        <small class="text-red-500"><i>{{ $message }}</i></small>
                    </div>
                    @enderror
                </div>



                <div class="flex flex-col mb-3">
                    <label for="name_of_institution" class="font-sora font-semibold">Nama Sekolah/Universitas</label>
                    <small class="font-sora mb-3"><i>name of institution</i></small>

                    <select id="name_of_institution" name="name_of_institution"
                        class="select2 py-2 px-5 border border-gray-500 w-full rounded-md my-2 bg-transparent"
                        style="width: 100%">
                        <option value="" disabled selected>Pilih Nama Sekolah</option>
                        @if (isset($personalData->name_of_institution) && $personalData->name_of_institution)
                        <option value="{{ $personalData->name_of_institution }}" selected>
                            {{ $personalData->name_of_institution }}
                        </option>
                        @endif
                    </select>

                    @error('name_of_institution')
                    <div>
                        <small class="text-red-500"><i>{{ $message }}</i></small>
                    </div>
                    @enderror
                </div>

                <script>
                    $(document).ready(function() {
                            $('#name_of_institution').select2({
                                placeholder: 'Pilih atau ketik nama sekolah',
                                tags: true, // ✅ Izinkan input manual
                                ajax: {
                                    url: function(params) {
                                        return 'https://api-sekolah-indonesia.vercel.app/sekolah/s?sekolah=' + params
                                            .term;
                                    },
                                    processResults: function(data) {
                                        // Cek jika data kosong
                                        if (!data.dataSekolah || data.dataSekolah.length === 0) {
                                            return {
                                                results: []
                                            };
                                        }

                                        return {
                                            results: data.dataSekolah.map(function(item) {
                                                return {
                                                    id: item.sekolah,
                                                    text: item.sekolah,
                                                    province: item.propinsi,
                                                    city: item.kabupaten_kota,
                                                    type: item.status
                                                };
                                            })
                                        };
                                    },
                                    cache: true,
                                    delay: 250,
                                    error: function() {
                                        console.warn("⚠️ Tidak bisa memuat data dari API, gunakan input manual saja.");
                                    }
                                },
                                language: {
                                    noResults: function() {
                                        return "Tidak ditemukan. Ketik manual nama sekolah lalu tekan Enter.";
                                    }
                                },
                                escapeMarkup: function(markup) {
                                    return markup;
                                }
                            });

                            // ✅ Tambahan penting: jika user mengetik manual dan API gagal, tetap simpan inputnya
                            $('#name_of_institution').on('select2:closing', function() {
                                const $this = $(this);
                                const inputVal = $this.data('select2').$dropdown.find('.select2-search__field').val();

                                if (inputVal && !$this.find("option[value='" + inputVal + "']").length) {
                                    const newOption = new Option(inputVal, inputVal, true, true);
                                    $this.append(newOption).trigger('change');
                                }
                            });

                            // ✅ Jika data lama sudah ada, tampilkan kembali
                            @if (isset($personalData->name_of_institution) && $personalData->name_of_institution)
                                let option = new Option("{{ $personalData->name_of_institution }}",
                                    "{{ $personalData->name_of_institution }}", true, true);
                                $('#name_of_institution').append(option).trigger('change');
                            @endif

                            // ✅ Event saat memilih sekolah
                            $('#name_of_institution').on('select2:select', function(e) {
                                var selectedData = e.params.data;

                                if (selectedData.province) {
                                    $('#province').val(selectedData.province);
                                    $('#city').val(selectedData.city);

                                    let typeText = selectedData.type === 'N' ? 'Negeri' :
                                        selectedData.type === 'S' ? 'Swasta' : selectedData.type;
                                    $('#type').val(typeText);
                                } else {
                                    // Jika input manual, kosongkan field terkait
                                    $('#province').val('');
                                    $('#city').val('');
                                    $('#type').val('');
                                }
                            });
                        });
                </script>



                <div class="flex flex-col mb-3">
                    <label for="type" class="font-sora font-semibold">Jenis Sekolah</label>
                    <small class="font-sora"><i>type of school</i></small>
                    <select name="type" id="type"
                        class="py-2 px-5 border border-gray-500 w-full rounded-md my-2 bg-transparent">
                        <option selected>Jenis Sekolah</option>
                        <option value="Negeri" {{ isset($personalData->type) && $personalData->type == 'Negeri' ?
                            'selected' : '' }}>
                            Negeri</option>
                        <option value="Swasta" {{ isset($personalData->type) && $personalData->type == 'Swasta' ?
                            'selected' : '' }}>
                            Swasta</option>
                    </select>
                    @error('type')
                    <div>
                        <small class="text-red-500"><i>{{ $message }}</i></small>
                    </div>
                    @enderror
                </div>

                <div class="flex flex-col mb-3">
                    <label for="country" class="font-sora font-semibold">Negara</label>
                    <small class="font-sora"><i>Country</i></small>
                    <input type="text" id="country" name="country" placeholder="country" required
                        class="py-2 px-5 border border-gray-500 w-full inline rounded-md my-2 bg-transparent"
                        value="{{ isset($personalData->country) ? $personalData->country : '' }}">
                    @error('country')
                    <div>
                        <small class="text-red-500"><i>{{ $message }}</i></small>
                    </div>
                    @enderror
                </div>
                <div class="flex flex-col mb-3">
                    <label for="province" class="font-sora font-semibold">Provinsi</label>
                    <small class="font-sora"><i>Province</i></small>
                    <input type="text" id="province" name="province" placeholder="province" required
                        class="py-2 px-5 border border-gray-500 w-full inline rounded-md my-2 bg-transparent"
                        value="{{ isset($personalData->province) ? $personalData->province : '' }}">
                    @error('province')
                    <div>
                        <small class="text-red-500"><i>{{ $message }}</i></small>
                    </div>
                    @enderror
                </div>
                <div class="flex flex-col mb-3">
                    <label for="city" class="font-sora font-semibold">Kota</label>
                    <small class="font-sora"><i>City</i></small>
                    <input type="text" id="city" name="city" placeholder="city" required
                        class="py-2 px-5 border border-gray-500 w-full inline rounded-md my-2 bg-transparent"
                        value="{{ isset($personalData->city) ? $personalData->city : '' }}">
                    @error('city')
                    <div>
                        <small class="text-red-500"><i>{{ $message }}</i></small>
                    </div>
                    @enderror
                </div>

                <div class="flex flex-col mb-3">
                    <label for="departement" class="font-sora font-semibold">Jurusan / Program Studi</label>
                    <small class="font-sora"><i>departement</i></small>
                    <input type="text" name="departement" placeholder="departement" required
                        class="py-2 px-5 border border-gray-500 w-full inline rounded-md my-2 bg-transparent"
                        value="{{ isset($personalData->departement) ? $personalData->departement : '' }}">
                    @error('departement')
                    <div>
                        <small class="text-red-500"><i>{{ $message }}</i></small>
                    </div>
                    @enderror
                </div>
                <div class="flex flex-col mb-3">
                    <label for="year_of_graduation" class="font-sora font-semibold">Tahun Lulus</label>
                    <small class="font-sora"><i>year of graduation</i></small>
                    <input type="text" name="year_of_graduation" placeholder="Year Of Graduation" required
                        class="py-2 px-5 border border-gray-500 w-full inline rounded-md my-2 bg-transparent"
                        value="{{ isset($personalData->year_of_graduation) ? $personalData->year_of_graduation : '' }}">
                    @error('year_of_graduation')
                    <div>
                        <small class="text-red-500"><i>{{ $message }}</i></small>
                    </div>
                    @enderror
                </div>
                <div class="flex flex-col mb-3">
                    <label for="grade" class="font-sora font-semibold">Nilai / IPK</label>
                    <small class="font-sora"><i>GPA</i></small>
                    <input type="year" name="grade" placeholder="grade" required
                        class="py-2 px-5 border border-gray-500 w-full inline rounded-md my-2 bg-transparent"
                        value="{{ isset($personalData->grade) ? $personalData->grade : '' }}">
                    @error('grade')
                    <div>
                        <small class="text-red-500"><i>{{ $message }}</i></small>
                    </div>
                    @enderror
                </div>
            </div>
            <div class="w-full flex items-center justify-end gap-5 mt-5 px-3">
                <a href="{{ route('personal.data.index') }}"
                    class="bg-gray-300 px-3 py-2 rounded-md text-gray-900">Kembali / Back</a>
                <button id="submit-btn"
                    class="py-2 px-3 text-center bg-primary hover:bg-primary text-white font-sora rounded-md flex justify-center items-center gap-2"
                    type="submit" onclick="handleSubmit(this)">
                    <span id="btn-text">Selanjutnya / Next</span>
                    <svg id="loading-spinner" class="hidden animate-spin h-5 w-5 text-white"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4">
                        </circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
                    </svg>
                </button>
            </div>
        </div>
    </form>
</div>

<script>
    function handleSubmit(btn) {
            btn.disabled = true; // cegah klik double
            document.getElementById("btn-text").textContent = "Loading...";
            document.getElementById("loading-spinner").classList.remove("hidden");
            btn.closest("form").submit(); // submit form secara normal
        }
</script>

@endsection