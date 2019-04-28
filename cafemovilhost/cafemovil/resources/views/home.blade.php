@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in! <br/>

                    @foreach ($activities as $activity)
                        <br/><a href="{{$activity[0]}}">{{$activity[1]}}</a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
