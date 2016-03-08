@extends('layouts.app')

@section('title', 'Epic Images - profile')

@section('content')

<div class="container">
    <div class="row">
        @if ($user)
        <div class="col-md-2">
            <ul class="nav nav-stacked nav-pills">
                <li role="presentation" class="active"><a href="{{url('/user/' . $user->username)}}">Profile</a></li>
                <li role="presentation"><a href="{{url('user/' . $user->username .  '/images')}}">Images</a></li>
            </ul>
        </div>
        <div class="col-md-8">
            <ul class="list-group">
                <li class="list-group-item">User: {{$user->username}}</li>
                <li class="list-group-item">Email: {{$user->email}}</li>
            </ul>
        </div>
        @else
        <div>
            <p>User doesn't exist</p>
        </div>
        @endif

    </div>
</div>

@endsection