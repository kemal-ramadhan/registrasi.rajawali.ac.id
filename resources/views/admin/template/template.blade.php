<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="shortcut icon" href="{{ asset('assets/icons/IKes.png') }}" type="image/x-icon">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <title>{{ $title }} | Penerimaan Mahasiswa Baru Institut Kesehatan Rajawali</title>
    <!-- SweetAlert2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.6.16/dist/sweetalert2.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.6.16/dist/sweetalert2.min.js"></script>

    {{-- select --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.6.0.js"
        integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <style>
        .cke_notification_warning {
            display: none !important;
        }
    </style>
    <script src="https://cdn.ckeditor.com/4.22.1/full/ckeditor.js"></script>

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
  <!-- End Meta Pixel Code -->

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

<body class="min-h-screen bg-[#F0F0F0] text-xs" x-data="{ menuOpen: false }">
    <div class="absolute bottom-0 right-0 w-1/2 h-1/2 bg-yellow-300 bg-opacity-10 rounded-full blur-3xl z-[-1]"></div>
    <div class="absolute top-0 left-0 w-1/2 h-1/2 bg-primary bg-opacity-10 rounded-full blur-3xl z-[-1]"></div>

    <div class="flex flex-col gap-5 m-5">

        {{-- ============================= --}}
        {{-- HEADER: Logo/Title + Info User + Burger --}}
        {{-- ============================= --}}
        <div class="flex items-center justify-between bg-white p-5 rounded-xl">
            <div class="flex gap-3 items-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-house w-4"
                    viewBox="0 0 16 16">
                    <path
                        d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L2 8.207V13.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5V8.207l.646.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293zM13 7.207V13.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V7.207l5-5z" />
                </svg>
                <a href="" class="text-gray-900 font-sora font-semibold">{{ $title }}</a>
            </div>

            <div class="flex items-center gap-4">
                @auth
                {{-- Info user - selalu tampil (desktop & mobile) --}}
                <div class="relative" x-data="{ show: false }">
                    <button @click="show = !show"
                        class="flex items-center space-x-3 text-gray-700 focus:outline-none gap-2">
                        <div class="hidden sm:flex flex-col text-right">
                            <span class="font-semibold font-sora">{{ auth()->user()->name }}</span>
                            <span>{{ auth()->user()->email }}</span>
                        </div>
                        <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}"
                            alt="Profile" class="w-9 h-9 rounded-full">
                    </button>

                    <!-- Dropdown Profile -->
                    <div x-show="show" @click.away="show = false" x-cloak
                        class="absolute right-0 mt-2 w-48 bg-white border rounded-lg shadow-md p-2 z-50">
                        <div class="sm:hidden px-4 py-2 border-b mb-1">
                            <p class="font-semibold font-sora">{{ auth()->user()->name }}</p>
                            <p class="text-gray-500">{{ auth()->user()->email }}</p>
                        </div>
                        <a href="{{ route('admin.index') }}"
                            class="block w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100 rounded-md">Profil</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                class="block w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100 rounded-md">
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
                @else
                <a href="{{ route('login') }}" class="text-gray-700 hover:text-blue-600">Login</a>
                @endauth

                {{-- Burger button - hanya tampil di mode mobile --}}
                <button @click="menuOpen = !menuOpen"
                    class="md:hidden flex items-center justify-center w-10 h-10 bg-gray-100 rounded-lg text-gray-700">
                    <svg x-show="!menuOpen" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                        class="bi bi-list w-6 h-6" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M2.5 3.5a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1h-10a.5.5 0 0 1-.5-.5m0 4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1h-10a.5.5 0 0 1-.5-.5m0 4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1h-10a.5.5 0 0 1-.5-.5" />
                    </svg>
                    <svg x-show="menuOpen" x-cloak xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                        class="bi bi-x-lg w-5 h-5" viewBox="0 0 16 16">
                        <path
                            d="M2.146 2.146a.5.5 0 0 1 .708 0L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8 2.146 2.854a.5.5 0 0 1 0-.708z" />
                    </svg>
                </button>
            </div>
        </div>

        {{-- ============================= --}}
        {{-- TOP MENU BAR --}}
        {{-- Desktop/tablet (md+): selalu tampil, horizontal, di bawah header --}}
        {{-- Mobile: hidden default, tampil saat burger diklik, vertikal --}}
        {{-- ============================= --}}
        <nav :class="{ 'hidden': !menuOpen }"
            class="md:flex flex-col md:flex-row md:flex-wrap md:items-center gap-1 md:gap-2 bg-white p-3 rounded-xl relative z-40">

            <a href="{{ route('dashboard') }}"
                class="font-sora text-xs flex gap-2 items-center py-2 px-3 rounded-lg hover:bg-primary hover:text-white @isActive('dashboard')">
                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-house w-4"
                    viewBox="0 0 16 16">
                    <path
                        d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L2 8.207V13.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5V8.207l.646.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293zM13 7.207V13.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V7.207l5-5z" />
                </svg>
                <span>Dashboard</span>
            </a>

            <a href="{{ route('mahasiswa.index') }}"
                class="font-sora text-xs text-gray-900 flex gap-2 items-center py-2 px-3 rounded-lg hover:bg-primary hover:text-white @isActive('mahasiswa')">
                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-people w-4"
                    viewBox="0 0 16 16">
                    <path
                        d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1zm-7.978-1L7 12.996c.001-.264.167-1.03.76-1.72C8.312 10.629 9.282 10 11 10c1.717 0 2.687.63 3.24 1.276.593.69.758 1.457.76 1.72l-.008.002-.014.002zM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4m3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0M6.936 9.28a6 6 0 0 0-1.23-.247A7 7 0 0 0 5 9c-4 0-5 3-5 4q0 1 1 1h4.216A2.24 2.24 0 0 1 5 13c0-1.01.377-2.042 1.09-2.904.243-.294.526-.569.846-.816M4.92 10A5.5 5.5 0 0 0 4 13H1c0-.26.164-1.03.76-1.724.545-.636 1.492-1.256 3.16-1.275ZM1.5 5.5a3 3 0 1 1 6 0 3 3 0 0 1-6 0m3-2a2 2 0 1 0 0 4 2 2 0 0 0 0-4" />
                </svg>
                <span>Data Mahasiswa</span>
            </a>

            @if (auth()->user()->role_akses === 'Super Admin')
{{-- Dropdown: Data Referensi --}}
<div class="relative w-full md:w-auto" x-data="{ open: false }" @click.away="open = false">

    <button
        @click="open = !open"
        class="w-full md:w-auto text-xs flex items-center justify-between md:justify-start gap-2 px-3 py-2 text-gray-900 rounded-lg hover:bg-primary hover:text-white @isParentActive('referensi/*, fakultas.index')">

        <span class="flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg"
                fill="currentColor"
                class="bi bi-bar-chart w-4"
                viewBox="0 0 16 16">
                <path
                    d="M4 11H2v3h2zm5-4H7v7h2zm5-5v12h-2V2zm-2-1a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1zM6 7a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v7a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1zm-5 4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1z" />
            </svg>

            <span>Data Referensi</span>
        </span>

        <svg
            class="w-4 h-4 transition-transform"
            :class="{ 'rotate-180': open }"
            xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 20 20"
            fill="currentColor">
            <path
                fill-rule="evenodd"
                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                clip-rule="evenodd" />
        </svg>
    </button>

    {{-- FLOATING SUBMENU --}}
    <ul
        x-show="open"
        x-cloak
        x-transition.origin.top.left
        class="absolute left-0 top-full mt-2 w-56 bg-white border border-gray-100 shadow-xl rounded-lg p-1 z-[100]">

        <li>
            <a href="{{ route('referensi.jenjang') }}"
                class="block px-4 py-2 text-gray-700 hover:bg-primary hover:text-white rounded-md @isActive('referensi.jenjang')">
                Jenjang Studi
            </a>
        </li>

        <li>
            <a href="{{ route('fakultas.index') }}"
                class="block px-4 py-2 text-gray-700 hover:bg-primary hover:text-white rounded-md @isActive('fakultas.index')">
                Fakultas
            </a>
        </li>

        <li>
            <a href="{{ route('departement.index') }}"
                class="block px-4 py-2 text-gray-700 hover:bg-primary hover:text-white rounded-md @isActive('departement.index')">
                Program Studi
            </a>
        </li>
    </ul>
</div>

            {{-- Dropdown: Jalur Pendaftaran --}}
<div class="relative w-full md:w-auto" x-data="{ open: false }" @click.away="open = false">

    <button
        @click="open = !open"
        class="w-full md:w-auto text-xs flex items-center justify-between md:justify-start gap-2 px-3 py-2 text-gray-900 rounded-lg hover:bg-primary hover:text-white @isParentActive('registration.index, exam.index')">

        <span class="flex items-center gap-2">
            {{-- icon --}}
            <span>Jalur Pendaftaran</span>
        </span>

        <svg
            class="w-4 h-4 transition-transform"
            :class="{ 'rotate-180': open }"
            xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 20 20"
            fill="currentColor">
            <path
                fill-rule="evenodd"
                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                clip-rule="evenodd" />
        </svg>
    </button>

    <ul
        x-show="open"
        x-cloak
        x-transition.origin.top.left
        class="absolute left-0 top-full mt-2 w-56 bg-white border border-gray-100 shadow-xl rounded-lg p-1 z-[100] space-y-1 text-xs">

        <li>
            <a href="{{ route('registration.index') }}"
                class="block px-4 py-2 text-gray-700 hover:bg-primary hover:text-white rounded-md @isActive('registration.index')">
                Jalur Pendaftaran
            </a>
        </li>

        <li>
            <a href="{{ route('exam.index') }}"
                class="block px-4 py-2 text-gray-700 hover:bg-primary hover:text-white rounded-md @isActive('exam.index')">
                Proses Seleksi
            </a>
        </li>

    </ul>
</div>
            @endif

            <a href="{{ route('process.index') }}"
                class="font-sora text-xs text-gray-900 flex gap-2 items-center py-2 px-3 rounded-lg hover:bg-primary hover:text-white @isActive('process')">
                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-journals w-3"
                    viewBox="0 0 16 16">
                    <path
                        d="M5 0h8a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2 2 2 0 0 1-2 2H3a2 2 0 0 1-2-2h1a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1H1a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v9a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H5a1 1 0 0 0-1 1H3a2 2 0 0 1 2-2" />
                    <path
                        d="M1 6v-.5a.5.5 0 0 1 1 0V6h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1zm0 3v-.5a.5.5 0 0 1 1 0V9h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1zm0 2.5v.5H.5a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1H2v-.5a.5.5 0 0 0-1 0" />
                </svg>
                <span>Pendaftar</span>
            </a>

            {{-- Dropdown: Keuangan (Riwayat Pembayaran, Pembayaran, Metode Pembayaran) --}}
            <div
                class="relative w-full md:w-auto"
                x-data="{ open: false }"
                @click.away="open = false"
            >
                <button
                    type="button"
                    @click="open = !open"
                    class="flex items-center justify-between w-full md:w-auto px-3 py-2 rounded-md hover:bg-gray-100 transition"
                >
                    <span>Pembayaran</span>

                    <svg
                        class="w-3 h-3 ml-2 transition-transform"
                        :class="{ 'rotate-180': open }"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M19 9l-7 7-7-7"
                        />
                    </svg>
                </button>

                <ul
                    x-show="open"
                    x-cloak
                    x-transition.origin.top.left
                    class="absolute left-0 top-full mt-2 w-60 bg-white border border-gray-100 shadow-xl rounded-lg p-1 z-[100] space-y-1 text-xs"
                >
                    <li>
                        <a href="{{ route('pembayaran.index') }}"
                        class="block px-3 py-2 rounded-md hover:bg-gray-100 transition">
                            Riwayat Pembayaran
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('mahasiswa-paymant.index') }}"
                        class="block px-3 py-2 rounded-md hover:bg-gray-100 transition">
                            Pembayaran Mahasiswa
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('biayareferensi.index') }}"
                        class="block px-3 py-2 rounded-md hover:bg-gray-100 transition">
                            Registrasi Ulang
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('metode.index') }}"
                        class="block px-3 py-2 rounded-md hover:bg-gray-100 transition">
                            Metode Pembayaran
                        </a>
                    </li>
                </ul>
            </div>

            <a href="{{ route('referal.index') }}"
                class="font-sora text-xs text-gray-900 flex gap-2 items-center py-2 px-3 rounded-lg hover:bg-primary hover:text-white @isActive('referal')">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-link-45deg" viewBox="0 0 16 16">
                    <path
                        d="M4.715 6.542 3.343 7.914a3 3 0 1 0 4.243 4.243l1.828-1.829A3 3 0 0 0 8.586 5.5L8 6.086a1 1 0 0 0-.154.199 2 2 0 0 1 .861 3.337L6.88 11.45a2 2 0 1 1-2.83-2.83l.793-.792a4 4 0 0 1-.128-1.287z" />
                    <path
                        d="M6.586 4.672A3 3 0 0 0 7.414 9.5l.775-.776a2 2 0 0 1-.896-3.346L9.12 3.55a2 2 0 1 1 2.83 2.83l-.793.792c.112.42.155.855.128 1.287l1.372-1.372a3 3 0 1 0-4.243-4.243z" />
                </svg>
                <span>Code Referal</span>
            </a>

            <a href="{{ route('reports.index') }}"
                class="font-sora text-xs text-gray-900 flex gap-2 items-center py-2 px-3 rounded-lg hover:bg-primary hover:text-white @isActive('reports')">
                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-file-bar-graph w-4"
                    viewBox="0 0 16 16">
                    <path
                        d="M4.5 12a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.5.5zm3 0a.5.5 0 0 1-.5-.5v-4a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-.5.5zm3 0a.5.5 0 0 1-.5-.5v-6a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-.5.5z" />
                    <path
                        d="M4 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zm0 1h8a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1" />
                </svg>
                <span>Report Pendaftar</span>
            </a>

            {{-- Dropdown: Pengaturan --}}
            <div
                class="relative w-full md:w-auto md:ml-auto"
                x-data="{ open: false }"
                @click.away="open = false"
            >
                <button
                    type="button"
                    @click="open = !open"
                    class="flex items-center justify-between w-full md:w-auto px-3 py-2 rounded-md hover:bg-gray-100 transition"
                >
                    <span>Pengaturan</span>

                    <svg
                        class="w-3 h-3 ml-2 transition-transform"
                        :class="{ 'rotate-180': open }"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M19 9l-7 7-7-7"
                        />
                    </svg>
                </button>

                <ul
                    x-show="open"
                    x-cloak
                    x-transition.origin.top.right
                    class="absolute right-0 top-full mt-2 w-56 bg-white border border-gray-100 shadow-xl rounded-lg p-1 z-[100] space-y-1 text-xs"
                >
                    <li>
                        <a href="#"
                        class="block px-3 py-2 rounded-md hover:bg-gray-100 transition">
                            Profil
                        </a>
                    </li>

                    <li>
                        <a href="#"
                        class="block px-3 py-2 rounded-md hover:bg-gray-100 transition">
                            Log Aktivitas
                        </a>
                    </li>

                    <li>
                        <a href="#"
                        class="block px-3 py-2 rounded-md hover:bg-gray-100 transition">
                            Bantuan
                        </a>
                    </li>
                </ul>
            </div>

            {{-- Keluar / Logout --}}
            <div class="w-full md:w-auto">
                <form id="logout-form" method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="button" id="logout-btn"
                        class="w-full md:w-auto font-sora text-xs flex gap-2 items-center py-2 px-3 rounded-lg text-red-400 hover:bg-primary hover:text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-box-arrow-right w-4"
                            viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0z" />
                            <path fill-rule="evenodd"
                                d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708z" />
                        </svg>
                        <span>Keluar</span>
                    </button>
                </form>
                <script>
                    document.getElementById('logout-btn').addEventListener('click', function() {
                        Swal.fire({
                            title: "Konfirmasi Logout",
                            text: "Apakah Anda yakin ingin keluar?",
                            icon: "warning",
                            showCancelButton: true,
                            confirmButtonColor: "#d33",
                            cancelButtonColor: "#3085d6",
                            confirmButtonText: "Ya, Keluar",
                            cancelButtonText: "Batal"
                        }).then((result) => {
                            if (result.isConfirmed) {
                                document.getElementById('logout-form').submit();
                            }
                        });
                    });
                </script>
            </div>
        </nav>

        {{-- ============================= --}}
        {{-- MAIN CONTENT --}}
        {{-- ============================= --}}
        <div class="flex flex-col gap-5 text-xs">
            @yield('content')
        </div>
    </div>

    <!-- Menampilkan SweetAlert jika ada session 'success' -->
    @if (session('success'))
    <script>
        Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '{{ session('success') }}',
                confirmButtonText: 'OK',
                customClass: {
                    confirmButton: 'bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700'
                },
                buttonsStyling: false // penting agar Tailwind tidak tertimpa
            });
    </script>
    @endif
    <!-- Menampilkan SweetAlert jika ada session 'error' -->
    @if (session('error'))
    <script>
        Swal.fire({
                icon: 'error',
                title: 'Berhasil!',
                text: '{{ session('error') }}',
                confirmButtonText: 'OK',
                customClass: {
                    confirmButton: 'bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700'
                },
                buttonsStyling: false // penting agar Tailwind tidak tertimpa
            });
    </script>
    @endif

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('navbar', () => ({
                open: false
            }));
        });
    </script>

    <script>
        CKEDITOR.replace('description', {
            height: 200,
            toolbar: [{
                    name: 'basicstyles',
                    items: ['Bold', 'Italic', 'Underline']
                },
                {
                    name: 'paragraph',
                    items: ['NumberedList', 'BulletedList']
                },
                {
                    name: 'insert',
                    items: ['Image', 'Table']
                },
                {
                    name: 'styles',
                    items: ['Format']
                },
                {
                    name: 'tools',
                    items: ['Maximize']
                }
            ],
        });
    </script>
</body>

</html>