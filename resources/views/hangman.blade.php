@extends('layouts.app')

@section('title', 'XMAS | Hangman')

@section('navbar')
    <navbar navbar-title='Hangman Game'></navbar>
@endsection

@section('content')
    <hangman-page></hangman-page>
@endsection
