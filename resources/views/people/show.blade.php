@extends('layouts.admin')

@section('title', 'Osoba ' . $person->name)

@section('content')

    <h2>Detaily osoby <b>{{ $person->name }}</b></h2>
    <a href="{{ route('people.index') }}" class="btn btn-secondary btn-icon-split">
                    <span class="icon text-white-50">
                        <i class="fas fa-arrow-left"></i>
                    </span>
        <span class="text">Zpět</span>
    </a>

    <dl class="row mt-1 border">
        <dt class="col-sm-1">Jméno:</dt>
        <dd class="col-sm-11">{{ $person->name }}</dd>

        @if($person->email)
            <dt class="col-sm-1">Email:</dt>
            <dd class="col-sm-11">{{ $person->email }}</dd>
        @endif
        @if($person->phone)
            <dt class="col-sm-1">Telefon:</dt>
            <dd class="col-sm-11">{{ $person->phone }}</dd>
        @endif
        @if($person->note)
            <dt class="col-sm-1">Poznámka:</dt>
            <dd class="col-sm-11">{{ $person->note }}</dd>
        @endif
        @unless($person->addresses->isEmpty())
            <dt class="col-sm-1">Adresy:</dt>
            <dd class="col-sm-11">
                <ul>
                    @foreach($person->addresses as $address)
                        <li>
                            <a href="{{route('addresses.show', $address->id)}}">{{$address->street.' '.$address->number.', '.$address->city}}@if($address->addressType){{' - '.$address->addressType->name}}@endif</a>
                        </li>
                    @endforeach
                </ul>
            </dd>
        @endunless
    </dl>

    <h3 class="mt-2">Propojení:</h3>
    <div class="row">
        @if($person->companies->isEmpty() AND $person->jobs->isEmpty())
            <label class="col">Položka nemá žádné spojení.</label>
        @endif

        @unless($person->companies->isEmpty())
            <div class="col border">
                <label>Firmy:</label>
                <ul>
                    @foreach($person->companies as $company)
                        <li>
                            <a href="{{route('companies.show', $company->id)}}">{{$company->name}}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endunless

        @unless($person->jobs->isEmpty())
            <div class="col border">
                <label>Zakázky:</label>
                <ul>
                    @foreach($person->jobs as $job)
                        <li>
                            <a href="{{route('jobs.show', $job->id)}}">{{$job->number.': '.$job->name}}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endunless

    </div>

    <div class="row">
        <a class="btn btn-warning btn-icon-split m-1"
           href="{{ route('people.edit',$person->id) }}">
            <span class="icon text-white-50">
                <i class="fas fa-edit"></i>
            </span>
            <span class="text">Upravit</span>
        </a>

        <button type="button" class="btn btn-danger btn-icon-split m-1" data-toggle="modal"
                data-target="#deleteModalForId{{$person->id}}">
                                            <span class="icon text-white-50">
                                                <i class="fas fa-trash"></i>
                                            </span>
            <span class="text">Smazat</span>
        </button>
        <form action="{{ route('people.destroy',$person->id) }}" method="POST">
            <div class="modal fade" id="deleteModalForId{{$person->id}}" tabindex="-1"
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
                            položku {{$person->name}}?
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
