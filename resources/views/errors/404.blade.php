<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>XMAS | 404</title>
    @vite('resources/sass/404.scss')
    <script src="https://kit.fontawesome.com/26d2910850.js" crossorigin="anonymous"></script>
</head>

<body>
    <div class="error-page-wrapper">
        <snow-flakes></snow-flakes>
        <div class="error-page-box">
            <h1>🎅 Ho Ho Ho! 🎄</h1>
            <div class="text-and-action">
                <p>The page you're trying to access doesn't exist or has been moved (404 error).<br>Try going back to
                    our
                    homepage.</p>
                <a href="/"><button>Go Home <i class="fa-regular fa-house-blank"></i></button></a>
            </div>
        </div>
    </div>
    @vite('resources/js/404.js')
</body>

</html>
