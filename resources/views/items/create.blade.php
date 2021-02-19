@extends('layouts.admin')

@section('title', 'Přidání nové položky skladu')

@section('css')
    <link rel="stylesheet" href="https://res.cloudinary.com/dxfq3iotg/raw/upload/v1569006288/BBBootstrap/choices.min.css?version=7.0.0">
@section('content')

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Přidat položku skladu:</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('items.index') }}"> Zpět</a>
            </div>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Varování!</strong> Prosím zkontrolujte vstup<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('items.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Název:</strong>
                    <input type="text" name="name" class="form-control" placeholder="Název">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Popis:</strong>
                    <textarea class="form-control" style="height:140px" name="description" placeholder="Popis"></textarea>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Obrázek:</strong>
                    <input type="file" class="form-control" name="image" id="image">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Množství:</strong>
                    <input type="number" name="amount" class="form-control" placeholder="Množsví">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Minimální množství:</strong>
                    <input type="number" name="min_amount" class="form-control" placeholder="Minimální množsví">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Cena:</strong>
                    <input type="number" name="price" class="form-control" placeholder="Cena">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Kategorie:</strong>
                    <select name="categories[]" id="category-select-multiple" placeholder="Zvolte až 5 kategorií" multiple>
                        @foreach($categories as $category)
                           <option value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Umístění:</strong>
                    <select name="position_id" id="position-select">
                        <option value="" selected disabled hidden>Zvolte umístění</option>
                        @foreach($positions as $position)
                            <option value="{{$position->id}}">{{$position->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>

    </form>

@endsection

@push('scripts')
<script src="https://res.cloudinary.com/dxfq3iotg/raw/upload/v1569006273/BBBootstrap/choices.min.js?version=7.0.0"></script>
<script>
    $(document).ready(function(){
        var categorySelectMultiple = new Choices('#category-select-multiple', {
            removeItemButton: true,
            maxItemCount:5,
            searchResultLimit:5,
            renderChoiceLimit:5
        });
        var positionSelect = new Choices('#position-select', {
            removeItemButton: true,
            maxItemCount:1,
            searchResultLimit:5,
            renderChoiceLimit:5
        });
    });
</script>
@endpush
