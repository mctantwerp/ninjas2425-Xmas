@extends('layouts.app')

{{-- @section('scss')
    @vite('resources/sass/welcomePage.scss')
@endsection --}}

@section('title', 'XMAS | Home')

@section('navbar')
    <navbar></navbar>
@endsection

@section('content')
    <div class="window-intro">
        <h1>Welcome to the 2024 MCT Christmas Challenge! 🎄</h1>
        <p>
            This holiday season, embark on a scavenger hunt across your favorite KdG Campus: Find posters with QR codes
            and a secret code to access the games, solve the challenges and collect the words.
        </p>
        <br>
        <p>
            Need extra information? Go to the <a href="/howtoplay" class="clear-link">"How To Play"</a> page for more
            information.
        </p>
        <br>
        <p>
            Got them all? <a href="/submit" class="clear-link">Submit</a> your answers for a chance to win amazing prizes!
        </p>
        <br>
        <p>Good luck and have fun with the challenge! 🎅✨</p>
        <p>Made with ❤️ by MCT.</p>
    </div>

    <square-game-overview></square-game-overview>
@endsection
