<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="XMAS 2024 is a festive project crafted by the final-year MCT students of KdG. Challenge yourself with four exciting games, celebrate the holiday spirit, and win fantastic prizes!">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Default Title')</title>
    @vite('resources/sass/app.scss')
    @yield('scss')
    <script src="https://kit.fontawesome.com/26d2910850.js" crossorigin="anonymous" defer></script>
    <link rel="preconnect" href="https://fonts.googleapis.com" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="anonymous">
    <!-- Standard Favicon -->
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">

    <!-- Apple Touch Icon -->
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">

    <!-- Android Chrome -->
    <link rel="icon" type="image/png" sizes="192x192" href="/android-chrome-192x192.png">
    <link rel="icon" type="image/png" sizes="512x512" href="/android-chrome-512x512.png">

    <!-- Open Graph Meta Tags -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://happyholidays.mctantwerp.be">
    <meta property="og:title" content="XMAS 2024 | MCT Antwerp">
    <meta property="og:description"
        content="Discover the excitement of XMAS 2024! Find hidden posters, take on fun challenges, and win amazing prizes. Dive into a festive adventure brought to you by the last year innovative MCT students of KdG. Perfect for spreading holiday cheer and showcasing creativity during the most wonderful time of the year!">
    <meta property="og:image" content="{{ asset('og-image.png') }}">
    <meta property="og:image:alt"
        content="A picture of two hands with a phone showcasing the app. Along with regular branding.">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">

    <!-- Fonts -->
    <link rel="preload" href="https://fonts.googleapis.com/css2?family=Borel&display=swap" as="style"
        onload="this.rel='stylesheet'">
    <link rel="preload" href="https://fonts.googleapis.com/css2?family=Braah+One&display=swap" as="style"
        onload="this.rel='stylesheet'">
    <link rel="preload"
        href="https://fonts.googleapis.com/css2?family=Red+Hat+Display:ital,wght@0,300..900;1,300..900&display=swap"
        as="style" onload="this.rel='stylesheet'">
    <!-- Hotjar Tracking Code for https://happyholidays.mctantwerp.be/ -->
    <script>
        (function(h, o, t, j, a, r) {
            h.hj = h.hj || function() {
                (h.hj.q = h.hj.q || []).push(arguments)
            };
            h._hjSettings = {
                hjid: 5237356,
                hjsv: 6
            };
            a = o.getElementsByTagName('head')[0];
            r = o.createElement('script');
            r.async = 1;
            r.src = t + h._hjSettings.hjid + j + h._hjSettings.hjsv;
            a.appendChild(r);
        })(window, document, 'https://static.hotjar.com/c/hotjar-', '.js?sv=');
    </script>
    <!-- Cookie Free Analytics -->
    <script defer src="https://cloud.umami.is/script.js" data-website-id="777bf68f-180f-42cc-8cae-15176bc505ee"></script>

</head>

<body>
    {{-- <app-container id="app" :iscentered='true'>
        @yield('content')
    </app-container> --}}
    <div id="app">
        <snow-flakes></snow-flakes>
        @yield('navbar')
        <div class="snow"></div>
        <div class="gingerman">
        </div>
        <div class="candy">
        </div>
        <div class="content">
            @yield('content')
        </div>
        <div class="footer">
        </div>
    </div>
    @vite('resources/js/app.js')
    @vite('resources/js/shakeDecoration.js')
    @vite('resources/js/gsap.js')
</body>

</html>
