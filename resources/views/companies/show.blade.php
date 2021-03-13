@extends('layouts.admin')

@section('title', 'Firma ' . $company->name)

@section('content')

    <h2>Detaily firmy <b>{{ $company->name }}</b></h2>
    <a href="{{ route('companies.index') }}" class="btn btn-secondary btn-icon-split">
                    <span class="icon text-white-50">
                        <i class="fas fa-arrow-left"></i>
                    </span>
        <span class="text">Zpět</span>
    </a>

    <dl class="row mt-1 border">
        <dt class="col-sm-1">Název:</dt>
        <dd class="col-sm-11">{{ $company->name }}</dd>

        @if($company->email)
            <dt class="col-sm-1">Email:</dt>
            <dd class="col-sm-11">{{ $company->email }}</dd>
        @endif
        @if($company->phone)
            <dt class="col-sm-1">Telefon:</dt>
            <dd class="col-sm-11">{{ $company->phone }}</dd>
        @endif
        @if($company->note)
            <dt class="col-sm-1">Poznámka:</dt>
            <dd class="col-sm-11">{{ $company->note }}</dd>
        @endif
        @unless($company->addresses->isEmpty())
            <dt class="col-sm-1">Adresy:</dt>
            <dd class="col-sm-11">
                @foreach($company->addresses as $address)
                    <div class="row">
                        <div class="col">
                        <a class="btn btn-info btn-icon-split"
                           href=http://maps.google.com/maps?q={{str_replace(" ", "+", $address->street)}}+{{ $address->number }},+{{str_replace(" ", "+", $address->city) }} target="_blank">
                                    <span class="icon text-white-50">
                                        <i class="fas fa-map-marked-alt"></i>
                                    </span>
                        </a>
                        <a href="{{route('addresses.show', $address->id)}}">{{$address->street.' '.$address->number.', '.$address->city}}@if($address->addressType){{' - '.$address->addressType->name}}@endif</a>
                        </div>
                    </div>
                @endforeach
            </dd>
        @endunless
    </dl>

    <h3 class="mt-2">Osoby:</h3>
    <div class="row">
        @unless($company->people->isEmpty())
            <div class="col border">
                <ul>
                    @foreach($company->people as $person)
                        <li>
                            <a href="{{route('people.show', $person->id)}}">{{$person->name}}@if($person->role){{' - '.$person->role->name}}@endif</a>
                            @unless($person->jobs->isEmpty())
                                <ul>
                                    @foreach($person->jobs as $job)
                                        <li>
                                            <a href="{{route('jobs.show', $job->id)}}">{{$job->number.': '.$job->name}}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            @endunless
                        </li>
                    @endforeach
                </ul>
            </div>
        @else
            <label class="col">Firma nemá žádné osoby.</label>
        @endunless
    </div>

    <div class="row">
        <a class="btn btn-warning btn-icon-split m-1"
           href="{{ route('companies.edit',$company->id) }}">
            <span class="icon text-white-50">
                <i class="fas fa-edit"></i>
            </span>
            <span class="text">Upravit</span>
        </a>

        <button type="button" class="btn btn-danger btn-icon-split m-1" data-toggle="modal"
                data-target="#deleteModalForId{{$company->id}}">
                                            <span class="icon text-white-50">
                                                <i class="fas fa-trash"></i>
                                            </span>
            <span class="text">Smazat</span>
        </button>
        <form action="{{ route('companies.destroy',$company->id) }}" method="POST">
            <div class="modal fade" id="deleteModalForId{{$company->id}}" tabindex="-1"
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
                            položku {{$company->number}}?
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

@endsection
