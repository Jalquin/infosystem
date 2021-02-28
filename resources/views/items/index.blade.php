@extends('layouts.admin')

@section('title', 'Sklad')

@section('css')
    <link href="{{asset('vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
    <link rel="stylesheet"
          href="https://res.cloudinary.com/dxfq3iotg/raw/upload/v1569006288/BBBootstrap/choices.min.css?version=7.0.0">
@endsection

@section('content')

    @if (session('success'))
        <div class="alert alert-success border-left-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <h1 class="h3 mb-2 text-gray-800">Sklad</h1>
    <a class="btn btn-success btn-icon-split mb-1" href="{{ route('items.create') }}">
        <span class="icon text-white-50">
            <i class="far fa-file"></i>
        </span>
        <span class="text">Přidat položku</span>
    </a>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold">Položky skladu podle kategorie</h6>
            <form action="{{ route('items.index') }}" method="GET">
                @csrf
                <div class="form-group">
                    <label for="category-select-multiple">Zvolte kategorii/e:</label>
                    <select name="categories[]" id="category-select-multiple"
                            placeholder="Zvolte kategorie" multiple>
                        @foreach($categories as $category)
                            <option value="{{$category->id}}"
                                    @if(isset($_GET["categories"]) && in_array($category->id, $_GET["categories"])) selected @endif>{{$category->name}}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary btn-icon-split">
                    <span class="icon text-white-50">
                        <i class="fas fa-search"></i>
                    </span>
                    <span class="text">Vyhledat</span>
                </button>
            </form>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="myTable2">
                    <thead>
                    <tr>
                        <th>Název</th>
                        <th>Množství</th>
                        <th>Akce</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>Název</th>
                        <th>Množství</th>
                        <th>Akce</th>
                    </tr>
                    </tfoot>
                    <tbody>
                    @foreach ($categoriesItem->unique('id') as $categoryItem)
                        <tr>
                            <td>{{ $categoryItem->name }}</td>
                            <td>{{ $categoryItem->amount }} @if($categoryItem->min_amount) {{' / '.$categoryItem->min_amount}} @endif
                                Ks
                                <div class="btn-group float-right" role="group" aria-label="Basic example"><a
                                        class="btn btn-outline-secondary"
                                        href="{{route('items.amount.add', $categoryItem->id)}}">+</a><a
                                        class="btn btn-outline-secondary"
                                        href="{{route('items.amount.subtract', $categoryItem->id )}}">-</a></div>
                            </td>
                            <td>
                                <form action="{{ route('items.destroy',$categoryItem->id) }}" method="POST">

                                    <a class="btn btn-info btn-icon-split"
                                       href="{{ route('items.show',$categoryItem->id) }}">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-info-circle"></i>
                                        </span>
                                        <span class="text">Zobrazit</span>
                                    </a>

                                    <a class="btn btn-warning btn-icon-split"
                                       href="{{ route('items.edit',$categoryItem->id) }}">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-edit"></i>
                                        </span>
                                        <span class="text">Upravit</span>
                                    </a>

                                    <button type="button" class="btn btn-danger btn-icon-split" data-toggle="modal"
                                            data-target="#deleteModalForId{{$categoryItem->id}}">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-trash"></i>
                                        </span>
                                        <span class="text">Smazat</span>
                                    </button>

                                    <div class="modal fade" id="deleteModalForId{{$categoryItem->id}}" tabindex="-1"
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
                                                    položku {{$categoryItem->name}}?
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
                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Všechny položky skladu</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="myTable">
                    <thead>
                    <tr>
                        <th>Název</th>
                        <th>Množství</th>
                        <th>Akce</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>Název</th>
                        <th>Množství</th>
                        <th>Akce</th>
                    </tr>
                    </tfoot>
                    <tbody>

                    @foreach ($items as $item)
                        <tr>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->amount }} @if($item->min_amount) {{' / '.$item->min_amount}} @endif Ks
                                <div class="btn-group float-right" role="group" aria-label="Basic example"><a
                                        class="btn btn-outline-secondary"
                                        href="{{route('items.amount.add', $item->id)}}">+</a><a
                                        class="btn btn-outline-secondary"
                                        href="{{route('items.amount.subtract', $item->id )}}">-</a></div>
                            </td>
                            <td>
                                <form action="{{ route('items.destroy',$item->id) }}" method="POST">

                                    <a class="btn btn-info btn-icon-split" href="{{ route('items.show',$item->id) }}">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-info-circle"></i>
                                        </span>
                                        <span class="text">Zobrazit</span>
                                    </a>

                                    <a class="btn btn-warning btn-icon-split"
                                       href="{{ route('items.edit',$item->id) }}">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-edit"></i>
                                        </span>
                                        <span class="text">Upravit</span>
                                    </a>

                                    <button type="button" class="btn btn-danger btn-icon-split" data-toggle="modal"
                                            data-target="#deleteModalForId{{$item->id}}">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-trash"></i>
                                        </span>
                                        <span class="text">Smazat</span>
                                    </button>

                                    <div class="modal fade" id="deleteModalForId{{$item->id}}" tabindex="-1"
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
                                                <div class="modal-body">Opravdu chcete smazat položku {{$item->name}}?
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
                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Položky které potřebují doplnit</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="myTable1">
                    <thead>
                    <tr>
                        <th>Název</th>
                        <th>Množství</th>
                        <th>Akce</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>Název</th>
                        <th>Množství</th>
                        <th>Akce</th>
                    </tr>
                    </tfoot>
                    <tbody>

                    @foreach ($lowItems as $lowItem)
                        <tr>
                            <td>{{ $lowItem->name }}</td>

                            <td>{{ $lowItem->amount }} @if($lowItem->min_amount) {{' / '.$lowItem->min_amount}} @endif
                                Ks
                                <div class="btn-group float-right" role="group" aria-label="Basic example">
                                    <a
                                        class="btn btn-outline-secondary"
                                        href="{{route('items.amount.add', $lowItem->id)}}">+</a>
                                    <a
                                        class="btn btn-outline-secondary"
                                        href="{{route('items.amount.subtract', $lowItem->id )}}">-</a>
                                </div>
                            </td>
                            <td>
                                <form action="{{ route('items.destroy',$lowItem->id) }}" method="POST">

                                    <a class="btn btn-info btn-icon-split"
                                       href="{{ route('items.show',$lowItem->id) }}">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-info-circle"></i>
                                        </span>
                                        <span class="text">Zobrazit</span>
                                    </a>

                                    <a class="btn btn-warning btn-icon-split"
                                       href="{{ route('items.edit',$lowItem->id) }}">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-edit"></i>
                                        </span>
                                        <span class="text">Upravit</span>
                                    </a>

                                    <button type="button" class="btn btn-danger btn-icon-split" data-toggle="modal"
                                            data-target="#deleteModalForId{{$lowItem->id}}">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-trash"></i>
                                        </span>
                                        <span class="text">Smazat</span>
                                    </button>

                                    <div class="modal fade" id="deleteModalForId{{$lowItem->id}}" tabindex="-1"
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
                                                <div class="modal-body">Opravdu chcete smazat položku {{$lowItem->name}}
                                                    ?
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
                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!--

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold">Položky skladu podle umístění</h6>
            <form action="{{ route('items.index') }}" method="GET">
                @csrf
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <label for="position-select">Zvolte umístění:</label>
                    <select name="position_id" id="position-select">
