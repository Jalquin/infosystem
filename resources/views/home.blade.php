@extends('layouts.admin')

@section('title', 'Přehled')

@section('content')

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('Přehled') }}</h1>

    @if (session('success'))
        <div class="alert alert-success border-left-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="row">

        <!-- Content Column -->
        <div class="col-lg-12 mb-4">

            <!-- Project Card Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Probíhající zakázky
                        <a class="btn btn-info btn-icon-split mb-1" href="{{ route('jobs.index') }}">
                        <span class="icon text-white-50">
                            <i class="fas fa-hammer"></i>
                        </span>
                            <span class="text">Zakázky</span>
                        </a>
                    </h6>

                </div>
                <div class="card-body">

                    @foreach($jobs as $job)
                        <a href="{{ route('jobs.show',$job->id) }}"><h4
                                class="small font-weight-bold">{{$job->number.': '.$job->name}}<span
                                    class="float-right">{{$job->status->name}}</span>
                            </h4></a>
                        <div class="progress mb-4">
                            <div class="progress-bar
                                    @switch($job->status_id)
                                        @case(1)
                                            bg-info
                                        @break

                                        @case(2)
                                            bg-primary
                                        @break

                                        @case(3)
                                            bg-warning
                                        @break

                                        @case(4)
                                            bg-success
                                        @break

                                        @case(5)
                                            bg-danger
                                        @break

                                        @case(6)
                                            bg-danger
                                        @break

                                        @default
                                            bg-secondary
                                    @endswitch
                                " role="progressbar"
                                 style="width: {{($job->status_id / (count(\App\Models\Status::all())-2))*100}}%"
                                 aria-valuenow="{{$job->status_id}}"
                                 aria-valuemin="0"
                                 aria-valuemax="{{count(\App\Models\Status::all())-2}}">{{$job->status->name}}
                            </div>
                        </div>

                    @endforeach

                </div>
            </div>
        </div>
    </div>

    <div class="row">

        <!-- Content Column -->
        <div class="col-lg-12 mb-4">

            <!-- Project Card Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Chybějící položky skladu
                        <a class="btn btn-info btn-icon-split mb-1" href="{{ route('items.index') }}">
                        <span class="icon text-white-50">
                            <i class="fas fa-warehouse"></i>
                        </span>
                            <span class="text">Sklad</span>
                        </a>
                    </h6>

                </div>
                <div class="card-body">

                    @foreach($lowItems as $lowItem)
                        <a href="{{ route('items.show',$lowItem->id) }}"><h4
                                class="small font-weight-bold">{{$lowItem->name}}<span class="float-right">{{$lowItem->min_amount}} Ks</span>
                            </h4></a>
                        <div class="progress mb-4">
                            <div class="progress-bar bg-primary" role="progressbar"
                                 style="width: {{$lowItem->amount * 100}}%" aria-valuenow="{{$lowItem->amount}}"
                                 aria-valuemin="0" aria-valuemax="{{$lowItem->min_amount}}">{{$lowItem->amount}} Ks
                            </div>
                            <div class="progress-bar bg-danger" role="progressbar"
                                 style="width: {{($lowItem->min_amount - $lowItem->amount) * 100}}%"
                                 aria-valuenow="{{$lowItem->min_amount - $lowItem->amount}}"
                            >{{$lowItem->min_amount - $lowItem->amount}} Ks
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>

@endsection
