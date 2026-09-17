<!DOCTYPE html>
<html lang="id" class="h-full bg-gray-50">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi OTP</title>
    @vite('resources/css/app.css')
    <link rel="shortcut icon" href="{{ asset('assets/icons/bth.png') }}" type="image/x-icon">

<!-- Meta Pixel Code -->
  <script>
    !function (f, b, e, v, n, t, s) {
      if (f.fbq) return; n = f.fbq = function () {
        n.callMethod ?
          n.callMethod.apply(n, arguments) : n.queue.push(arguments)
      };
      if (!f._fbq) f._fbq = n; n.push = n; n.loaded = !0; n.version = '2.0';
      n.queue = []; t = b.createElement(e); t.async = !0;
      t.src = v; s = b.getElementsByTagName(e)[0];
      s.parentNode.insertBefore(t, s)
    }(window, document, 'script',
      'https://connect.facebook.net/en_US/fbevents.js');
    fbq('init', '1331395535059424', {
      em: 'email@email.com',
      ph: '1234567890',
    });
    fbq('track', 'PageView');
  </script>
  <noscript><img height="1" width="1" style="display:none"
      src="https://www.facebook.com/tr?id=1331395535059424&ev=PageView&noscript=1" /></noscript>
  <!-- End Meta†Pixel†Code†-->

  <!-- kampus -->
  <!-- Meta Pixel Code -->
  <script>
    !function (f, b, e, v, n, t, s) {
      if (f.fbq) return; n = f.fbq = function () {
        n.callMethod ?
          n.callMethod.apply(n, arguments) : n.queue.push(arguments)
      };
      if (!f._fbq) f._fbq = n; n.push = n; n.loaded = !0; n.version = '2.0';
      n.queue = []; t = b.createElement(e); t.async = !0;
      t.src = v; s = b.getElementsByTagName(e)[0];
      s.parentNode.insertBefore(t, s)
    }(window, document, 'script',
      'https://connect.facebook.net/en_US/fbevents.js');
    fbq('init', '1253763873095984');
    fbq('track', 'PageView');
  </script>
  <noscript><img height="1" width="1" style="display:none"
      src="https://www.facebook.com/tr?id=1253763873095984&ev=PageView&noscript=1" /></noscript>
  <!-- End Meta Pixel Code -->

  <!-- TikTok Pixel Code Start -->
  <script>
    !function (w, d, t) {
      w.TiktokAnalyticsObject = t; var ttq = w[t] = w[t] || []; ttq.methods = ["page", "track", "identify", "instances", "debug", "on", "off", "once", "ready", "alias", "group", "enableCookie", "disableCookie", "holdConsent", "revokeConsent", "grantConsent"], ttq.setAndDefer = function (t, e) { t[e] = function () { t.push([e].concat(Array.prototype.slice.call(arguments, 0))) } }; for (var i = 0; i < ttq.methods.length; i++)ttq.setAndDefer(ttq, ttq.methods[i]); ttq.instance = function (t) {
        for (
          var e = ttq._i[t] || [], n = 0; n < ttq.methods.length; n++)ttq.setAndDefer(e, ttq.methods[n]); return e
      }, ttq.load = function (e, n) {
        var r = "https://analytics.tiktok.com/i18n/pixel/events.js", o = n && n.partner; ttq._i = ttq._i || {}, ttq._i[e] = [], ttq._i[e]._u = r, ttq._t = ttq._t || {}, ttq._t[e] = +new Date, ttq._o = ttq._o || {}, ttq._o[e] = n || {}; n = document.createElement("script")
          ; n.type = "text/javascript", n.async = !0, n.src = r + "?sdkid=" + e + "&lib=" + t; e = document.getElementsByTagName("script")[0]; e.parentNode.insertBefore(n, e)
      };


      ttq.load('D0QM74RC77U7RPGNVIQ0');
      ttq.page();
    }(window, document, 'ttq');
  </script>
  <!-- TikTok Pixel Code End -->

  <!-- Google Tag Manager -->
  <script>(function (w, d, s, l, i) {
      w[l] = w[l] || []; w[l].push({
        'gtm.start':
          new Date().getTime(), event: 'gtm.js'
      }); var f = d.getElementsByTagName(s)[0],
        j = d.createElement(s), dl = l != 'dataLayer' ? '&l=' + l : ''; j.async = true; j.src =
          'https://www.googletagmanager.com/gtm.js?id=' + i + dl; f.parentNode.insertBefore(j, f);
    })(window, document, 'script', 'dataLayer', 'GTM-TX74BRHC');</script>
  <!-- End Google Tag Manager -->

  <!-- Google Tag Manager (noscript) -->
  <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-TX74BRHC" height="0" width="0"
      style="display:none;visibility:hidden"></iframe></noscript>
  <!-- End Google Tag Manager (noscript) -->


</head>

