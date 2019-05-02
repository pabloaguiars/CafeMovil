@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">General</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if (session('failure'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('failure') }}
                        </div>
                    @endif

                    @foreach ($activities as $activity)
                        @if ($activity[0] == 0)
                            <br/><a href="{{ route($activity[1]) }}">{{$activity[2]}}</a>
                        @elseif ($activity[0] == 1)
                            <br/><a href="{{ route($activity[1],['action' => $activity[3]]) }}">{{$activity[2]}}</a>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
