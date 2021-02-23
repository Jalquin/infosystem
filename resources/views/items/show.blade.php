@extends('layouts.admin')

@section('title', 'Položka ' . $item->name)

@section('content')

    <h2>Detaily položky <b>{{ $item->name }}</b></h2>
    <a href="{{ route('items.index') }}" class="btn btn-secondary btn-icon-split">
                    <span class="icon text-white-50">
                        <i class="fas fa-arrow-left"></i>
                    </span>
        <span class="text">Zpět</span>
    </a>

    <div class="form-group">
        <label>Název:</label>
        {{ $item->name }}
    </div>
    @if($item->image)
        <label>Obrázek:</label>
        <img class="img-fluid" style="max-height: 500px" src="{{asset('storage/items_img/'. $item->image)}}"
             alt="Obrázek položky {{ $item->name }}">
    @endif
    @if($item->description)
        <div class="form-group">
            <label>Popis:</label>
            {{ $item->description }}
        </div>
    @endif
    <div class="form-group">
        <label>Množství:</label>
        {{ $item->amount }} Ks
    </div>
    @if($item->min_amount)
        <div class="form-group">
            <label>Minimální množství:</label>
            {{ $item->min_amount }} Ks
        </div>
    @endif
    @if($item->price)
        <div class="form-group">
            <label>Cena:</label>
            {{ $item->price }} Kč
        </div>
    @endif
    @if($item->position)
        <div class="form-group">
            <label>Umístění:</label>
            {{ $item->position->name }}
        </div>
    @endif
    @unless($item->categories->isEmpty())
    <div class="form-group">
        <label>Kategorie:</label>
        <ul>
            @foreach($item->categories as $category)
                <li>{{$category->name}}</li>
            @endforeach
        </ul>
    </div>
    @endunless

    <a class="btn btn-warning btn-icon-split"
       href="{{ route('items.edit',$item->id) }}">
        <span class="icon text-white-50">
            <i class="fas fa-edit"></i>
        </span>
        <span class="text">Upravit</span>
    </a>

    <button type="button" class="btn btn-danger btn-icon-split" data-toggle="modal"
            data-target="#deleteModalForId{{$item->id}}">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-trash"></i>
                                        </span>
        <span class="text">Smazat</span>
    </button>
    <form action="{{ route('items.destroy',$item->id) }}" method="POST">
        <div class="modal fade" id="deleteModalForId{{$item->id}}" tabindex="-1"
             role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"
                            id="exampleModalLabel">{{ __('Smazat?') }}</h5>
                        <button class="close" type="button" data-dismiss="modal"
                                aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">Opravdu chcete smazat
                        položku {{$item->name}}?
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-link" type="button"
                                data-dismiss="modal">{{ __('Zrušit') }}</button>
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" data-toggle="modal"
                                data-target="#deleteModal">Smazat
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>

@endsection
