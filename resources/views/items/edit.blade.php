@extends('layouts.admin')

@section('title', 'Upravit položku ' . $item->name)

@section('css')
    <link href='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css'>
    <link rel="stylesheet" href="https://res.cloudinary.com/dxfq3iotg/raw/upload/v1569006288/BBBootstrap/choices.min.css?version=7.0.0">
@section('content')

@section('content')

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Upravit položku <b>{{ $item->name }}</b></h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('items.index') }}"> Back</a>
            </div>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Warning!</strong> Please check input field code<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('items.update',$item->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Název:</strong>
                    <input type="text" name="name" value="{{ $item->name }}" class="form-control" placeholder="Název">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Popis:</strong>
                    <textarea class="form-control" style="height:140px" name="description" placeholder="Popis">{{ $item->description }}</textarea>
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <strong>Obrázek:</strong>
                @if($item->image)
                <img class="img-fluid" style="max-height: 500px" src="{{asset('storage/items_img/'. $item->image)}}">
                @endif
                <input type="file" class="form-control" name="image" id="image">
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Množství:</strong>
                    <input type="number" name="amount" value="{{$item->amount}}" class="form-control" placeholder="Množsví">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Množství:</strong>
                    <input type="number" name="min_amount" value="{{$item->min_amount}}" class="form-control" placeholder="Minimální množsví">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Cena:</strong>
                    <input type="number" name="price" value="{{$item->price}}" class="form-control" placeholder="Cena">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Kategorie:</strong>
                    <select name="categories[]" id="category-select-multiple" placeholder="Zvolte až 5 kategorií" multiple>
                        @foreach($categories as $category)
                            <option value="{{$category->id}}" @if(in_array($category->id, $item->categories->pluck('id')->toArray())) selected @endif>{{$category->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Umístění:</strong>
                    <select name="position_id" id="position-select">
                        @if($item->position_id == null ) <option value="" selected disabled hidden>Zvolte umístění</option> @endif
                        @foreach($positions as $position)
                            <option value="{{$position->id}}" @if($item->position_id == $position->id ) selected @endif>{{$position->name}}</option>
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
    <script src='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
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
