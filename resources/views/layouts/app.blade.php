<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Default Title')</title>
    @vite('resources/sass/app.scss')
    @yield('scss')
    <script src="https://kit.fontawesome.com/26d2910850.js" crossorigin="anonymous"></script>

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
    <meta property="og:title" content="XMAS 2024 | KdG">
    <meta property="og:description"
        content="Find the posters, complete the challenges and win fun prizes! Made by the MCT students of KdG for the holidays.">
    <meta property="og:image" content="https://i.imgur.com/yD0hMm4.png">
    <meta property="og:image:alt" content="Christmas wallpaper with pattern related to christmas">
</head>

<body>
    {{-- <app-container id="app" :iscentered='true'>
        @yield('content')
    </app-container> --}}
    <div id="app">
        <snow-flakes></snow-flakes>
        <navbar></navbar>
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
</body>

</html>
