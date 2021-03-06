@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                @if (Auth::check())
                <div class="panel-body">
                    <chat :room="{{$room}}" :user="{{Auth::user()}}"></chat>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
