@extends('layouts.admin')

@section('title', 'Statusy zakázek')

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

    <h1 class="h3 mb-2 text-gray-800">Zakázky - Statusy</h1>
    <a class="btn btn-success btn-icon-split mb-1" href="{{ route('statuses.create') }}">
        <span class="icon text-white-50">
            <i class="far fa-file"></i>
        </span>
        <span class="text">Přidat status</span>
    </a>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Všechny statusy</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="dataTables_wrapper dt-bootstrap4" id="myTable">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Název</th>
                        <th>Akce</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Název</th>
                        <th>Akce</th>
                    </tr>
                    </tfoot>
                    <tbody>

                    @foreach ($statuses as $status)
                        <tr>
                            <td>{{ $status->id }}</td>
                            <td><b class="
                                    @switch($status->id)
                                @case(1)
                                    text-info
@break

                                @case(2)
                                    text-primary
@break

                                @case(3)
                                    text-warning
@break

                                @case(4)
                                    text-success
@break
                                @case(5)
                                    text-danger
@break
                                @case(6)
                                    text-danger
@break
                                @case(7)
                                    text-dark
@break

                                @default
                                    text-secondary
@endswitch
                                    ">{{ $status->name }}</b>

                            </td>
                            <td>
                                <form action="{{ route('statuses.destroy',$status->id) }}" method="POST">

                                    <a class="btn btn-warning btn-icon-split"
                                       href="{{ route('statuses.edit',$status->id) }}">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-edit"></i>
                                        </span>
                                        <span class="text">Upravit</span>
                                    </a>

                                    <button type="button" class="btn btn-danger btn-icon-split" data-toggle="modal"
                                            data-target="#deleteModalForId{{$status->id}}">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-trash"></i>
                                        </span>
                                        <span class="text">Smazat</span>
                                    </button>

                                    <div class="modal fade" id="deleteModalForId{{$status->id}}" tabindex="-1"
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
                                                    položku {{$status->name}}?
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