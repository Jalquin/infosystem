@extends('layouts.admin')

@section('title', 'Nová zakázka')

@section('css')
    <link rel="stylesheet"
          href="https://res.cloudinary.com/dxfq3iotg/raw/upload/v1569006288/BBBootstrap/choices.min.css?version=7.0.0">
@endsection

@section('content')

    <h2>Přidat zakázku:</h2>
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

    <form action="{{ route('jobs.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="number">Číslo závazné objednávky:</label>
            <input id="number" type="text" name="number" class="form-control" placeholder="Číslo objednávky" required>
        </div>
        <div class="form-group">
            <label for="name">Název:</label>
            <input id="name" type="text" name="name" class="form-control" placeholder="Název" required>
        </div>
        <div class="form-group">
            <label for="date">Datum:</label>
            <input id="date" type="date" name="date" class="form-control" placeholder="Datum">
        </div>
        <div class="form-group">
            <label for="description">Popis:</label>
            <textarea id="description" rows="10" class="form-control" name="description" placeholder="Popis"></textarea>
        </div>
        <div class="form-group">
            <label for="tender_number">Číslo nabídky:</label>
            <input id="tender_number" type="text" name="tender_number" class="form-control"
                   placeholder="Číslo nabídky">
        </div>
        <div class="form-group">
            <label for="invoice_number">Číslo faktury:</label>
            <input id="invoice_number" type="number" name="invoice_number" class="form-control"
                   placeholder="Číslo faktury">
        </div>

        <div class="form-group">
            <label for="status-select">Status:</label>
            <select name="status_id" id="status-select"required>
                @foreach($statuses as $status)
                    <option value="{{$status->id}}">{{$status->id.' : '.$status->name}}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="address-select-multiple">Adresy:</label>
            <select name="addresses[]" id="address-select-multiple" placeholder="Zvolte adresy" multiple>
                @foreach($addresses as $address)
                    <option
                        value="{{$address->id}}">{{$address->street.' '.$address->number}}@if($address->addressType){{' - '.$address->addressType->name}}@endif</option>
                @endforeach
            </select>
        </div>

        <div class="form-check mb-4">
            <input id="new_address" type="checkbox" name="new_address" class="form-check-input" data-toggle="collapse"
                   data-target="#new_address_collapse">
            <label class="form-check-label" for="new_address">Nová adresa</label>
        </div>

        <div class="collapse border" id="new_address_collapse">
            <div class="form-group">
                <label for="name">Ulice:</label>
                <input id="name" type="text" name="street" class="form-control" placeholder="Ulice">
            </div>
            <div class="form-group">
                <label for="address_number">Číslo:</label>
                <input id="address_number" type="text" name="address_number" class="form-control" placeholder="Číslo">
            </div>
            <div class="form-group">
                <label for="city">Obec/Město:</label>
                <input id="city" type="text" name="city" class="form-control" placeholder="Obec/Město">
            </div>
            <div class="form-group">
                <label for="zip">PSČ:</label>
                <input id="zip" type="text" name="zip" class="form-control" placeholder="PSČ">
            </div>

            <div class="form-group">
                <label for="address-type-select">Typ adresy:</label>
                <select name="address_type_id" id="address-type-select">
                    <option value="" selected disabled hidden>Zvolte typ adresy</option>
                    @foreach($addressTypes as $addressType)
                        <option value="{{$addressType->id}}">{{$addressType->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group">
            <label for="person-select-multiple">Osoby:</label>
            <select name="people[]" id="person-select-multiple" placeholder="Zvolte osoby" multiple>
                @foreach($people as $person)
                    <option
                        value="{{$person->id}}">{{$person->name}}@if($person->role){{' - '.$person->role->name}}@endif</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="item-select-multiple">Položky:</label>
            <select name="items[]" id="item-select-multiple" placeholder="Zvolte položky skladu" multiple>
                @foreach($items as $item)
                    <option value="{{$item->id}}">{{$item->name}}</option>
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
            }), addressTypeSelect = new Choices('#address-type-select', {
                removeItemButton: true,
                maxItemCount: 1,
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
                searchResultLimit: 8,
                renderChoiceLimit: 8
            });
        });
    </script>
@endpush
