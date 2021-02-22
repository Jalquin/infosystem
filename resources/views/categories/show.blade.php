@extends('layouts.admin')

@section('title', 'Detaily kategorie ' . $category->name)

@section('content')

    <h2>Detaily kategorie <b>{{ $category->name }}</b></h2>
    <a href="{{ route('categories.index') }}" class="btn btn-secondary btn-icon-split">
                    <span class="icon text-white-50">
                        <i class="fas fa-arrow-left"></i>
                    </span>
        <span class="text">Zpět</span>
    </a>
    <div class="form-group">
        <label>Název:</label>
        {{ $category->name }}
    </div>

@endsection
