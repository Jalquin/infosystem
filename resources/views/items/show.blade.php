@extends('layouts.admin')

@section('title', 'Položka ' . $item->name)

@section('content')

    @if (session('success'))
        <div class="alert alert-success border-left-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <h2>Detaily položky <b>{{ $item->name }}</b></h2>
    <a href="{{ route('items.index') }}" class="btn btn-secondary btn-icon-split">
                    <span class="icon text-white-50">
                        <i class="fas fa-arrow-left"></i>
                    </span>
        <span class="text">Zpět</span>
    </a>
    <dl class="row mt-1 border">
        <dt class="col-sm-1">Název:</dt>
        <dd class="col-sm-11">{{ $item->name }}</dd>

        <dt class="col-sm-1">Množství:</dt>
        <dd class="col-sm-11">{{ $item->amount }} @if($item->min_amount) {{ ' / '.$item->min_amount }}@endif Ks
            <br>
            <div class="btn-group" role="group" aria-label="Basic example">
                <a
                    class="btn btn-outline-secondary"
                    href="{{route('items.amount.add', $item->id)}}">+</a>
                <a
                    class="btn btn-outline-secondary"
                    href="{{route('items.amount.subtract', $item->id )}}">-</a>
            </div>
        </dd>
    @if($item->image)
            <dt class="col-sm-1">Obrázek:</dt>
            <dd class="col-sm-11"><img class="img-fluid" style="max-height: 500px"
                                      src="{{asset('storage/items_img/'. $item->image)}}"
                                      alt="Obrázek položky {{ $item->name }}"></dd>
        @endif
        @if($item->description)
            <dt class="col-sm-1">Popis:</dt>
            <dd class="col-sm-11">{{ $item->description }}</dd>
        @endif
        @if($item->price)
            <dt class="col-sm-1">Cena:</dt>
            <dd class="col-sm-11">{{ $item->price }} Kč</dd>
        @endif
        @if($item->position_id)
            <dt class="col-sm-1">Umístění:</dt>
            <dd class="col-sm-11">{{ $item->position->name }}</dd>
        @endif
        @unless($item->categories->isEmpty())
            <dt class="col-sm-1">Kategorie:</dt>
            <dd class="col-sm-11">
                <ul>
                    @foreach($item->categories as $category)
                        <li>{{$category->name}}</li>
                    @endforeach
                </ul>
            </dd>
        @endunless
    </dl>

    <div class="row">
        <a class="btn btn-warning btn-icon-split m-1"
           href="{{ route('items.edit',$item->id) }}">
            <span class="icon text-white-50">
                <i class="fas fa-edit"></i>
            </span>
            <span class="text">Upravit</span>
        </a>

        <button type="button" class="btn btn-danger btn-icon-split m-1" data-toggle="modal"
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
    </div>

    <h3 class="mt-2">Propojení:</h3>
    <div class="row">
        @unless($item->jobs->isEmpty())
            <div class="col border">
                <label>Zakázky:</label>
                <ul>
                    @foreach($item->jobs as $job)
                        <li><a href="{{route('jobs.show', $job->id)}}">{{$job->number.': '.$job->name}}</a></li>
                    @endforeach
                </ul>
            </div>
        @else
            <label class="col">Položka nemá žádné spojení.</label>
        @endunless
    </div>

@endsection
