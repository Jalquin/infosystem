@extends('layouts.admin')

@section('title', 'Upravit zakázku ' . $job->number)

@section('css')
    <link rel="stylesheet"
          href="https://res.cloudinary.com/dxfq3iotg/raw/upload/v1569006288/BBBootstrap/choices.min.css?version=7.0.0">
@endsection

@section('content')

    <h2>Upravit zakázku <b>{{ $job->number.': '.$job->name }}</b></h2>
    <a href="{{ route('jobs.index') }}" class="btn btn-secondary btn-icon-split">
                    <span class="icon text-white-50">
                        <i class="fas fa-arrow-left"></i>
                    </span>
        <span class="text">Zpět</span>
    </a>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Varování!</strong> Prosím zkontrolujte váš vstup<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('jobs.update',$job->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="number">Číslo zakázky:</label>
            <input id="number" type="text" name="number" value="{{ $job->number }}" class="form-control"
                   placeholder="Číslo zakázky" required>
        </div>
        <div class="form-group">
            <label for="name">Název:</label>
            <input id="name" type="text" name="name" value="{{ $job->name }}" class="form-control"
                   placeholder="Název" required>
        </div>
        <div class="form-group">
            <label for="date">Datum:</label>
            <input id="date" type="date" name="date" value="{{ $job->date }}" class="form-control" placeholder="Datum">
        </div>
        <div class="form-group">
            <label for="description">Popis:</label>
            <textarea id="description" rows="10" class="form-control" name="description"
                      placeholder="Popis">{{ $job->description }}</textarea>
        </div>
        <div class="form-group">
            <label for="invoice_number">Číslo faktury:</label>
            <input id="invoice_number" type="number" name="invoice_number" value="{{ $job->invoice_number }}"
                   class="form-control" placeholder="Číslo faktury">
        </div>

        <div class="form-group">
            <label for="status-select">Status:</label>
            <select name="status_id" id="status-select" required>
                <option value="" @unless($job->status_id == null) selected @endunless disabled hidden>Zvolte
                    status
                </option>
                @foreach($statuses as $status)
                    <option value="{{$status->id}}"
                            @if($job->status_id == $status->id ) selected @endif>{{$status->name}}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="address-select-multiple">Adresy:</label>
            <select name="addresses[]" id="address-select-multiple" placeholder="Zvolte adresy" multiple>
                @foreach($addresses as $address)
                    <option value="{{$address->id}}"
                            @if(in_array($address->id, $job->addresses->pluck('id')->toArray())) selected @endif>{{$address->street.' '.$address->number}}@if($address->addressType){{' - '.$address->addressType->name}}@endif</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="person-select-multiple">Osoby:</label>
            <select name="people[]" id="person-select-multiple" placeholder="Zvolte osoby" multiple>
                @foreach($people as $person)
                    <option value="{{$person->id}}"
                            @if(in_array($person->id, $job->people->pluck('id')->toArray())) selected @endif>{{$person->name}}@if($person->role){{' - '.$person->role->name}}@endif</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="item-select-multiple">Položky:</label>
            <select name="items[]" id="item-select-multiple" placeholder="Zvolte položky skladu" multiple>
                @foreach($items as $item)
                    <option value="{{$item->id}}"
                            @if(in_array($item->id, $job->items->pluck('id')->toArray())) selected @endif>{{$item->name}}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary btn-icon-split">
            <span class="icon text-white-50">
                <i class="fas fa-save"></i>
            </span>
            <span class="text">Uložit</span>
        </button>
    </form>

@endsection

@push('scripts')
    <script
        src="https://res.cloudinary.com/dxfq3iotg/raw/upload/v1569006273/BBBootstrap/choices.min.js?version=7.0.0"></script>
    <script>
        $(document).ready(function () {
            const addressSelectMultiple = new Choices('#address-select-multiple', {
                removeItemButton: true,
                maxItemCount: 5,
                searchResultLimit: 5,
                renderChoiceLimit: 5
            }), personSelectMultiple = new Choices('#person-select-multiple', {
                removeItemButton: true,
                maxItemCount: 5,
                searchResultLimit: 5,
                renderChoiceLimit: 5
            }), itemSelectMultiple = new Choices('#item-select-multiple', {
                removeItemButton: true,
                maxItemCount: 5,
                searchResultLimit: 5,
                renderChoiceLimit: 5
            }), statusSelect = new Choices('#status-select', {
                removeItemButton: true,
                maxItemCount: 1,
                searchResultLimit: 5,
                renderChoiceLimit: 5
            });
        });
    </script>
@endpush
