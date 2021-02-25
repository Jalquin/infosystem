@extends('layouts.admin')

@section('title', 'Nový uživatel')

@section('content')

    <h2>Přidat uživatele:</h2>
    <a href="{{ route('users.index') }}" class="btn btn-secondary btn-icon-split">
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

    <form action="{{ route('users.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Jméno:</label>
            <input id="name" type="text" name="name" class="form-control" placeholder="Jméno" required>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input id="email" type="email" name="email" class="form-control" placeholder="Email" required>
        </div>
        <div class="form-group">
            <label for="password">Heslo:</label>
            <input id="password" type="password" name="password" class="form-control" placeholder="Heslo" required>
        </div>
        <div class="form-check">
            <input type="checkbox" class="form-check-input" name="admin" id="admin">
            <label class="form-check-label" for="admin">Admin</label>
        </div>

        <button type="submit" class="btn btn-primary btn-icon-split">
            <span class="icon text-white-50">
                <i class="fas fa-save"></i>
            </span>
            <span class="text">Uložit</span>
        </button>
    </form>

@endsection
