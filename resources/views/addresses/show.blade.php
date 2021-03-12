@extends('layouts.admin')

@section('title', 'Adresa '.$address->street.' '.$address->number)

@section('content')

    <h2>Detaily adresy <b>{{ $address->street.' '.$address->number }}</b></h2>
    <a href="{{ route('addresses.index') }}" class="btn btn-secondary btn-icon-split">
                    <span class="icon text-white-50">
                        <i class="fas fa-arrow-left"></i>
                    </span>
        <span class="text">Zpět</span>
    </a>

    <dl class="row mt-1 border">
        <dt class="col-sm-1">Ulice:</dt>
        <dd class="col-sm-11">{{ $address->street }}</dd>

        <dt class="col-sm-1">Číslo:</dt>
        <dd class="col-sm-11">{{ $address->number }}</dd>

        <dt class="col-sm-1">Obec/město:</dt>
        <dd class="col-sm-11">{{ $address->city }}</dd>

        @if($address->zip)
            <dt class="col-sm-1">PSČ:</dt>
            <dd class="col-sm-11">{{ $address->zip }}</dd>
        @endif

        @if($address->addressType)
            <dt class="col-sm-1">Typ adresy:</dt>
            <dd class="col-sm-11">{{ $address->addressType->name }}</dd>
        @endif
    </dl>

    <div class="row">
        <a class="btn btn-info btn-icon-split m-1"
           href=http://maps.google.com/maps?q={{str_replace(" ", "+", $address->street)}}+{{ $address->number }},+{{str_replace(" ", "+", $address->city) }} target="_blank">
                <span class="icon text-white-50">
                    <i class="fas fa-map-marked-alt"></i>
                </span>
            <span class="text">Mapa</span>
        </a>

        <a class="btn btn-warning btn-icon-split m-1"
           href="{{ route('addresses.edit',$address->id) }}">
            <span class="icon text-white-50">
                <i class="fas fa-edit"></i>
            </span>
            <span class="text">Upravit</span>
        </a>

        <button type="button" class="btn btn-danger btn-icon-split m-1" data-toggle="modal"
                data-target="#deleteModalForId{{$address->id}}">
                                            <span class="icon text-white-50">
                                                <i class="fas fa-trash"></i>
                                            </span>
            <span class="text">Smazat</span>
        </button>
        <form action="{{ route('addresses.destroy',$address->id) }}" method="POST">
            <div class="modal fade" id="deleteModalForId{{$address->id}}" tabindex="-1"
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
                            položku {{$address->street.' '.$address->number}}?
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
        @if($address->jobs->isEmpty() AND $address->people->isEmpty() AND $address->companies->isEmpty())
            <label class="col">Položka nemá žádné spojení.</label>
        @endif

        @unless($address->jobs->isEmpty())
            <div class="col border">
                <label>Zakázky:</label>
                <ul>
                    @foreach($address->jobs as $job)
                        <li>
                            <a href="{{route('jobs.show', $job->id)}}">{{$job->number.': '.$job->name.' - '.$job->status->name}}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endunless

        @unless($address->people->isEmpty())
            <div class="col border">
                <label>Osoby:</label>
                <ul>
                    @foreach($address->people as $person)
                        <li><a href="{{route('people.show', $person->id)}}">{{$person->name}}</a></li>
                    @endforeach
                </ul>
            </div>
        @endunless

        @unless($address->companies->isEmpty())
            <div class="col border">
                <label>Firmy:</label>
                <ul>
                    @foreach($address->companies as $company)
                        <li><a href="{{route('companies.show', $company->id)}}">{{$company->name}}</a></li>
                    @endforeach
                </ul>
            </div>
        @endunless
    </div>

@endsection
