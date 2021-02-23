@extends('layouts.admin')

@section('title', 'Kategorie ' . $role->name)

@section('content')

    <h2>Detaily role <b>{{ $role->name }}</b></h2>
    <a href="{{ route('roles.index') }}" class="btn btn-secondary btn-icon-split">
                    <span class="icon text-white-50">
                        <i class="fas fa-arrow-left"></i>
                    </span>
        <span class="text">Zpět</span>
    </a>
    <div class="form-group">
        <label>Název:</label>
        {{ $role->name }}
    </div>

@endsection
