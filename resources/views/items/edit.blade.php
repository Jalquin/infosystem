@extends('layouts.admin')

@section('title', 'Upravit položku ' . $item->name)

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
                <img src="{{asset('storage/items_img/'. $item->image)}}">
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
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>

        </div>

    </form>

@endsection
