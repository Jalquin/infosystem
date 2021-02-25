@extends('layouts.admin')

@section('title', 'Uživatel ' . $user->name)

@section('content')

    <h2>Detaily osoby <b>{{ $user->name }}</b></h2>
    <a href="{{ route('users.index') }}" class="btn btn-secondary btn-icon-split">
                    <span class="icon text-white-50">
                        <i class="fas fa-arrow-left"></i>
                    </span>
        <span class="text">Zpět</span>
    </a>

    <dl class="row mt-1 border">
        <dt class="col-sm-3">Jméno:</dt>
        <dd class="col-sm-9">{{ $user->name }}</dd>
        <dt class="col-sm-3">Email:</dt>
        <dd class="col-sm-9">{{ $user->email }}</dd>
        @if($user->admin == 1)
            <dt class="col-sm-3">Admin:</dt>
            <dd class="col-sm-9">Ano</dd>
        @endif
    </dl>

    <div class="row">
        <a class="btn btn-warning btn-icon-split m-1"
           href="{{ route('users.edit',$user->id) }}">
            <span class="icon text-white-50">
                <i class="fas fa-edit"></i>
            </span>
            <span class="text">Upravit</span>
        </a>

        <button type="button" class="btn btn-danger btn-icon-split m-1" data-toggle="modal"
                data-target="#deleteModalForId{{$user->id}}">
                                            <span class="icon text-white-50">
                                                <i class="fas fa-trash"></i>
                                            </span>
            <span class="text">Smazat</span>
        </button>
        <form action="{{ route('users.destroy',$user->id) }}" method="POST">
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
    </div>

@endsection
