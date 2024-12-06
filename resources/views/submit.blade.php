@extends('layouts.app')

@section('title', 'XMAS | Submit')

@section('scss')
    @vite('resources/sass/plyrCustom.scss')
@endsection

@section('navbar')
    <navbar navbar-title='Submit'></navbar>
@endsection

@section('content')
    <submit-page></submit-page>
@endsection
