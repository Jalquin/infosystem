@extends('layouts.admin')

@section('title', 'Nový typ adresy')

@section('content')

    <h2>Přidat typ adresy:</h2>
    <a href="{{ route('address_types.index') }}" class="btn btn-secondary btn-icon-split">
                    <span class="icon text-white-50">
                        <i class="fas fa-arrow-left"></i>
                    </span>
        <span class="text">Zpět</span>
    </a>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Varování!</strong> Prosím zkontrolujte váš vstup<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('address_types.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Název:</label>
            <input id="name" type="text" name="name" class="form-control" placeholder="Název">
        </div>
        <button type="submit" class="btn btn-primary btn-icon-split">
            <span class="icon text-white-50">
                <i class="fas fa-save"></i>
            </span>
            <span class="text">Uložit</span>
        </button>
    </form>

@endsection
