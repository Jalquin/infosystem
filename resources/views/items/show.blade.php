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
            <img class="img-fluid" style="max-height: 500px" src="{{asset('storage/items_img/'. $item->image)}}">
        </div>
        @endif
        @if($item->description)
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Popis:</strong>
                {{ $item->description }}
            </div>
        </div>
        @endif
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Množství:</strong>
                {{ $item->amount }} Ks
            </div>
        </div>
        @if($item->min_amount)
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Minimální množství:</strong>
                {{ $item->min_amount }} Ks
            </div>
        </div>
        @endif
        @if($item->price)
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Cena:</strong>
                {{ $item->price }} Kč
            </div>
        </div>
        @endif

        @if($category)
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Kategorie:</strong>
                <ul>
                @foreach($category['category'] as $category)
                   <li>{{$category->name}}</li>
                @endforeach
                </ul>
            </div>
        </div>
        @endif

    </div>

@endsection
