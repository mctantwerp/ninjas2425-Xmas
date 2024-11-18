<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Default Title')</title>
    @vite('resources/sass/app.scss')
    <script src="https://kit.fontawesome.com/3e03a70aff.js" crossorigin="anonymous"></script>
</head>

<body>
    {{-- <app-container id="app" :iscentered='true'>
        @yield('content')
    </app-container> --}}
    <div id="app">
        <navbar></navbar>
        <div class="snow"></div>
        <div class="gingerman">
        </div>
        <div class="candy">
        </div>
        @yield('content')
        <div class="footer">
        </div>
    </div>
    @vite('resources/js/app.js')
</body>

</html>
