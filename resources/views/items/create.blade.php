@extends('layouts.admin')

@section('title', 'Nová položka skladu')

@section('css')
    <link rel="stylesheet"
          href="https://res.cloudinary.com/dxfq3iotg/raw/upload/v1569006288/BBBootstrap/choices.min.css?version=7.0.0">
@endsection

@section('content')

    <h2>Přidat položku skladu:</h2>
    <a href="{{ route('items.index') }}" class="btn btn-secondary btn-icon-split">
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

    <form action="{{ route('items.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="name">Název:</label>
            <input id="name" type="text" name="name" class="form-control" placeholder="Název" required>
        </div>
        <div class="form-group">
            <label for="description">Popis:</label>
            <textarea id="description" rows="3" class="form-control" name="description" placeholder="Popis"></textarea>
        </div>
        <div class="form-group">
            <div class="custom-file" id="customFile" lang="cs">
                <input type="file" class="custom-file-input" name="image" id="exampleInputFile"
                       aria-describedby="fileHelp">
                <label class="custom-file-label" for="exampleInputFile">
                    Zvolte obrázek...
                </label>
            </div>
        </div>
        <div class="form-group">
            <label for="amount">Množství:</label>
            <input id="amount" type="number" name="amount" class="form-control" placeholder="Množsví" required>
        </div>
        <div class="form-group">
            <label for="min_amount">Minimální množství:</label>
            <input id="min_amount" type="number" name="min_amount" class="form-control" placeholder="Minimální množsví">
        </div>

        <div class="form-group">
            <label for="price">Cena:</label>
            <input id="price" type="number" name="price" class="form-control" placeholder="Cena">
        </div>

        <div class="form-group">
            <label for="category-select-multiple">Kategorie:</label>
            <select name="categories[]" id="category-select-multiple" placeholder="Zvolte kategorie" multiple>
                @foreach($categories as $category)
                    <option value="{{$category->id}}">{{$category->name}}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="position-select">Umístění:</label>
            <select name="position_id" id="position-select">
                <option value="" selected disabled hidden>Zvolte umístění</option>
                @foreach($positions as $position)
                    <option value="{{$position->id}}">{{$position->name}}</option>
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
    <script>
        $('#exampleInputFile').on('change', function () {
            const fileName = $(this).val();
            fieldVal = fileName.replace("C:\\fakepath\\", "");
            $(this).next('.custom-file-label').html(fieldVal);
        })
    </script>
    <script
        src="https://res.cloudinary.com/dxfq3iotg/raw/upload/v1569006273/BBBootstrap/choices.min.js?version=7.0.0"></script>
    <script>
        $(document).ready(function () {
            const categorySelectMultiple = new Choices('#category-select-multiple', {
                removeItemButton: true,
                maxItemCount: 5,
                searchResultLimit: 5,
                renderChoiceLimit: 5
            }), positionSelect = new Choices('#position-select', {
                removeItemButton: true,
                maxItemCount: 1,
                searchResultLimit: 5,
                renderChoiceLimit: 5
            });
        });
    </script>
@endpush
