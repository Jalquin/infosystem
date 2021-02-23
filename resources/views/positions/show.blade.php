@extends('layouts.admin')

@section('title', 'Pozice ' . $position->name)

@section('content')

    <h2>Detaily pozice <b>{{ $position->name }}</b></h2>
    <a href="{{ route('positions.index') }}" class="btn btn-secondary btn-icon-split">
                    <span class="icon text-white-50">
                        <i class="fas fa-arrow-left"></i>
                    </span>
        <span class="text">Zpět</span>
    </a>
    <div class="form-group">
        <label>Název:</label>
        {{ $position->name }}
    </div>

@endsection
