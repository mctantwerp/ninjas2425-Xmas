@extends('layouts.app')

@section('scss')
    @vite('resources/sass/welcomePage.scss')
@endsection

@section('title', 'XMAS')

@section('content')
    <div class="window-intro">
        <h1>Ho ho ho! Merry Christmas!</h1>
        <p>Welcome to ...</p>
    </div>
@endsection
