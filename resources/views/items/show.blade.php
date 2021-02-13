@extends('layouts.admin')

@section('title', 'Detaily položky ' . $item->name)

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Detaily položky <b>{{ $item->name }}</b></h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('items.index') }}"> Back</a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Název:</strong>
                {{ $item->name }}
            </div>
        </div>
        @if($item->image)
        <div class="col-xs-12 col-sm-12 col-md-12">
            <strong>Obrázek:</strong>
            <img src="{{asset('storage/items_img/'. $item->image)}}">
        </div>
        @endif
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Popis:</strong>
                {{ $item->description }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Množství:</strong>
                {{ $item->amount }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Minimální množství:</strong>
                {{ $item->min_amount }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Cena:</strong>
                {{ $item->price }}
            </div>
        </div>
    </div>
@endsection
