@extends('layouts.admin')

@section('title', 'Zakázka '.$job->number)

@section('content')

    <h2>Detaily zakázky <b>{{ $job->number.': '.$job->name }}</b></h2>
    <a href="{{ route('jobs.index') }}" class="btn btn-secondary btn-icon-split">
        <span class="icon text-white-50">
            <i class="fas fa-arrow-left"></i>
        </span>
        <span class="text">Zpět</span>
    </a>

    <dl class="row mt-1 border">
        @if($job->tender_number)
            <dt class="col-sm-2">Nabídka:</dt>
            <dd class="col-sm-10">{{ $job->tender_number }}</dd>
        @endif
        <dt class="col-sm-2">Závazná objednávka:</dt>
        <dd class="col-sm-10">{{ $job->number }}</dd>
        @if($job->invoice_number)
            <dt class="col-sm-2">Faktura:</dt>
            <dd class="col-sm-10">{{ $job->invoice_number }}</dd>
        @endif
        <dt class="col-sm-2">Název:</dt>
        <dd class="col-sm-10">{{ $job->name }}</dd>
        <dt class="col-sm-2">Vytvoření zakázky:</dt>
        <dd class="col-sm-10">{{ $job->created_at }}</dd>
        @if($job->date)
            <dt class="col-sm-2">Datum:</dt>
            <dd class="col-sm-10">{{ $job->date }}</dd>
        @endif
        <dt class="col-sm-2">Poslední úprava:</dt>
        <dd class="col-sm-10">{{ $job->updated_at }}</dd>
        @if($job->description)
            <dt class="col-sm-2">Popis:</dt>
            <dd class="col-sm-10">
                <textarea rows="10" style="min-width: 100%" readonly>{{ $job->description }}</textarea>
            </dd>
        @endif
        <dt class="col-sm-2">Status:</dt>
        <dd class="col-sm-10">
            <b class="
                @switch($job->status_id)
            @case(1)
                text-info
@break

            @case(2)
                text-primary
@break

            @case(3)
                text-warning
@break

            @case(4)
                text-success
@break
            @case(5)
                text-danger
@break
            @case(6)
                text-danger
@break
            @case(7)
                text-dark
@break

            @default
                text-secondary
@endswitch
                ">{{ $job->status->name }}</b>
        </dd>
    </dl>

    <h3 class="mt-2">Propojení:</h3>
    <div class="row">
        @if($job->people->isEmpty() AND $job->addresses->isEmpty() AND $job->items->isEmpty())
            <label class="col">Položka nemá žádné spojení.</label>
        @endif

        @unless($job->people->isEmpty())
            <div class="col border">
                <label>Osoby:</label>
                <ul>
                    @foreach($job->people as $person)
                        <li>
                            <a href="{{route('people.show', $person->id)}}">{{$person->name}}@if($person->role){{' - '.$person->role->name}}@endif</a>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endunless

        @unless($job->addresses->isEmpty())
            <div class="col border">
                <label>Adresy:</label>
                <ul>
                    @foreach($job->addresses as $address)
                        <li>
                            <a href="{{route('addresses.show', $address->id)}}">{{$address->street.' '.$address->number.', '.$address->city}}@if($address->addressType){{' - '.$address->addressType->name}}@endif</a>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endunless

        @unless($job->items->isEmpty())
            <div class="col border">
                <label>Položky:</label>
                <ul>
                    @foreach($job->items as $item)
                        <li><a href="{{route('items.show', $item->id)}}">{{$item->name}}</a></li>
                    @endforeach
                </ul>
            </div>
        @endunless
    </div>

    <div class="row">
        <a class="btn btn-warning btn-icon-split m-1"
           href="{{ route('jobs.edit',$job->id) }}">
            <span class="icon text-white-50">
                <i class="fas fa-edit"></i>
            </span>
            <span class="text">Upravit</span>
        </a>

        <button type="button" class="btn btn-danger btn-icon-split m-1" data-toggle="modal"
                data-target="#deleteModalForId{{$job->id}}">
                                            <span class="icon text-white-50">
                                                <i class="fas fa-trash"></i>
                                            </span>
            <span class="text">Smazat</span>
        </button>
        <form action="{{ route('jobs.destroy',$job->id) }}" method="POST">
            <div class="modal fade" id="deleteModalForId{{$job->id}}" tabindex="-1"
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
                            položku {{$job->number}}?
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
