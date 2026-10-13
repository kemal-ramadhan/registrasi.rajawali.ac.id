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

<!-- SweetAlert2 JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.6.16/dist/sweetalert2.min.js"></script>


<script async data-watzapkey="maVs1933" src="https://cdn.watzap.id/widget-api.js"></script>

{{-- select --}}
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

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
  <!-- End Meta Pixel Code -->

  <!-- Kampus -->
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
<body class="flex flex-col min-h-screen text-xs font-sora bg-latar">
    <main class="flex-grow">
        <!-- Konten utama -->
        <div class="py-2 bg-latar">
            <nav class="container mx-auto w-full" x-data="{ open: false }">
                <div class="mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between items-center">
                        <!-- Sisi Kiri (Logo) -->
                        <div class="flex items-center gap-3">
                            <img src="{{ asset('assets/icons/IKes.png') }}" alt="IKes Rajawali" style="width: 50px">
                            <div class="flex flex-col">
                                <h1 class="text-lg font-sora font-bold drop-shadow-[0_2px_2px_rgba(255,255,255,0.7)]">Institut Kesehatan Rajawali</h1>
                                <small class="font-sora font-semibold drop-shadow-[0_1px_1px_rgba(255,255,255,0.7)]"><i>Transforming New Generation</i></small>
                            </div>
                        </div>
        
                        <!-- Sisi Kanan (Profile - Desktop) -->
                        <div class="hidden md:flex items-center space-x-3">
                            @auth
                                <div class="relative" x-data="{ show: false }">
                                    <button @click="show = !show" class="flex items-center space-x-3 text-gray-700 focus:outline-none gap-3">
                                        <div class="flex flex-col gap-1 text-right">
                                            <span>{{ auth()->user()->name }}</span>
                                            <span>{{ auth()->user()->email }}</span>
                                        </div>
                                        <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}" 
                                             alt="Profile" class="w-8 h-8 rounded-full">
                                    </button>
        
                                    <!-- Dropdown Profile -->
                                    <div x-show="show" @click.away="show = false" class="absolute right-0 mt-2 w-48 bg-white border rounded-lg shadow-md p-2">
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <button type="submit" class="block w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100">
                                                Logout
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @else
                                <a href="{{ route('login') }}" class="text-gray-700 hover:text-blue-600">Login</a>
                            @endauth
                        </div>
                    </div>
        
                </div>
            </nav>
        </div>    

        <div class="flex gap-5 m-5 items-start justify-center">
            {{-- sidebar --}}
            <div id="sidebar" class="hidden md:sticky fixed z-50 md:z-0 left-0 md:left-auto top-0 w-3/4 h-screen md:h-auto lg:flex flex-col md:w-2/12 bg-white p-5 rounded-none md:rounded-xl">
                <button @click="sidebarOpen = false" class="absolute top-2 right-2 p-2 text-gray-600 hover:text-gray-900 md:hidden">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-x-lg w-5 h-5" viewBox="0 0 16 16">
                        <path d="M2.146 2.146a.5.5 0 0 1 .708 0L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8 2.146 2.854a.5.5 0 0 1 0-.708z"/>
                    </svg>
                </button> 
                <span class="font-sora text-gray-600 text-xs mb-3">Menu Utama</span>
                <ul class="flex flex-col gap-2 mb-3">
                    <li>
                        <a href="{{ route('beranda') }}" class="font-sora text-xs flex gap-5 items-center py-2 px-3 rounded-lg hover:bg-primary hover:text-white @isActive('dashboard')">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-house w-4" viewBox="0 0 16 16">
                                <path d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L2 8.207V13.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5V8.207l.646.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293zM13 7.207V13.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V7.207l5-5z"/>
                              </svg>
                              <span>Halaman Utama</span>
                        </a>
                    </li>
                    <li>
                        <button class="w-full text-xs flex items-center justify-between px-3 py-2 text-gray-900 rounded-lg hover:bg-primary hover:text-white @isParentActive('referensi/*, fakultas.index')" onclick="toggleMenu('submenu-mahasiswa')">
                            <div class="flex items-center gap-5">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-people w-4" viewBox="0 0 16 16">
                                    <path d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1zm-7.978-1L7 12.996c.001-.264.167-1.03.76-1.72C8.312 10.629 9.282 10 11 10c1.717 0 2.687.63 3.24 1.276.593.69.758 1.457.76 1.72l-.008.002-.014.002zM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4m3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0M6.936 9.28a6 6 0 0 0-1.23-.247A7 7 0 0 0 5 9c-4 0-5 3-5 4q0 1 1 1h4.216A2.24 2.24 0 0 1 5 13c0-1.01.377-2.042 1.09-2.904.243-.294.526-.569.846-.816M4.92 10A5.5 5.5 0 0 0 4 13H1c0-.26.164-1.03.76-1.724.545-.636 1.492-1.256 3.16-1.275ZM1.5 5.5a3 3 0 1 1 6 0 3 3 0 0 1-6 0m3-2a2 2 0 1 0 0 4 2 2 0 0 0 0-4"/>
                                  </svg>
                                <span>Data Saya</span>
                            </div>
                            <svg class="w-4 h-4 transition-transform" id="icon-submenu-mahasiswa" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                        <!-- Submenu -->
                        <ul id="submenu-mahasiswa" class="pl-8 mt-2 space-y-2 text-xs">
                            <li><a href="{{ route('personal.data.index') }}" class="block px-4 py-2 text-gray-700 hover:bg-primary hover:text-white rounded-md @isActive('personal.data.index')">Data Pribadi</a></li>
                            <li><a href="{{ route('personal.data.pendidikan') }}" class="block px-4 py-2 text-gray-700 hover:bg-primary hover:text-white rounded-md @isActive('personal.data.pendidikan')">Pendidikan Terakhir</a></li>
                            <li><a href="{{ route('personal.data.address') }}" class="block px-4 py-2 text-gray-700 hover:bg-primary hover:text-white rounded-md @isActive('personal.data.address')">Alamat</a></li>
                            <li><a href="{{ route('personal.data.income') }}" class="block px-4 py-2 text-gray-700 hover:bg-primary hover:text-white rounded-md @isActive('personal.data.income')">Penghasilan</a></li>
                            <li><a href="{{ route('personal.data.family') }}" class="block px-4 py-2 text-gray-700 hover:bg-primary hover:text-white rounded-md @isActive('personal.data.family')">Kaluarga</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="{{ route('jalur.pendaftaran') }}" class="font-sora text-xs text-gray-900 flex gap-5 items-center py-2 px-3 rounded-lg hover:bg-primary hover:text-white @isActive('registration.program')">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-journals w-3" viewBox="0 0 16 16">
                                <path d="M5 0h8a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2 2 2 0 0 1-2 2H3a2 2 0 0 1-2-2h1a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1H1a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v9a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H5a1 1 0 0 0-1 1H3a2 2 0 0 1 2-2"/>
                                <path d="M1 6v-.5a.5.5 0 0 1 1 0V6h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1zm0 3v-.5a.5.5 0 0 1 1 0V9h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1zm0 2.5v.5H.5a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1H2v-.5a.5.5 0 0 0-1 0"/>
                              </svg>
                              <span>Jalur Pendaftaran</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('test.index') }}" class="font-sora text-xs text-gray-900 flex gap-5 items-center py-2 px-3 rounded-lg hover:bg-primary hover:text-white @isActive('registration.program')">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-clipboard2-pulse w-4" viewBox="0 0 16 16">
                                <path d="M9.5 0a.5.5 0 0 1 .5.5.5.5 0 0 0 .5.5.5.5 0 0 1 .5.5V2a.5.5 0 0 1-.5.5h-5A.5.5 0 0 1 5 2v-.5a.5.5 0 0 1 .5-.5.5.5 0 0 0 .5-.5.5.5 0 0 1 .5-.5z"/>
                                <path d="M3 2.5a.5.5 0 0 1 .5-.5H4a.5.5 0 0 0 0-1h-.5A1.5 1.5 0 0 0 2 2.5v12A1.5 1.5 0 0 0 3.5 16h9a1.5 1.5 0 0 0 1.5-1.5v-12A1.5 1.5 0 0 0 12.5 1H12a.5.5 0 0 0 0 1h.5a.5.5 0 0 1 .5.5v12a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5z"/>
                                <path d="M9.979 5.356a.5.5 0 0 0-.968.04L7.92 10.49l-.94-3.135a.5.5 0 0 0-.926-.08L4.69 10H4.5a.5.5 0 0 0 0 1H5a.5.5 0 0 0 .447-.276l.936-1.873 1.138 3.793a.5.5 0 0 0 .968-.04L9.58 7.51l.94 3.135A.5.5 0 0 0 11 11h.5a.5.5 0 0 0 0-1h-.128z"/>
                              </svg>
                              <span>Proses Seleksi</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('paymant.index') }}" class="font-sora text-xs text-gray-900 flex gap-5 items-center py-2 px-3 rounded-lg hover:bg-primary hover:text-white @isActive('paymant')">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-credit-card-2-front w-4" viewBox="0 0 16 16">
                                <path d="M14 3a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1zM2 2a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2z"/>
                                <path d="M2 5.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5zm0 3a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5m3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5m3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5m3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5"/>
                              </svg>
                              <span>Daftar Ulang</span>
                        </a>
                    </li>
                </ul>
                <hr class="my-5">
                <span class="font-sora text-gray-600 text-xs mb-3">Bantuan</span>
                <ul class="flex flex-col gap-2">
                    <li>
                        <a href="{{ route('bantuan.customer') }}" class="font-sora text-xs text-gray-900 flex gap-5 items-center py-2 px-3 rounded-lg hover:bg-primary hover:text-white @isActive('bantuan')">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-info-circle w-4" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                                <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0"/>
                              </svg>
                              <span>Bantuan</span>
                        </a>
                    </li>
                    <li>
                        <form id="logout-form" method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="button" id="logout-btn" class="font-sora text-xs flex gap-5 items-center py-2 px-3 rounded-lg text-red-400 hover:bg-primary hover:text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-box-arrow-right w-4" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0z"/>
                                    <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708z"/>
                                </svg>
                                <span>Keluar</span>
                            </button>
                        </form>
                        
                        <script>
                            document.getElementById('logout-btn').addEventListener('click', function () {
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
                        
                    </li>
                </ul>
            </div>

            {{-- floating menu for mobile --}}
            <div class="bg-primary lg:hidden p-5 w-[90vw] fixed bottom-5 mx-5 rounded-full flex items-center justify-between font-bold z-50">
                <a href="{{ route('beranda') }}" class="{{ $menu == 'home' ? 'bg-white text-primary' : 'text-white' }} rounded-full font-sora text-xs flex gap-2 items-center py-2 px-3">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-house w-5" viewBox="0 0 16 16">
                        <path d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L2 8.207V13.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5V8.207l.646.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293zM13 7.207V13.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V7.207l5-5z"/>
                    </svg>
                    <span class="{{ $menu == 'home' ? 'block font-semibold' : 'hidden' }}">Home</span>
                </a>                
                <a href="{{ route('jalur.pendaftaran') }}" class="{{ $menu == 'pendaftaran' ? 'bg-white text-primary' : 'text-white' }} rounded-full font-sora text-xs flex gap-2 items-center py-2 px-3">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-folder-plus w-5" viewBox="0 0 16 16">
                        <path d="m.5 3 .04.87a2 2 0 0 0-.342 1.311l.637 7A2 2 0 0 0 2.826 14H9v-1H2.826a1 1 0 0 1-.995-.91l-.637-7A1 1 0 0 1 2.19 4h11.62a1 1 0 0 1 .996 1.09L14.54 8h1.005l.256-2.819A2 2 0 0 0 13.81 3H9.828a2 2 0 0 1-1.414-.586l-.828-.828A2 2 0 0 0 6.172 1H2.5a2 2 0 0 0-2 2m5.672-1a1 1 0 0 1 .707.293L7.586 3H2.19q-.362.002-.683.12L1.5 2.98a1 1 0 0 1 1-.98z"/>
                        <path d="M13.5 9a.5.5 0 0 1 .5.5V11h1.5a.5.5 0 1 1 0 1H14v1.5a.5.5 0 1 1-1 0V12h-1.5a.5.5 0 0 1 0-1H13V9.5a.5.5 0 0 1 .5-.5"/>
                      </svg>
                    <span class="{{ $menu == 'pendaftaran' ? 'block font-semibold' : 'hidden' }}">Pendaftaran</span>
                </a>
                <a href="{{ route('test.index') }}" class="{{ $menu == 'seleksi' ? 'bg-white text-primary' : 'text-white' }} rounded-full font-sora text-xs flex gap-2 items-center py-2 px-3">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-clipboard2-pulse w-5" viewBox="0 0 16 16">
                        <path d="M9.5 0a.5.5 0 0 1 .5.5.5.5 0 0 0 .5.5.5.5 0 0 1 .5.5V2a.5.5 0 0 1-.5.5h-5A.5.5 0 0 1 5 2v-.5a.5.5 0 0 1 .5-.5.5.5 0 0 0 .5-.5.5.5 0 0 1 .5-.5z"/>
                        <path d="M3 2.5a.5.5 0 0 1 .5-.5H4a.5.5 0 0 0 0-1h-.5A1.5 1.5 0 0 0 2 2.5v12A1.5 1.5 0 0 0 3.5 16h9a1.5 1.5 0 0 0 1.5-1.5v-12A1.5 1.5 0 0 0 12.5 1H12a.5.5 0 0 0 0 1h.5a.5.5 0 0 1 .5.5v12a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5z"/>
                        <path d="M9.979 5.356a.5.5 0 0 0-.968.04L7.92 10.49l-.94-3.135a.5.5 0 0 0-.926-.08L4.69 10H4.5a.5.5 0 0 0 0 1H5a.5.5 0 0 0 .447-.276l.936-1.873 1.138 3.793a.5.5 0 0 0 .968-.04L9.58 7.51l.94 3.135A.5.5 0 0 0 11 11h.5a.5.5 0 0 0 0-1h-.128z"/>
                      </svg>
                    <span class="{{ $menu == 'seleksi' ? 'block font-semibold' : 'hidden' }}">Seleksi</span>
                </a>
                <a href="{{ route('paymant.index') }}" class="{{ $menu == 'pembayaran' ? 'bg-white text-primary' : 'text-white' }} rounded-full font-sora text-xs flex gap-2 items-center py-2 px-3">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-credit-card-2-front w-5" viewBox="0 0 16 16">
                        <path d="M14 3a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1zM2 2a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2z"/>
                        <path d="M2 5.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5zm0 3a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5m3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5m3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5m3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5"/>
                      </svg>
                    <span class="{{ $menu == 'pembayaran' ? 'block font-semibold' : 'hidden' }}">Pembayaran</span>
                </a>
                <a href="{{ route('bantuan.customer') }}" class="{{ $menu == 'profile' ? 'bg-white text-primary' : 'text-white' }} rounded-full font-sora text-xs flex gap-2 items-center py-2 px-3">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-person-circle w-5" viewBox="0 0 16 16">
                        <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
                        <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1"/>
                      </svg>
                    <span class="{{ $menu == 'profile' ? 'block font-semibold' : 'hidden' }}">Profile</span>
                </a>
            </div>
    
            {{-- main content --}}
            <div class="flex flex-col gap-5 text-xs w-full md:w-4/5 px-2 rounded-xl">
                @yield('content')
            </div>
        </div> 
    </main>
    

    <hr>
    <footer class="flex justify-center items-center py-3 px-3 mx-auto text-center">
        <small>Copyright &copy; {{ date('Y') }} - Sistem Penerimaan Mahasiswa Baru By HexagonInc</small>
    </footer>

    <!-- Menampilkan SweetAlert jika ada session 'success' -->
    @if (session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: '{{ session('success') }}',
        });
    </script>
    @endif
    @if (session('error'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Gagal!',
            text: '{{ session('error') }}',
        });
    </script>
    @endif

    
    <script>
        const menuBtn = document.getElementById('menu-btn');
        const closeBtn = document.getElementById('close-btn');
        const sidebar = document.getElementById('sidebar');

        menuBtn.addEventListener('click', () => {
            sidebar.classList.remove('-translate-x-full');
        });

        closeBtn.addEventListener('click', () => {
            sidebar.classList.add('-translate-x-full');
        });
    </script>

    <script>
        function toggleMenu(id) {
            const submenu = document.getElementById(id);
            const icon = document.getElementById(`icon-${id}`);

            submenu.classList.toggle("hidden");
            icon.classList.toggle("rotate-180");
        }
    </script>   
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('navbar', () => ({
                open: false
            }));
        });
    </script>
</body>
</html>