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

                    ¡Has iniciado sesión! <br/>

                    @foreach ($activities as $activity)
                        <br/><a href="{{ route($activity[0]) }}">{{$activity[1]}}</a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
