@extends('layouts.admin')

@section('title', 'Upravit kategorii ' . $category->name)

@section('content')

    <h2>Upravit kategorii <b>{{ $category->name }}</b></h2>
    <a href="{{ route('categories.index') }}" class="btn btn-secondary btn-icon-split">
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

    <form action="{{ route('categories.update',$category->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Název:</label>
            <input id="name" type="text" name="name" value="{{ $category->name }}" class="form-control"
                   placeholder="Název" required>
        </div>
        <button type="submit" class="btn btn-primary btn-icon-split">
            <span class="icon text-white-50">
                <i class="fas fa-save"></i>
            </span>
            <span class="text">Uložit</span>
        </button>
    </form>

@endsection