@unless(isset($_GET["position_id"]))
        <option value="" selected disabled hidden>Zvolte umístění</option> @endunless
    @foreach($positions as $position)
        <option value="{{$position->id}}"
                                            @if(isset($_GET["position_id"]) && $_GET["position_id"] == $position->id) selected @endif>{{$position->name}}</option>
                                @endforeach
        </select>
    </div>
</div>
<div class="col-xs-12 col-sm-12 col-md-12 text-center">
    <button type="submit" class="btn btn-primary">Vyhledat</button>
</div>
</div>
</form>
</div>

<div class="card-body">
<div class="table-responsive">
<table class="table table-bordered" id="myTable1">
<thead>
<tr>
    <th>Název</th>
    <th>Množství</th>
    <th>Akce</th>
</tr>
</thead>
<tfoot>
<tr>
    <th>Název</th>
    <th>Množství</th>
    <th>Akce</th>
</tr>
</tfoot>
<tbody>

@foreach ($positionItems as $positionItem)
        <tr>
            <td>{{ $positionItem->name }}</td>
                            <td>{{ $positionItem->amount }}
            <div class="btn-group float-right" role="group" aria-label="Basic example"><a
                    class="btn btn-outline-secondary"
                    href="{{route('items.amount.add', $positionItem->id)}}">+</a><a
                                        class="btn btn-outline-secondary"
                                        href="{{route('items.amount.subtract', $positionItem->id )}}">-</a></div>
                            </td>
                            <td>
                                <form action="{{ route('items.destroy',$positionItem->id) }}" method="POST">

                                    <a class="btn btn-info"
                                       href="{{ route('items.show',$positionItem->id) }}">Zobrazit</a>

                                    <a class="btn btn-primary" href="{{ route('items.edit',$positionItem->id) }}">Upravit</a>

                                    <button type="button" class="btn btn-danger" data-toggle="modal"
                                            data-target="#deleteModalForId{{$positionItem->id}}">Smazat
                                    </button>

                                    <div class="modal fade" id="deleteModalForId{{$positionItem->id}}" tabindex="-1"
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
                                                    položku {{$positionItem->name}}?
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
</td>
</tr>
@endforeach

        </tbody>
    </table>
</div>
</div>
</div>
-->

@endsection

@push('scripts')
    <script src="{{asset('vendor/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
    <script>
        $(document).ready(function () {
            $('#myTable').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Czech.json"
                }
            });
            $('#myTable1').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Czech.json"
                }
            });
            $('#myTable2').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Czech.json"
                }
            });
        });
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
