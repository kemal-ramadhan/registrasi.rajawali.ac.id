<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <link rel="shortcut icon" href="{{ asset('assets/icons/bth.png') }}" type="image/x-icon">
  <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
  <title>{{ $title }} | Penerimaan Mahasiswa Baru Universitas Bakti Tunas Husada</title>
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
<body class="flex flex-col min-h-screen text-xs font-sora bg-latar">
    <main class="flex-grow">
        <!-- Konten utama -->
        <div class="py-2 bg-latar">
            <nav class="container mx-auto w-full" x-data="{ open: false }">
                <div class="mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between items-center">
                        <!-- Sisi Kiri (Logo) -->
                        <div class="flex items-center gap-3">
                            <img src="{{ asset('assets/icons/bth-logo.svg') }}" alt="ubth" style="width: 50px">
                            <div class="flex flex-col">
                                <h1 class="text-lg font-sora font-bold drop-shadow-[0_2px_2px_rgba(255,255,255,0.7)]">Universitas Bakti Tunas Husada</h1>
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
            @yield('content')
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
    

</body>
</html>