<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="manifest" href="{{ asset('manifest.json') }}">
    <meta name="theme-color" content="#4A90E2">

    <!-- Untuk Android -->
    <link rel="icon" sizes="192x192" href="{{ asset('assets/icons/bth.png') }}">
    <!-- Untuk iOS -->
    <link rel="apple-touch-icon" href="{{ asset('assets/icons/bth.png') }}">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <link rel="shortcut icon" href="{{ asset('assets/icons/bth.png') }}" type="image/x-icon">
    <title>{{ $title }} | Universitas Bakti Tunas Husada</title>

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

    <!-- kampus Meta Pixel Code -->
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

<body class="bg-slate-50 antialiased min-h-screen relative font-sans text-gray-700">

    <!-- Latar Belakang (Simple Campus Vibe) -->
    <div class="fixed inset-0 z-0 flex items-center justify-center pointer-events-none overflow-hidden">
        <!-- Foto kampus yang dibuat sangat samar -->
        <div class="absolute inset-0 bg-[url('/assets/images/bth-default.png')] bg-cover bg-center opacity-10 blur-[2px]"></div>
        <!-- Gradient penutup agar warna tetap soft & clean -->
        <div class="absolute inset-0 bg-gradient-to-br from-blue-50/90 via-slate-50/95 to-slate-100/90"></div>
        <!-- Ornamen outline kampus di pojok -->
        <img src="{{ asset('assets/icons/outline.png') }}" alt="outline" class="absolute -right-20 -bottom-20 w-96 opacity-[0.03] rotate-12">
    </div>

    <!-- Kontainer Utama (Tengah) -->
    <div class="relative z-10 flex min-h-screen items-center justify-center p-4 sm:p-6 lg:p-8">
        
        <!-- Kotak Konten (Card) -->
        <div class="w-full max-w-lg bg-white rounded-3xl shadow-[0_8px_30px_rgb(0,0,0,0.06)] p-6 sm:p-10 border border-slate-100">
            
            <!-- Header (Logo & Judul) -->
            <div class="flex flex-col items-center justify-center text-center mb-8">
                <img src="{{ asset('assets/icons/bth.png') }}" alt="Logo Universitas BTH" class="w-20 h-20 mb-5 object-contain">
                <h1 class="text-2xl sm:text-3xl font-sora font-bold text-slate-800 leading-tight">
                    {{ $headline ?? 'Selamat Datang' }}
                </h1>
                <h2 class="text-sm sm:text-base font-sora text-slate-500 mt-2">
                    {{ $subheadline ?? 'Penerimaan Mahasiswa Baru Universitas Bakti Tunas Husada' }}
                </h2>
            </div>

            <!-- Area Form / Yield Konten -->
            <div class="w-full">
                @yield('content')
            </div>

        </div>
    </div>

    <!-- Floating WhatsApp Button -->
    <a
        href="https://api.whatsapp.com/send?phone=6282117100200&text=Halo%2C%20saya%20ingin%20bertanya%20mengenai%20Pendaftaran%20Mahasiswa%20Baru%20(PMB)%20Universitas%20BTH."
        target="_blank"
        rel="noopener noreferrer"
        aria-label="Chat via WhatsApp"
        class="fixed bottom-[30px] right-[30px] w-[55px] h-[55px] bg-[#25D366] text-white rounded-full flex items-center justify-center shadow-lg hover:shadow-xl hover:-translate-y-1 transition-all duration-300 z-50"
    >
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-8 h-8">
            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347 M12.051 21.785h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884"/>
        </svg>
    </a>

</body>
</html>