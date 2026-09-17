@extends('customer.template.template', ['title' => 'Personal Data', 'menu' => 'profile'])

@section('content')
<div class="w-full">
    <div
        class="w-full bg-white hidden md:flex items-center justify-center p-5 rounded-2xl outline outline-1 outline-gray-200">
        <div class="flex flex-col md:flex-row md:items-center md:gap-3 font-medium font-sora space-y-3 md:space-y-0">

            <!-- Step 1 -->
            <div class="flex items-center flex-nowrap gap-2">
                <div class="text-blue-600 bg-blue-100 rounded-md w-6 h-6 flex items-center justify-center shrink-0">
                    1</div>
                <a href="{{ route('personal.data.index') }}" class="text-blue-600 font-semibold hover:underline">Data
                    Pribadi</a>
            </div>

            <div class="hidden md:block text-gray-400">/</div>

            <!-- Step 2 -->
            <div class="flex items-center gap-2">
                <div class="text-gray-600 bg-gray-200 rounded-md w-6 h-6 flex items-center justify-center shrink-0">
                    2</div>
                <a href="{{ route('personal.data.pendidikan') }}"
                    class="text-gray-700 hover:text-blue-600 hover:underline">Pendidikan Terakhir</a>
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

    <form action="/create-data" method="post" class="mb-16 md:mb-0" id="personal-form">
        @csrf
        <div class="w-full mt-5 p-5 rounded-2xl bg-white outline outline-1 outline-gray-200">
            <div class="">
                <div class="flex gap-2">
                    <h1 class="font-sora font-semibold">Data Pribadi</h1>
                </div>
                <small class="font-sora">Personal Data</small>
            </div>
            <hr class="my-3">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                <div class="flex flex-col mb-3">
                    <label for="name" class="font-sora font-semibold">Nama Lengkap</label>
                    <small class="font-sora"><i>Full Name</i></small>
                    <input type="text" name="name" placeholder="Full Name" required
                        class="py-2 px-5 border border-gray-500 w-full inline rounded-md my-2 bg-transparent"
                        value="{{ Auth::user()->name }}">
                    @error('name')
                    <div>
                        <small class="text-red-500"><i>{{ $message }}</i></small>
                    </div>
                    @enderror
                </div>
                <div class="flex flex-col mb-3">
                    <label for="name" class="font-sora font-semibold">Alamat Email</label>
                    <small class="font-sora"><i>Email Address</i></small>
                    <input type="text" name="email" placeholder="Email Address" required
                        class="py-2 px-5 border border-gray-500 w-full inline rounded-md my-2 bg-transparent"
                        value="{{ Auth::user()->email }}">
                    @error('email')
                    <div>
                        <small class="text-red-500"><i>{{ $message }}</i></small>
                    </div>
                    @enderror
                </div>
                <!-- Jenis Kelamin (Dropdown Select) -->
                <div class="flex flex-col mb-3">
                    <label for="gender" class="font-sora font-semibold">Jenis Kelamin</label>
                    <small class="font-sora"><i>Gender</i></small>
                    <select name="gander" id="gander" required
                        class="py-2 px-5 border border-gray-500 w-full rounded-md my-2 bg-transparent">
                        <option value="">-- Pilih Jenis Kelamin --</option>
                        <option value="Laki-laki" {{ isset($personalData->gander) && $personalData->gander ==
                            'Laki-laki' ? 'selected' : '' }}>
                            Laki-laki</option>
                        <option value="Perempuan" {{ isset($personalData->gander) && $personalData->gander ==
                            'Perempuan' ? 'selected' : '' }}>
                            Perempuan</option>
                    </select>
                    @error('gander')
                    <div>
                        <small class="text-red-500"><i>{{ $message }}</i></small>
                    </div>
                    @enderror
                </div>
                <div class="flex flex-col mb-3">
                    <label for="phone" class="font-sora font-semibold">Nomor Telepon / Whatsapp</label>
                    <small class="font-sora"><i>Phone Number/WhatsApp</i></small>
                    <input type="text" name="phone" placeholder="Phone Number/WhatsApp" required
                        class="py-2 px-5 border border-gray-500 w-full inline rounded-md my-2 bg-transparent"
                        value="{{ Auth::user()->phone }}">
                    @error('phone')
                    <div>
                        <small class="text-red-500"><i>{{ $message }}</i></small>
                    </div>
                    @enderror
                </div>
                <div class="flex flex-col mb-3">
                    <label for="nik" class="font-sora font-semibold">Nomor Induk Kependudukan (NIK)</label>
                    <small class="font-sora"><i>National Identity Number</i></small>
                    <input type="text" name="nik" placeholder="National Identity Number" required
                        class="py-2 px-5 border border-gray-500 w-full inline rounded-md my-2 bg-transparent"
                        value="{{ isset($personalData->nik) ? $personalData->nik : '' }}">
                    @error('nik')
                    <div>
                        <small class="text-red-500"><i>{{ $message }}</i></small>
                    </div>
                    @enderror
                </div>
                <div class="flex flex-col mb-3">
                    <label for="nisn" class="font-sora font-semibold">Nomor Induk Siswa Nasional
                        (NISN)</label>
                    <small class="font-sora"><i>Student Number</i></small>
                    <input type="text" name="nisn" placeholder="Student Number"
                        class="py-2 px-5 border border-gray-500 w-full inline rounded-md my-2 bg-transparent"
                        value="{{ isset($personalData->nisn) ? $personalData->nisn : '' }}">
                    @error('nisn')
                    <div>
                        <small class="text-red-500"><i>{{ $message }}</i></small>
                    </div>
                    @enderror
                </div>
                <div class="flex flex-col mb-3">
                    <label for="place_of_birth" class="font-sora font-semibold">Tempat Lahir</label>
                    <small class="font-sora"><i>Place of Birth</i></small>
                    <input type="text" name="place_of_birth" placeholder="Tempat Lahir" required
                        class="py-2 px-5 border border-gray-500 w-full inline rounded-md my-2 bg-transparent"
                        value="{{ isset($personalData->place_of_birth) ? $personalData->place_of_birth : '' }}">
                    @error('place_of_birth')
                    <div>
                        <small class="text-red-500"><i>{{ $message }}</i></small>
                    </div>
                    @enderror
                </div>
                <div class="flex flex-col mb-3">
                    <label for="date_of_birth" class="font-sora font-semibold">Tanggal Lahir</label>
                    <small class="font-sora"><i>Date of Birth</i></small>
                    <input type="date" name="date_of_birth" placeholder="Date of Birth" required
                        class="py-2 px-5 border border-gray-500 w-full inline rounded-md my-2 bg-transparent"
                        value="{{ isset($personalData->date_of_birth) ? $personalData->date_of_birth : '' }}">
                    @error('date_of_birth')
                    <div>
                        <small class="text-red-500"><i>{{ $message }}</i></small>
                    </div>
                    @enderror
                </div>
                <div class="flex flex-col mb-3">
                    <label for="religion" class="font-sora font-semibold">Agama</label>
                    <small class="font-sora"><i>Religion</i></small>
                    <select name="religion" id="religion" required
                        class="py-2 px-5 border border-gray-500 w-full inline rounded-md my-2 bg-transparent">
                        <option value="">-- Pilih Agama --</option>
                        <option value="Islam" {{ isset($personalData->religion) && $personalData->religion == 'Islam' ?
                            'selected' : '' }}>
                            Islam</option>
                        <option value="Kristen" {{ isset($personalData->religion) && $personalData->religion ==
                            'Kristen' ? 'selected' : '' }}>
                            Kristen</option>
                        <option value="Katolik" {{ isset($personalData->religion) && $personalData->religion ==
                            'Katolik' ? 'selected' : '' }}>
                            Katolik</option>
                        <option value="Hindu" {{ isset($personalData->religion) && $personalData->religion == 'Hindu' ?
                            'selected' : '' }}>
                            Hindu</option>
                        <option value="Buddha" {{ isset($personalData->religion) && $personalData->religion == 'Buddha'
                            ? 'selected' : '' }}>
                            Buddha</option>
                        <option value="Konghucu" {{ isset($personalData->religion) && $personalData->religion ==
                            'Konghucu' ? 'selected' : '' }}>
                            Konghucu</option>
                        <option value="Lainnya" {{ isset($personalData->religion) && $personalData->religion ==
                            'Lainnya' ? 'selected' : '' }}>
                            Lainnya</option>
                    </select>
                    @error('religion')
                    <div>
                        <small class="text-red-500"><i>{{ $message }}</i></small>
                    </div>
                    @enderror
                </div>
                <div class="flex flex-col mb-3">
                    <label for="media_information" class="font-sora font-semibold">Media Info / Mengetahui
                        UBTH Dari</label>
                    <small class="font-sora"><i>UBTH Information Media Sources</i></small>
                    <select name="media_information" id="media_information" required
                        class="py-2 px-5 border border-gray-500 w-full rounded-md my-2 bg-transparent">
                        <option value="">UBTH Information Media Sources</option>
                        <option value="Instagram" {{ (isset($personalData->media_information) &&
                            $personalData->media_information == 'Instagram') || old('media_information') == 'Instagram'
                            ? 'selected' : '' }}>
                            Instagram</option>
                        <option value="Facebook" {{ (isset($personalData->media_information) &&
                            $personalData->media_information == 'Facebook') || old('media_information') == 'Facebook' ?
                            'selected' : '' }}>
                            Facebook</option>
                        <option value="Twitter" {{ (isset($personalData->media_information) &&
                            $personalData->media_information == 'Twitter') || old('media_information') == 'Twitter' ?
                            'selected' : '' }}>
                            Twitter</option>
                        <option value="Tiktok" {{ (isset($personalData->media_information) &&
                            $personalData->media_information == 'Tiktok') ||
                            old('media_information') == 'Tiktok' ? 'selected' : '' }}>
                            Tiktok</option>
                        <option value="Google" {{ (isset($personalData->media_information) &&
                            $personalData->media_information == 'Google') ||
                            old('media_information') == 'Google' ? 'selected' : '' }}>
                            Google</option>
                        <option value="Website" {{ (isset($personalData->media_information) &&
                            $personalData->media_information == 'Website') || old('media_information') == 'Website' ?
                            'selected' : '' }}>
                            Website</option>
                        <option value="Lainnya" {{ (isset($personalData->media_information) &&
                            $personalData->media_information == 'Lainnya') || old('media_information') == 'Lainnya' ?
                            'selected' : '' }}>
                            Lainnya</option>
                    </select>
                    @error('media_information')
                    <div>
                        <small class="text-red-500"><i>{{ $message }}</i></small>
                    </div>
                    @enderror
                </div>
                <div class="flex flex-col mb-3">
                    <label for="referal_id" class="font-sora font-semibold">Kode Referal (Tidak Wajib)</label>
                    <small class="font-sora mb-3"><i>Code Referal</i></small>

                    <select name="referal_id" id="referal_id"
                        class="py-2 px-5 border border-gray-500 w-full rounded-md my-2 bg-transparent select2">
                        <option value="">Pilih Code Referal</option>

                        @foreach ($referals as $referal)
                        <option value="{{ $referal->id }}" {{ isset($personalData->referal_id) &&
                            $personalData->referal_id == $referal->id ? 'selected' : '' }}>
                            {{ $referal->code }} - {{ $referal->institution }}
                        </option>
                        @endforeach
                    </select>

                    @error('referal_id')
                    <div>
                        <small class="text-red-500"><i>{{ $message }}</i></small>
                    </div>
                    @enderror
                </div>

            </div>
            <div class="w-full flex items-center justify-end gap-5 mt-5 px-3">
                <a href="/" class="bg-gray-300 px-3 py-2 rounded-md text-gray-900">Kembali / Back</a>
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


<script>
    $(document).ready(function() {
            $('#referal_id').select2({
                placeholder: "Pilih Code Referal",
                allowClear: true,
                width: '100%',
            });
        });
</script>
@endsection