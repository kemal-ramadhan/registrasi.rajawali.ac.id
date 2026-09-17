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
        <form action="{{ route('personal.data.store.address') }}" method="post" class="mb-16 md:mb-0">
            @csrf
            <div class="w-full rounded-2xl bg-white mt-5 p-5 outline outline-1 outline-gray-200">
                <div class="">
                    <div class="flex gap-2">
                        <h1 class="font-sora font-semibold">Alamat Tempat Tinggal</h1>
                    </div>
                    <small class="font-sora">ADDRESS</small>
                </div>
                <hr class="my-3">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                    <div class="flex flex-col mb-3">
                        <label for="country" class="font-sora font-semibold">Negara</label>
                        <small class="font-sora"><i>Country</i></small>
                        <input type="text" name="country" placeholder="country" required
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
                        <input type="text" name="province" placeholder="province" required
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
                        <input type="text" name="city" placeholder="city" required
                            class="py-2 px-5 border border-gray-500 w-full inline rounded-md my-2 bg-transparent"
                            value="{{ isset($personalData->city) ? $personalData->city : '' }}">
                        @error('city')
                            <div>
                                <small class="text-red-500"><i>{{ $message }}</i></small>
                            </div>
                        @enderror
                    </div>
                    <div class="flex flex-col mb-3">
                        <label for="district" class="font-sora font-semibold">Kecamatan</label>
                        <small class="font-sora"><i>District</i></small>
                        <input type="text" name="district" placeholder="district" required
                            class="py-2 px-5 border border-gray-500 w-full inline rounded-md my-2 bg-transparent"
                            value="{{ isset($personalData->district) ? $personalData->district : '' }}">
                        @error('district')
                            <div>
                                <small class="text-red-500"><i>{{ $message }}</i></small>
                            </div>
                        @enderror
                    </div>
                    <div class="flex flex-col mb-3 md:col-span-2">
                        <label for="village" class="font-sora font-semibold">Desa / Kelurahan</label>
                        <small class="font-sora"><i>Village</i></small>
                        <input type="text" name="village" placeholder="village" required
                            class="py-2 px-5 border border-gray-500 w-full inline rounded-md my-2 bg-transparent"
                            value="{{ isset($personalData->village) ? $personalData->village : '' }}">
                        @error('village')
                            <div>
                                <small class="text-red-500"><i>{{ $message }}</i></small>
                            </div>
                        @enderror
                    </div>
                    <div class="flex flex-col mb-3 md:col-span-3">
                        <label for="address" class="font-sora font-semibold">Alamat</label>
                        <small class="font-sora"><i>Address</i></small>
                        <textarea name="address" id="address"
                            class="py-2 px-5 border border-gray-500 w-full inline rounded-xl my-2 bg-transparent" rows="4">{{ isset($personalData->address) ? $personalData->address : '' }}</textarea>
                        @error('address')
                            <div>
                                <small class="text-red-500"><i>{{ $message }}</i></small>
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="w-full flex items-center justify-end gap-5 mt-5 px-3">
                    <a href="{{ route('personal.data.pendidikan') }}"
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
    function handleSubmit(btn) {
        btn.disabled = true; // cegah klik double
        document.getElementById("btn-text").textContent = "Loading...";
        document.getElementById("loading-spinner").classList.remove("hidden");
        btn.closest("form").submit(); // submit form secara normal
    }
    </script>
@endsection
