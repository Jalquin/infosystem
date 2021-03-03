@extends('layouts.admin')

@section('title', 'Zakázky')

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

    <h1 class="h3 mb-2 text-gray-800">Zakázky</h1>
    <a class="btn btn-success btn-icon-split mb-1" href="{{ route('jobs.create') }}">
        <span class="icon text-white-50">
            <i class="far fa-file"></i>
        </span>
        <span class="text">Přidat zakázku</span>
    </a>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Všechny zakázky</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="display compact" id="myTable">
                    <thead>
                    <tr>
                        <th>Nabídka</th>
                        <th>Závazná objednávka</th>
                        <th>Faktura</th>
                        <th>Název</th>
                        <th>Status</th>
                        <th>Akce</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>Nabídka</th>
                        <th>Závazná objednávka</th>
                        <th>Faktura</th>
                        <th>Název</th>
                        <th>Status</th>
                        <th>Akce</th>
                    </tr>
                    </tfoot>
                    <tbody>

                    @foreach ($jobs as $job)
                        <tr>
                            <td>{{ $job->tender_number }}</td>
                            <td>{{ $job->number }}</td>
                            <td>{{ $job->invoice_number }}</td>
                            <td>{{ $job->name }}</td>
                            <td><b class="
                                    @switch($job->status_id)
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
                                    ">{{ $job->status->name }}</b>
                            </td>
                            <td>
                                <form action="{{ route('jobs.destroy',$job->id) }}" method="POST">

                                    <a class="btn btn-info btn-icon-split"
                                       href="{{ route('jobs.show',$job->id) }}">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-info-circle"></i>
                                        </span>
                                        <span class="text">Zobrazit</span>
                                    </a>

                                    <a class="btn btn-warning btn-icon-split"
                                       href="{{ route('jobs.edit',$job->id) }}">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-edit"></i>
                                        </span>
                                        <span class="text">Upravit</span>
                                    </a>

                                    <button type="button" class="btn btn-danger btn-icon-split" data-toggle="modal"
                                            data-target="#deleteModalForId{{$job->id}}">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-trash"></i>
                                        </span>
                                        <span class="text">Smazat</span>
                                    </button>

                                    <div class="modal fade" id="deleteModalForId{{$job->id}}" tabindex="-1"
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
                                                    položku {{$job->number}}?
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
