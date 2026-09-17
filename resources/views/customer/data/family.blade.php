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
                    <div class="text-gray-600 bg-blue-100 rounded-md w-6 h-6 flex items-center justify-center shrink-0">
                        3</div>
                    <a href="{{ route('personal.data.address') }}"
                        class="font-semibold text-blue-600 hover:underline">Alamat Tempat Tinggal</a>
                </div>

                <div class="hidden md:block text-gray-400">/</div>

                <!-- Step 4 -->
                <div class="flex items-center gap-2">
                    <div class="text-gray-600 bg-blue-100 rounded-md w-6 h-6 flex items-center justify-center shrink-0">
                        4</div>
                    <a href="{{ route('personal.data.income') }}"
                        class="font-semibold text-blue-600 hover:underline">Penghasilan</a>
                </div>

                <div class="hidden md:block text-gray-400">/</div>

                <!-- Step 5 -->
                <div class="flex items-center gap-2">
                    <div class="text-gray-600 bg-blue-100 rounded-md w-6 h-6 flex items-center justify-center shrink-0">
                        5</div>
                    <a href="{{ route('personal.data.family') }}" class="font-semibold text-blue-600 hover:underline">Data
                        Orang Tua</a>
                </div>
            </div>
        </div>
        <form action="{{ route('personal.data.store.family') }}" method="post" class="mb-16 md:mb-0">
            @csrf
            <input type="hidden" name="id" value="{{ $personalData->id ?? '' }}">
            <input type="hidden" name="id_2" value="{{ $personalData_2->id ?? '' }}">

            <div class="w-full mx-auto mt-5 p-5 rounded-2xl bg-white outline outline-1 outline-gray-200">
                <div class="">
                    <div class="flex gap-2">
                        <h1 class="font-sora font-semibold">Data Orang Tua / Wali / Keluarga</h1>
                    </div>
                    <small class="font-sora">INFORMATION OF PARENTS/GUARDIAN/FAMILY</small>
                </div>
                <hr class="my-3">
                <div class="my-5">
                    <small class="bg-primary py-2 px-3 rounded-md text-white">Data Keluarga 1</small>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                    <div class="flex flex-col mb-3">
                        <label for="relation" class="font-sora font-semibold">Hubungan Keluarga</label>
                        <small class="font-sora"><i>Family Relationship</i></small>
                        <select name="relation" id="relation"
                            class="py-2 px-5 border border-gray-500 w-full rounded-md my-2 bg-transparent">
                            <option value="">-- Hubungan Keluarga --</option>
                            <option value="Ibu Kandung"
                                {{ isset($personalData->relation) && $personalData->relation == 'Ibu Kandung' ? 'selected' : '' }}>
                                Ibu Kandung</option>
                            <option value="Ayah Kandung"
                                {{ isset($personalData->relation) && $personalData->relation == 'Ayah Kandung' ? 'selected' : '' }}>
                                Ayah Kandung</option>
                            <option value="Suami"
                                {{ isset($personalData->relation) && $personalData->relation == 'Suami' ? 'selected' : '' }}>
                                Suami</option>
                            <option value="Istri"
                                {{ isset($personalData->relation) && $personalData->relation == 'Istri' ? 'selected' : '' }}>
                                Istri</option>
                            <option value="Wali"
                                {{ isset($personalData->relation) && $personalData->relation == 'Wali' ? 'selected' : '' }}>
                                Wali</option>
                        </select>
                        @error('relation')
                            <div>
                                <small class="text-red-500"><i>{{ $message }}</i></small>
                            </div>
                        @enderror
                    </div>
                    <div class="flex flex-col mb-3">
                        <label for="name" class="font-sora font-semibold">Nama Lengkap</label>
                        <small class="font-sora"><i>Full Name</i></small>
                        <input type="text" name="name" placeholder="Full Name" required
                            class="py-2 px-5 border border-gray-500 w-full inline rounded-md my-2 bg-transparent"
                            value="{{ isset($personalData->name) ? $personalData->name : '' }}">
                        @error('name')
                            <div>
                                <small class="text-red-500"><i>{{ $message }}</i></small>
                            </div>
                        @enderror
                    </div>
                    <div class="flex flex-col mb-3">
                        <label for="phone" class="font-sora font-semibold">No Handphone</label>
                        <small class="font-sora"><i>Phone Number</i></small>
                        <input type="text" name="phone" placeholder="Phone Number" required
                            class="py-2 px-5 border border-gray-500 w-full inline rounded-md my-2 bg-transparent"
                            value="{{ isset($personalData->phone) ? $personalData->phone : '' }}">
                        @error('phone')
                            <div>
                                <small class="text-red-500"><i>{{ $message }}</i></small>
                            </div>
                        @enderror
                    </div>
                    <div class="flex flex-col mb-3">
                        <label for="job" class="font-sora font-semibold">Pekerjaan</label>
                        <small class="font-sora"><i>Occupation</i></small>
                        <input type="text" name="job" placeholder="Jobs" required
                            class="py-2 px-5 border border-gray-500 w-full inline rounded-md my-2 bg-transparent"
                            value="{{ isset($personalData->job) ? $personalData->job : '' }}">
                        @error('job')
                            <div>
                                <small class="text-red-500"><i>{{ $message }}</i></small>
                            </div>
                        @enderror
                    </div>
                    <div class="flex flex-col mb-3">
                        <label for="education" class="font-sora font-semibold">Pendidikan Terakhir</label>
                        <small class="font-sora"><i>Last Education</i></small>
                        <select name="education" id="education"
                            class="py-2 px-5 border border-gray-500 w-full rounded-md my-2 bg-transparent">
                            <option value="">-- Pendidikan Terakhir --</option>
                            <option value="Strata Tiga (S3)"
                                {{ isset($personalData->education) && $personalData->education == 'Strata Tiga (S3)' ? 'selected' : '' }}>
                                Strata Tiga (S3)</option>
                            <option value="Strata Dua (S2)"
                                {{ isset($personalData->education) && $personalData->education == 'Strata Dua (S2)' ? 'selected' : '' }}>
                                Strata Dua (S2)</option>
                            <option value="Strata Satu (S1)"
                                {{ isset($personalData->education) && $personalData->education == 'Strata Satu (S1)' ? 'selected' : '' }}>
                                Strata Satu (S1)</option>
                            <option value="Diploma (D4)"
                                {{ isset($personalData->education) && $personalData->education == 'Diploma (D4)' ? 'selected' : '' }}>
                                Diploma (D4)</option>
                            <option value="SMA/SMK Sederajat"
                                {{ isset($personalData->education) && $personalData->education == 'SMA/SMK Sederajat' ? 'selected' : '' }}>
                                SMA/SMK Sederajat</option>
                            <option value="SMP/MTs Sederajat"
                                {{ isset($personalData->education) && $personalData->education == 'SMP/MTs Sederajat' ? 'selected' : '' }}>
                                SMP/MTs Sederajat</option>
                            <option value="SD/MI Sederajat"
                                {{ isset($personalData->education) && $personalData->education == 'SD/MI Sederajat' ? 'selected' : '' }}>
                                SD/MI Sederajat</option>
                            <option value="Lainnya"
                                {{ isset($personalData->education) && $personalData->education == 'Lainnya' ? 'selected' : '' }}>
                                Lainnya</option>
                        </select>
                        @error('education')
                            <div>
                                <small class="text-red-500"><i>{{ $message }}</i></small>
                            </div>
                        @enderror
                    </div>
                    <div class="flex flex-col mb-3">
                        <label for="status" class="font-sora font-semibold">Status</label>
                        <small class="font-sora"><i>Status</i></small>
                        <select name="status" id="status"
                            class="py-2 px-5 border border-gray-500 w-full rounded-md my-2 bg-transparent">
                            <option value="">-- Pilih Status --</option>
                            <option value="Masih Hidup"
                                {{ isset($personalData->status) && $personalData->status == 'Masih Hidup' ? 'selected' : '' }}>
                                Masih Hidup</option>
                            <option value="Sudah Meninggal"
                                {{ isset($personalData->status) && $personalData->status == 'Sudah Meninggal' ? 'selected' : '' }}>
                                Sudah Meninggal</option>
                        </select>
                        @error('status')
                            <div>
                                <small class="text-red-500"><i>{{ $message }}</i></small>
                            </div>
                        @enderror
                    </div>
                    <div class="flex flex-col mb-3 md:col-span-3">
                        <label for="address" class="font-sora font-semibold">Alamat</label>
                        <div class="flex flex-nowrap gap-2 items-center">
                            <input type="checkbox" id="same_address" name="same_address" class="my-2">
                            <small for="same_address" class="font-sora">Alamat Sama dengan Isi Sebelumnya</small>
                        </div>
                        <textarea name="address" id="address-container" placeholder="Alamat"
                            class="py-2 px-5 border border-gray-500 w-full inline rounded-xl my-2 bg-transparent" rows="4">{{ isset($personalData->address) ? $personalData->address : '' }}</textarea>
                        @error('address')
                            <div>
                                <small class="text-red-500"><i>{{ $message }}</i></small>
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="my-5">
                    <small class="bg-primary py-2 px-3 rounded-md text-white">Data Keluarga 2</small>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                    <div class="flex flex-col mb-3">
                        <label for="relation" class="font-sora font-semibold">Hubungan Keluarga</label>
                        <small class="font-sora"><i>Family Relationship</i></small>
                        <select name="relation_2" id="relation"
                            class="py-2 px-5 border border-gray-500 w-full rounded-md my-2 bg-transparent">
                            <option value="">-- Hubungan Keluarga --</option>
                            <option value="Ibu Kandung"
                                {{ isset($personalData_2->relation) && $personalData_2->relation == 'Ibu Kandung' ? 'selected' : '' }}>
                                Ibu Kandung</option>
                            <option value="Ayah Kandung"
                                {{ isset($personalData_2->relation) && $personalData_2->relation == 'Ayah Kandung' ? 'selected' : '' }}>
                                Ayah Kandung</option>
                            <option value="Suami"
                                {{ isset($personalData_2->relation) && $personalData_2->relation == 'Suami' ? 'selected' : '' }}>
                                Suami</option>
                            <option value="Istri"
                                {{ isset($personalData_2->relation) && $personalData_2->relation == 'Istri' ? 'selected' : '' }}>
                                Istri</option>
                            <option value="Wali"
                                {{ isset($personalData_2->relation) && $personalData_2->relation == 'Wali' ? 'selected' : '' }}>
                                Wali</option>
                        </select>
                        @error('relation')
                            <div>
                                <small class="text-red-500"><i>{{ $message }}</i></small>
                            </div>
                        @enderror
                    </div>
                    <div class="flex flex-col mb-3">
                        <label for="name" class="font-sora font-semibold">Nama Lengkap</label>
                        <small class="font-sora"><i>Full Name</i></small>
                        <input type="text" name="name_2" placeholder="Full Name" required
                            class="py-2 px-5 border border-gray-500 w-full inline rounded-md my-2 bg-transparent"
                            value="{{ isset($personalData_2->name) ? $personalData_2->name : '' }}">
                        @error('name')
                            <div>
                                <small class="text-red-500"><i>{{ $message }}</i></small>
                            </div>
                        @enderror
                    </div>
                    <div class="flex flex-col mb-3">
                        <label for="phone" class="font-sora font-semibold">No Handphone</label>
                        <small class="font-sora"><i>Phone Number</i></small>
                        <input type="text" name="phone_2" placeholder="Phone Number" required
                            class="py-2 px-5 border border-gray-500 w-full inline rounded-md my-2 bg-transparent"
                            value="{{ isset($personalData_2->phone) ? $personalData_2->phone : '' }}">
                        @error('phone')
                            <div>
                                <small class="text-red-500"><i>{{ $message }}</i></small>
                            </div>
                        @enderror
                    </div>
                    <div class="flex flex-col mb-3">
                        <label for="job" class="font-sora font-semibold">Pekerjaan</label>
                        <small class="font-sora"><i>Occupation</i></small>
                        <input type="text" name="job_2" placeholder="Jobs" required
                            class="py-2 px-5 border border-gray-500 w-full inline rounded-md my-2 bg-transparent"
                            value="{{ isset($personalData_2->job) ? $personalData_2->job : '' }}">
                        @error('job')
                            <div>
                                <small class="text-red-500"><i>{{ $message }}</i></small>
                            </div>
                        @enderror
                    </div>
                    <div class="flex flex-col mb-3">
                        <label for="education" class="font-sora font-semibold">Pendidikan Terakhir</label>
                        <small class="font-sora"><i>Last Education</i></small>
                        <select name="education_2" id="education"
                            class="py-2 px-5 border border-gray-500 w-full rounded-md my-2 bg-transparent">
                            <option value="">-- Pendidikan Terakhir --</option>
                            <option value="Strata Tiga (S3)"
                                {{ isset($personalData_2->education) && $personalData_2->education == 'Strata Tiga (S3)' ? 'selected' : '' }}>
                                Strata Tiga (S3)</option>
                            <option value="Strata Dua (S2)"
                                {{ isset($personalData->education) && $personalData->education == 'Strata Dua (S2)' ? 'selected' : '' }}>
                                Strata Dua (S2)</option>
                            <option value="Strata Satu (S1)"
                                {{ isset($personalData_2->education) && $personalData_2->education == 'Strata Satu (S1)' ? 'selected' : '' }}>
                                Strata Satu (S1)</option>
                            <option value="Diploma (D4)"
                                {{ isset($personalData_2->education) && $personalData_2->education == 'Diploma (D4)' ? 'selected' : '' }}>
                                Diploma (D4)</option>
                            <option value="SMA/SMK Sederajat"
                                {{ isset($personalData_2->education) && $personalData_2->education == 'SMA/SMK Sederajat' ? 'selected' : '' }}>
                                SMA/SMK Sederajat</option>
                            <option value="SMP/MTs Sederajat"
                                {{ isset($personalData_2->education) && $personalData_2->education == 'SMP/MTs Sederajat' ? 'selected' : '' }}>
                                SMP/MTs Sederajat</option>
                            <option value="SD/MI Sederajat"
                                {{ isset($personalData_2->education) && $personalData_2->education == 'SD/MI Sederajat' ? 'selected' : '' }}>
                                SD/MI Sederajat</option>
                            <option value="Lainnya"
                                {{ isset($personalData_2->education) && $personalData_2->education == 'Lainnya' ? 'selected' : '' }}>
                                Lainnya</option>
                        </select>
                        @error('education')
                            <div>
                                <small class="text-red-500"><i>{{ $message }}</i></small>
                            </div>
                        @enderror
                    </div>
                    <div class="flex flex-col mb-3">
                        <label for="status" class="font-sora font-semibold">Status</label>
                        <small class="font-sora"><i>Status</i></small>
                        <select name="status_2" id="status"
                            class="py-2 px-5 border border-gray-500 w-full rounded-md my-2 bg-transparent">
                            <option value="">-- Pilih Status --</option>
                            <option value="Masih Hidup"
                                {{ isset($personalData_2->status) && $personalData_2->status == 'Masih Hidup' ? 'selected' : '' }}>
                                Masih Hidup</option>
                            <option value="Sudah Meninggal"
                                {{ isset($personalData_2->status) && $personalData_2->status == 'Sudah Meninggal' ? 'selected' : '' }}>
                                Sudah Meninggal</option>
                        </select>
                        @error('status')
                            <div>
                                <small class="text-red-500"><i>{{ $message }}</i></small>
                            </div>
                        @enderror
                    </div>

                    <div class="flex flex-col mb-3 md:col-span-3">
                        <label for="address" class="font-sora font-semibold">Alamat</label>
                        <div class="flex flex-nowrap gap-2 items-center">
                            <input type="checkbox" id="same_address_2" name="same_address_2" class="my-2">
                            <small for="same_address_2" class="font-sora">Alamat Sama dengan Isi Sebelumnya</small>
                        </div>
                        <textarea name="address_2" id="address-container-2" placeholder="Alamat"
                            class="py-2 px-5 border border-gray-500 w-full inline rounded-xl my-2 bg-transparent" rows="4">{{ isset($personalData_2->address) ? $personalData_2->address : '' }}</textarea>
                        @error('address_2')
                            <div>
                                <small class="text-red-500"><i>{{ $message }}</i></small>
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="w-full flex items-center justify-end gap-5 mt-5 px-3">
                    <a href="{{ route('personal.data.income') }}"
                        class="bg-gray-300 px-3 py-2 rounded-md text-gray-900">Kembali / Back</a>
                    <button id="submit-btn"
                        class="py-2 px-3 text-center bg-primary hover:bg-primary text-white font-sora rounded-md flex justify-center items-center gap-2"
                        type="submit" onclick="handleSubmit(this)">
                        <span id="btn-text">Selanjutnya / Next</span>
                        <svg id="loading-spinner" class="hidden animate-spin h-5 w-5 text-white"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </form>
    </div>

    <script>
        // Mengatur kondisi checkbox
        document.getElementById('same_address').addEventListener('change', function() {
            let addressContainer = document.getElementById('address-container');

            if (this.checked) {
                addressContainer.style.display = 'none'; // Sembunyikan textarea jika dicentang
            } else {
                addressContainer.style.display = 'block'; // Tampilkan textarea jika tidak dicentang
            }
        });
    </script>
    <script>
        // Mengatur kondisi checkbox
        document.getElementById('same_address_2').addEventListener('change', function() {
            let addressContainer = document.getElementById('address-container-2');

            if (this.checked) {
                addressContainer.style.display = 'none'; // Sembunyikan textarea jika dicentang
            } else {
                addressContainer.style.display = 'block'; // Tampilkan textarea jika tidak dicentang
            }
        });
    </script>

    <script>
        function handleSubmit(btn) {
            btn.disabled = true; // cegah klik double
            document.getElementById("btn-text").textContent = "Loading...";
            document.getElementById("loading-spinner").classList.remove("hidden");
            btn.closest("form").submit(); // submit form secara normal
        }
    </script>
@endsection
