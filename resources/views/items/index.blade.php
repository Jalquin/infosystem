@extends('layouts.admin')

@section('title', 'Sklad')

@section('css')
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css">
@endsection

@section('content')

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
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
                <td>{{ $item->amount }}</td>
                <td>{{ $item->price }}</td>
                <td>
                    <form action="{{ route('items.destroy',$item->id) }}" method="POST">

                        <a class="btn btn-info" href="{{ route('items.show',$item->id) }}">Show</a>

                        <a class="btn btn-primary" href="{{ route('items.edit',$item->id) }}">Edit</a>

                        @csrf
                        @method('DELETE')

                        <button type="submit" class="btn btn-danger">Delete</button>
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
