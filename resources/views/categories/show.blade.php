@extends('layouts.admin')

@section('title', 'Detaily kategorie ' . $category->name)

@section('content')

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Detaily kategorie <b>{{ $category->name }}</b></h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('categories.index') }}"> Zpět</a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Název:</strong>
                {{ $category->name }}
            </div>
        </div>
    </div>

@endsection
