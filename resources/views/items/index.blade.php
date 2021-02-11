@extends('layouts.admin')

@section('title', 'Sklad')

@section('css')
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css">
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

    @if (session('status'))
        <div class="alert alert-success border-left-success" role="alert">
            {{ session('status') }}
        </div>
    @endif

    <h1 class="h3 mb-2 text-gray-800">Sklad</h1>
    <a class="btn btn-success" href="{{ route('items.create') }}"> Přidat položku</a>

    <table class="table table-bordered" id="myTable" width="100%" cellspacing="0">
        <thead>
        <tr>
            <th>Název</th>
            <th>Množství</th>
            <th>Cena</th>
            <th>Akce</th>
        </tr>
        </thead>
        <tfoot>
        <tr>
            <th>Název</th>
            <th>Množství</th>
            <th>Cena</th>
            <th>Akce</th>
        </tr>
        </tfoot>
        <tbody>
        @foreach ($items as $item)
            <tr>
                <td>{{ $item->name }}</td>
                <td>{{ $item->amount }} <div class="btn-group float-right" role="group" aria-label="Basic example"><a class="btn btn-outline-secondary" href="">+</a><a class="btn btn-outline-secondary" href="">-</a></div></td>
                <td>{{ $item->price }}</td>
                <td>
                    <form action="{{ route('items.destroy',$item->id) }}" method="POST">

                        <a class="btn btn-info" href="{{ route('items.show',$item->id) }}">Zobrazit</a>

                        <a class="btn btn-primary" href="{{ route('items.edit',$item->id) }}">Upravit</a>

                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModalForId{{$item->id}}">Smazat</button>
                        <div class="modal fade" id="deleteModalForId{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">{{ __('Smazat?') }}</h5>
                                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">Opravdu chcete smazat položku {{$item->name}}?</div>
                                    <div class="modal-footer">
                                        <button class="btn btn-link" type="button" data-dismiss="modal">{{ __('Zrušit') }}</button>

                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal">Smazat</button>

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



@endsection

@push('scripts')
    <script src="//cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
        <script>
        $(document).ready(function() {
            $('#myTable').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Czech.json"
                }
            });
        } );
    </script>
@endpush
