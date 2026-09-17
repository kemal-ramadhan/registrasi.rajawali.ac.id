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
                                class="">Persyaratan / </a>
                            <a href="{{ route('registration.option.test', ['id' => $programOption->id]) }}"
                                class="">Kartu Peserta </a>
                        </span>
                    </small>
                </div>
            </div>

            {{-- kontent --}}
            <div class="md:col-span-6 p-5 bg-white outline outline-1 outline-gray-200 rounded-2xl flex flex-col gap-2">

                <form action="{{ route('registration.option.pay.bk') }}" method="post">
                    @csrf
                    <input type="hidden" name="program_option_id" value="{{ $programOption->id }}">
                    <div class="flex gap-2">
                        <h1 class="font-sora font-semibold text-1xl">Masukan Kode Pembayaran Dari Pihak Instansi</h1>
                    </div>

                    <hr class="my-3">
                    <table class="w-full text-left border border-primary rounded-lg overflow-hidden">
                        <tbody>
                            <tr class="bg-gray-50 border-b border-gray-200">
                                <th scope="row" class="px-6 py-4 text-gray-900">
                                    Subtotal
                                </th>
                                <td class="px-6 py-4 text-right">
                                    Rp {{ number_format($pembayaran->amount, 0, ',', '.') }}
                                    <input type="hidden" name="amount" placeholder="amount" required required
                                        class="py-2 px-2 border border-gray-500 w-full inline rounded-lg my-2 bg-transparent"
                                        value="{{ $pembayaran->amount }}">
                                </td>
                            </tr>
                            <tr class="border-b border-gray-200">
                                <th scope="row" class="px-6 py-4 text-gray-900">
                                    Masukan Kode Pembayaran dari BK
                                </th>
                                <td class="px-6 py-4 text-right">
                                    <input type="text" name="code_pembayaran" class="py-2 px-5 border border-gray-500 w-1/2 inline rounded-md my-2 bg-transparent text-right" placeholder="Masukan Kode Pembayaran">
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <hr>

                    <div class="flex flex-items-center justify-end my-5 gap-3">
                        <a href="{{ route('registration.option.paymant', ['id' => $programOption->id]) }}"
                            class="bg-gray-300 px-3 py-2 rounded-md text-gray-900">Kembali</a>
                        <button id="submit-btn"
                            class="py-2 px-3 text-center bg-primary hover:bg-gray-950 text-white font-sora rounded-md flex justify-center items-center gap-2"
                            type="submit" onclick="handleSubmit(this)">
                            <span id="btn-text">Bayarkan</span>
                            <svg id="loading-spinner" class="hidden animate-spin h-5 w-5 text-white"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                    stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
                            </svg>
                        </button>
                    </div>

                </form>

            </div>
        </div>
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
