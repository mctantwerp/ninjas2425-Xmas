@extends('layouts.app')

@section('scss')
    @vite('resources/sass/welcomePage.scss')
@endsection

@section('title', 'XMAS')

@section('content')
    <div class="window-intro">
        <h1>Welcome to the 2024 KDG Christmas Challenge! 🎄</h1>
        <p>This holiday season, embark on a scavenger hunt across the KDG campuses!</p>
        </br>
        <p>Find posters with QR codes and secret
            numbers, solve the challenges, and collect the words.</p>
        </br>
        <p>Got them all? <a href="/submit" class="clear-link">Submit</a> your answers for a chance to win
            amazing prizes! Good luck and have fun with the challenge! 🎅✨</p>
    </div>
    <square-game-overview></square-game-overview>
@endsection
