@extends('layouts.admin')

@section('title', 'Pozice skladu')

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

    <h1 class="h3 mb-2 text-gray-800">Sklad - Pozice</h1>
    <a class="btn btn-success btn-icon-split mb-1" href="{{ route('positions.create') }}">
        <span class="icon text-white-50">
            <i class="far fa-file"></i>
        </span>
        <span class="text">Přidat pozici</span>
    </a>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Všechny pozice</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="display compact" id="myTable">
                    <thead>
                    <tr>
                        <th>Název</th>
                        <th>Akce</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>Název</th>
                        <th>Akce</th>
                    </tr>
                    </tfoot>
                    <tbody>

                    @foreach ($positions as $position)
                        <tr>
                            <td>{{ $position->name }}</td>
                            <td>
                                <form action="{{ route('positions.destroy',$position->id) }}" method="POST">

                                    <a class="btn btn-warning btn-icon-split"
                                       href="{{ route('positions.edit',$position->id) }}">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-edit"></i>
                                        </span>
                                        <span class="text">Upravit</span>
                                    </a>

                                    <button type="button" class="btn btn-danger btn-icon-split" data-toggle="modal"
                                            data-target="#deleteModalForId{{$position->id}}">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-trash"></i>
                                        </span>
                                        <span class="text">Smazat</span>
                                    </button>

                                    <div class="modal fade" id="deleteModalForId{{$position->id}}" tabindex="-1"
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
                                                    položku {{$position->name}}?
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

@endsection

@push('scripts')
    <script src="//cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#myTable').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Czech.json"
                }
            });
        });
    </script>
@endpush
