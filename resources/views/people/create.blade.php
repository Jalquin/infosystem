@extends('layouts.admin')

@section('title', 'Nová osoba')

@section('css')
    <link rel="stylesheet"
          href="https://res.cloudinary.com/dxfq3iotg/raw/upload/v1569006288/BBBootstrap/choices.min.css?version=7.0.0">
@endsection

@section('content')

    <h2>Přidat osobu:</h2>
    <a href="{{ route('people.index') }}" class="btn btn-secondary btn-icon-split">
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

    <form action="{{ route('people.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Jméno:</label>
            <input id="name" type="text" name="name" class="form-control" placeholder="Jméno" required>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input id="email" type="email" name="email" class="form-control" placeholder="Email">
        </div>
        <div class="form-group">
            <label for="phone">Telefon:</label>
            <input id="phone" type="tel" name="phone" class="form-control" placeholder="Telefon">
        </div>
        <div class="form-group">
            <label for="note">Poznámka:</label>
            <textarea id="note" rows="3" name="note" class="form-control" placeholder="Popis"></textarea>
        </div>

        <div class="form-group">
            <label for="role-select">Role:</label>
            <select name="role_id" id="role-select">
                <option value="" selected disabled hidden>Zvolte roli</option>
                @foreach($roles as $role)
                    <option value="{{$role->id}}">{{$role->name}}</option>
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

        <div class="form-group">
            <label for="company-select-multiple">Firmy:</label>
            <select name="companies[]" id="company-select-multiple" placeholder="Zvolte firmy" multiple>
                @foreach($companies as $company)
                    <option value="{{$company->id}}">{{$company->name}}</option>
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
            }), companySelectMultiple = new Choices('#company-select-multiple', {
                removeItemButton: true,
                maxItemCount: 5,
                searchResultLimit: 5,
                renderChoiceLimit: 5
            }), roleSelect = new Choices('#role-select', {
                removeItemButton: true,
                maxItemCount: 1,
                searchResultLimit: 5,
                renderChoiceLimit: 5
            });
        });
    </script>
@endpush
