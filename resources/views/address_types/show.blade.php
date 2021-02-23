@extends('layouts.admin')

@section('title', 'Typ adresy ' . $addressType->name)

@section('content')

    <h2>Detaily typu adresy <b>{{ $addressType->name }}</b></h2>
    <a href="{{ route('address_types.index') }}" class="btn btn-secondary btn-icon-split">
                    <span class="icon text-white-50">
                        <i class="fas fa-arrow-left"></i>
                    </span>
        <span class="text">Zpět</span>
    </a>
    <div class="form-group">
        <label>Název:</label>
        {{ $addressType->name }}
    </div>

@endsection
