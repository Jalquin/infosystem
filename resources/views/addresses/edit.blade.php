@extends('layouts.admin')

@section('title', 'Upravit adresu '.$address->street.' '.$address->number)

@section('css')
    <link rel="stylesheet"
          href="https://res.cloudinary.com/dxfq3iotg/raw/upload/v1569006288/BBBootstrap/choices.min.css?version=7.0.0">
@endsection

@section('content')

    <h2>Upravit adresu <b>{{ $address->street.' '.$address->number }}</b></h2>
    <a href="{{ route('addresses.index') }}" class="btn btn-secondary btn-icon-split">
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

    <form action="{{ route('addresses.update',$address->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="streeet">Ulice:</label>
            <input id="streeet" type="text" name="street" value="{{ $address->street }}" class="form-control"
                   placeholder="Ulice" required>
        </div>
        <div class="form-group">
            <label for="number">Číslo:</label>
            <input id="number" type="text" name="number" value="{{ $address->number }}" class="form-control"
                   placeholder="Číslo" required>
        </div>
        <div class="form-group">
            <label for="city">Obec/Město:</label>
            <input id="city" type="text" name="city" value="{{ $address->city }}" class="form-control"
                   placeholder="Obec/Město" required>
        </div>
        <div class="form-group">
            <label for="zip">PSČ:</label>
            <input id="zip" type="text" name="zip" value="{{ $address->zip }}" class="form-control" placeholder="PSČ">
        </div>

        <div class="form-group">
            <label for="address-type-select">Typ adresy:</label>
            <select name="address_type_id" id="address-type-select">
                <option value="" @if($address->address_type_id == null) selected @endif disabled hidden>Zvolte typ
                    adresy
                </option>
                @foreach($addressTypes as $addressType)
                    <option value="{{$addressType->id}}"
                            @if($address->address_type_id == $addressType->id ) selected @endif>{{$addressType->name}}</option>
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
            const addressTypeSelect = new Choices('#address-type-select', {
                removeItemButton: true,
                maxItemCount: 1,
                searchResultLimit: 5,
                renderChoiceLimit: 5
            });
        });
    </script>
@endpush
