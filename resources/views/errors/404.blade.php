@extends('layouts.auth')

@section('title', 'Chyba 404')

@section('content')
    <div class="text-center bg-gradient-light p-5 m-5">
        <div class="error mx-auto" data-text="404">404</div>
        <p class="lead text-gray-800 mb-5">Stránka nenalezena</p>
        <p class="text-gray-500 mb-0">It looks like you found a glitch in the matrix...</p>
        <a href="{{ route('home') }}">&larr; Zpět</a>
    </div>
@endsection
