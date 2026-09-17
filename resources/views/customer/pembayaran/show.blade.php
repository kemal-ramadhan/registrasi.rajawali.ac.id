@extends('customer.template.template', ['title' => 'Menu Utama', 'menu' => 'pembayaran'])

@section('content')
    <div class="w-full mb-20">
        <div class="w-full">

            <div class="w-full bg-white items-center p-5 rounded-2xl outline outline-1 outline-gray-200 mb-5">
                <div class="">
                    <div class="flex gap-2">
                        <small class="font-sora flex gap-2">
                            <span>
                                <a href="{{ route('paymant.index') }}" class="font-bold">Pembayaran Saya /</a>
                                <a href="{{ route('paymant.index') }}" class="font-bold">{{ $biaya->biaya }}</a>
                            </span>
                        </small>
                    </div>
                </div>
            </div>

            {{-- kontent --}}
            <div class="md:col-span-6 p-5 bg-white outline outline-1 outline-gray-200 rounded-2xl flex flex-col gap-2">

                <form action="{{ route('paymant.pay') }}" method="post">
                    @csrf
                    <input type="hidden" name="biaya_id" value="{{ $biaya->id }}">
                    <div class="flex gap-2">
                        <h1 class="font-sora font-semibold text-1xl">Pilih Metode Pembayaran</h1>
                    </div>
                    <hr class="my-3">

                    <style>
                        input[type="radio"]:checked+label {
                            border-color: #3b82f6;
                            /* border-blue-500 */
                            ring: 2px solid #93c5fd;
                            /* ring-blue-300 */
                            background-color: #ebf5ff;
                            /* bg-blue-50 */
                        }
                    </style>

                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 my-5">
                        @foreach ($paymentMethods as $index => $paymentMethod)
                            <input type="radio" name="payment_method" value="{{ $paymentMethod->methode_initial }}"
                                id="payment_{{ $index }}" class="hidden" data-methode="{{ $paymentMethod->methode }}"
                                data-initial="{{ $paymentMethod->methode_initial }}"
                                data-fee="{{ $paymentMethod->biaya_admin }}" onchange="updateSelectedPayment(this)">

                            <label for="payment_{{ $index }}"
                                class="flex items-center space-x-4 border border-gray-300 rounded-lg p-4 shadow-sm cursor-pointer transition-all">
                                <img src="{{ asset('storage/' . $paymentMethod->image) }}"
                                    alt="{{ $paymentMethod->methode }}" class="w-12 h-12 object-contain">
                                <div>
                                    <p class="text-sm font-semibold text-gray-800">{{ $paymentMethod->methode }}</p>
                                    <p class="text-xs text-gray-500">Fee:
                                        Rp{{ number_format($paymentMethod->biaya_admin, 0, ',', '.') }}</p>
                                </div>
                            </label>
                        @endforeach
                    </div>

                    <hr class="my-3">
                    <table class="w-full text-left border border-primary rounded-lg overflow-hidden">
                        <tbody>
                            <tr class="bg-gray-50 border-b border-gray-200">
                                <th scope="row" class="px-6 py-4 text-gray-900">
                                    Subtotal
                                </th>
                                <td class="px-6 py-4 text-right">
                                    Rp {{ number_format($biaya->nominal, 0, ',', '.') }}
                                    <input type="hidden" name="amount" placeholder="amount" required required
                                        class="py-2 px-2 border border-gray-500 w-full inline rounded-lg my-2 bg-transparent"
                                        value="{{ $biaya->nominal }}">
                                </td>
                            </tr>
                            <tr class="border-b border-gray-200">
                                <th scope="row" class="px-6 py-4 text-gray-900">
                                    Biaya Admin
                                </th>
                                <td class="px-6 py-4 text-right">
                                    <span id="selectedFee">Rp0</span>
                                </td>
                            </tr>
                            <tr class="bg-gray-50 border-b border-gray-200">
                                <th scope="row" class="px-6 py-4 text-gray-900">
                                    Total Bayar
                                </th>
                                <td class="px-6 py-4 text-right">
                                    <span id="totalBayar">Rp0</span>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row" class="px-6 py-4 text-gray-900">
                                    Metode Pembayaran
                                </th>
                                <td class="px-6 py-4 text-right flex justify-end items-center gap-2">
                                    <span id="selectedMethod" class="text-gray-800">Belum dipilih</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="flex flex-items-center justify-end my-5">
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
        function selectPayment(method) {
            document.getElementById('selected-method').value = method;
        }
    </script>

    <script>
        function handleSubmit(btn) {
            btn.disabled = true; // cegah klik double
            document.getElementById("btn-text").textContent = "Loading...";
            document.getElementById("loading-spinner").classList.remove("hidden");
            btn.closest("form").submit(); // submit form secara normal
        }
    </script>

    <script>
        function updateSelectedPayment(el) {
            const methode = el.dataset.methode;
            const initial = el.dataset.initial;
            const fee = parseInt(el.dataset.fee);

            // Update tampilan fee
            document.getElementById('selectedFee').innerText = `Rp${fee.toLocaleString('id-ID')}`;

            // Update metode pembayaran
            document.getElementById('selectedMethod').innerText = methode;

            // Ambil amount dari input hidden
            const amount = parseInt(document.querySelector('input[name="amount"]').value);

            // Hitung total bayar
            const total = amount + fee;

            // Tampilkan total bayar
            document.getElementById('totalBayar').innerText = `Rp${total.toLocaleString('id-ID')}`;
        }
    </script>
@endsection
