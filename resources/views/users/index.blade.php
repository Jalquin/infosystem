@extends('layouts.admin')

@section('title', 'Uživatelé')

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

    <h1 class="h3 mb-2 text-gray-800">Uživatelé</h1>

    <div class="row">
        <!-- Users -->
        <div class="col-xl-12 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div
                                class="text-xs font-weight-bold text-warning text-uppercase mb-1">{{ __('Celkový počet uživatelů') }}</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $widget['usersCount'] }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <a class="btn btn-success btn-icon-split mb-1" href="{{ route('users.create') }}">
        <span class="icon text-white-50">
            <i class="fas fa-user-plus"></i>
        </span>
        <span class="text">Přidat uživatele</span>
    </a>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Všechny uživatelé</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="display compact nowrap" id="myTable">
                    <thead>
                    <tr>
                        <th>Jméno</th>
                        <th>Admin</th>
                        <th>Akce</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>Jméno</th>
                        <th>Admin</th>
                        <th>Akce</th>
                    </tr>
                    </tfoot>
                    <tbody>

                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->admin }}</td>
                            <td>
                                <form action="{{ route('users.destroy',$user->id) }}" method="POST">

                                    <a class="btn btn-info btn-icon-split"
                                       href="{{ route('users.show',$user->id) }}">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-info-circle"></i>
                                        </span>
                                        <span class="text">Zobrazit</span>
                                    </a>

                                    <a class="btn btn-warning btn-icon-split"
                                       href="{{ route('users.edit',$user->id) }}">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-user-edit"></i>
                                        </span>
                                        <span class="text">Upravit</span>
                                    </a>

                                    <button type="button" class="btn btn-danger btn-icon-split" data-toggle="modal"
                                            data-target="#deleteModalForId{{$user->id}}">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-user-times"></i>
                                        </span>
                                        <span class="text">Smazat</span>
                                    </button>

                                    <div class="modal fade" id="deleteModalForId{{$user->id}}" tabindex="-1"
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
                                                    položku {{$user->name}}?
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