<body class="h-full flex items-center justify-center p-4">
    <div class="max-w-md w-full space-y-8">
        <div class="text-center">
            <div class="mx-auto h-12 w-12 bg-blue-100 rounded-full flex items-center justify-center mb-4">
                <svg class="h-6 w-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                    </path>
                </svg>
            </div>
            <h2 class="text-3xl font-bold text-gray-900 mb-2">Verifikasi OTP</h2>
            <p class="text-gray-600 text-sm">
                Kami telah mengirimkan kode verifikasi 6 digit ke
            </p>
            <p class="text-gray-900 font-medium">{{ auth()->user()->email }} dan ke nomor {{ auth()->user()->phone }}
            </p>
            @if ($errors->any())
                <div class="bg-red-100 text-red-700 p-2 rounded my-5">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>

        <form class="space-y-6" method="POST" action="{{ route('otp.verify.post') }}">
            @csrf
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-3 text-center">
                    Masukkan Kode OTP
                </label>
                <div class="flex justify-center space-x-3">
                    <input type="text" maxlength="1"
                        class="otp-input w-12 h-12 text-center text-xl font-semibold border-2 border-gray-300 rounded-lg focus:border-primary focus:ring-2 focus:ring-blue-200 focus:outline-none transition-colors"
                        aria-label="Digit pertama OTP" required>
                    <input type="text" maxlength="1"
                        class="otp-input w-12 h-12 text-center text-xl font-semibold border-2 border-gray-300 rounded-lg focus:border-primary focus:ring-2 focus:ring-blue-200 focus:outline-none transition-colors"
                        aria-label="Digit kedua OTP" required>
                    <input type="text" maxlength="1"
                        class="otp-input w-12 h-12 text-center text-xl font-semibold border-2 border-gray-300 rounded-lg focus:border-primary focus:ring-2 focus:ring-blue-200 focus:outline-none transition-colors"
                        aria-label="Digit ketiga OTP" required>
                    <input type="text" maxlength="1"
                        class="otp-input w-12 h-12 text-center text-xl font-semibold border-2 border-gray-300 rounded-lg focus:border-primary focus:ring-2 focus:ring-blue-200 focus:outline-none transition-colors"
                        aria-label="Digit keempat OTP" required>
                    <input type="text" maxlength="1"
                        class="otp-input w-12 h-12 text-center text-xl font-semibold border-2 border-gray-300 rounded-lg focus:border-primary focus:ring-2 focus:ring-blue-200 focus:outline-none transition-colors"
                        aria-label="Digit kelima OTP" required>
                    <input type="text" maxlength="1"
                        class="otp-input w-12 h-12 text-center text-xl font-semibold border-2 border-gray-300 rounded-lg focus:border-primary focus:ring-2 focus:ring-blue-200 focus:outline-none transition-colors"
                        aria-label="Digit keenam OTP" required>
                </div>
            </div>

            <!-- Hidden input untuk menampung OTP -->
            <input type="hidden" name="otp" id="otp-value">
            <input type="hidden" name="email" value="{{ auth()->user()->email }}">

            <button type="submit" id="submit-btn"
                class="w-full bg-primary text-white py-3 px-4 rounded-lg font-medium hover:bg-primary-hover focus:ring-4 focus:ring-blue-200 focus:outline-none transition-colors disabled:opacity-50 disabled:cursor-not-allowed flex justify-center items-center gap-2">
                <span id="btn-text">Verifikasi Kode</span>
                <svg id="loading-spinner" class="hidden animate-spin h-5 w-5 text-white"
                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                        stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
                </svg>
            </button>
        </form>

        <div class="text-center space-y-3">
            <p class="text-sm text-gray-600">
                Tidak menerima kode?
            </p>
            <form action="{{ route('otp.resend') }}" method="post">
                @csrf
                <input type="hidden" name="email" value="{{ auth()->user()->email }}">
                <button type="submit" onclick="handleSubmit(this)"
                    class="text-primary hover:text-primary-hover font-medium text-sm focus:outline-none focus:underline">
                    <span id="btn-send">Kirim Ulang Kode</span>
                    <svg id="loading-send" class="hidden animate-spin h-5 w-5 text-white"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                            stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
                    </svg>
                </button>
            </form>
            <div class="text-xs text-gray-500">
                Kirim ulang dalam <span class="font-medium text-gray-700">00:59</span>
            </div>
        </div>

        <div class="text-center">
            <form id="logout-form" method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                    class="text-gray-600 hover:text-gray-700 text-sm focus:outline-none focus:underline">
                    ‚Üê Kembali ke Login
                </button>
            </form>
        </div>
    </div>

    <script>
        // Auto-focus next input when typing
        const inputs = document.querySelectorAll('input[type="text"]');
        inputs.forEach((input, index) => {
            input.addEventListener('input', (e) => {
                if (e.target.value.length === 1 && index < inputs.length - 1) {
                    inputs[index + 1].focus();
                }
            });

            input.addEventListener('keydown', (e) => {
                if (e.key === 'Backspace' && e.target.value === '' && index > 0) {
                    inputs[index - 1].focus();
                }
            });
        });

        // Simple countdown timer
        let timeLeft = 540;
        const timerElement = document.querySelector('span.font-medium.text-gray-700');
        const countdown = setInterval(() => {
            const minutes = Math.floor(timeLeft / 60);
            const seconds = timeLeft % 60;
            timerElement.textContent =
                `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;

            if (timeLeft <= 0) {
                clearInterval(countdown);
                timerElement.textContent = '00:00';
            }
            timeLeft--;
        }, 1000);
    </script>


    <script>
        const otpInputs = document.querySelectorAll('.otp-input');
        const otpHidden = document.getElementById('otp-value');
        const form = otpHidden.closest('form');

        // auto fokus ke input berikutnya
        otpInputs.forEach((input, index) => {
            input.addEventListener('input', () => {
                if (input.value.length === 1 && index < otpInputs.length - 1) {
                    otpInputs[index + 1].focus();
                }
            });
        });

        // sebelum submit, gabungkan semua nilai ke hidden input
        form.addEventListener('submit', () => {
            let otp = '';
            otpInputs.forEach(input => otp += input.value);
            otpHidden.value = otp;
        });
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
    function handleSubmit(btn) {
        btn.disabled = true; // cegah klik double
        document.getElementById("btn-send").textContent = "Sedang Mengirim Ulang ...";
        document.getElementById("loading-send").classList.remove("hidden");
        btn.closest("form").submit(); // submit form secara normal
    }
    </script>
</body>

</html>
