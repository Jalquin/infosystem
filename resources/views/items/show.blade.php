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
    <dl class="row mt-1 border">
        <dt class="col-sm-3">Název:</dt>
        <dd class="col-sm-9">{{ $item->name }}</dd>

        <dt class="col-sm-3">Množství:</dt>
        <dd class="col-sm-9">{{ $item->amount }} Ks @if($item->min_amount) / {{ $item->min_amount }} Ks @endif</dd>
        @if($item->image)
            <dt class="col-sm-3">Obrázek:</dt>
            <dd class="col-sm-9"><img class="img-fluid" style="max-height: 500px"
                                      src="{{asset('storage/items_img/'. $item->image)}}"
                                      alt="Obrázek položky {{ $item->name }}"></dd>
        @endif
        @if($item->description)
            <dt class="col-sm-3">Popis:</dt>
            <dd class="col-sm-9">{{ $item->description }}</dd>
        @endif
        @if($item->price)
            <dt class="col-sm-3">Cena:</dt>
            <dd class="col-sm-9">{{ $item->price }} Kč</dd>
        @endif
        @if($item->position_id)
            <dt class="col-sm-3">Umístění:</dt>
            <dd class="col-sm-9">{{ $item->position->name }}</dd>
        @endif
        @unless($item->categories->isEmpty())
            <dt class="col-sm-3">Kategorie:</dt>
            <dd class="col-sm-9">
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
