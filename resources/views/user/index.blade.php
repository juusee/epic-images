@extends('layouts.app')

@section('title', 'Epic Images - profile')

@section('content')

<div class="container">
    <div class="row">
        @if ($user)
        <div class="col-md-2">
            <ul class="nav nav-stacked nav-pills">
                <li role="presentation" class="active"><a href="{{url('/users/' . $user->username)}}">Profile</a></li>
                <li role="presentation"><a href="{{url('users/' . $user->username .  '/images')}}">Images</a></li>
            </ul>
        </div>
        <div class="col-md-6 col-md-offset-1">

            @if(Auth::user()->allowed('edit.users', $user, true, 'id'))
                <form id="updateForm" class="form-horizontal" role="form" method="POST" action="{{url('/users/' . $user->id)}}">
                    {!! csrf_field() !!}
                    {{ method_field('PUT') }}

                    <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                        <label class="control-label">Username</label>
                        <input type="text" class="form-control" name="username" value="{{ $user->username }}">
                    </div>

                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <label class="control-label">E-Mail Address</label>
                        <input type="email" class="form-control" name="email" value="{{ $user->email }}">
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">
                            Update
                        </button>
                    </div>
                </form>

                <p>Or</p>

                <form class="form-remove form-horizontal" role="form" action="{{url('users/' . $user->id)}}" method="POST">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <div class="form-group">
                        <button type="submit" id="delete-user-{{ $user->id }}" class="btn btn-danger">
                            Delete account
                        </button>
                    </div>
                </form>
            @else
                <ul class="list-group">
                    <li class="list-group-item">User: {{$user->username}}</li>
                    <li class="list-group-item">Email: {{$user->email}}</li>
                </ul>
            @endif
        </div>
        @else
        <div>
            <p>User doesn't exist</p>
        </div>
        @endif

    </div>
</div>

@endsection