@extends('layouts.app')

@section('title', 'Epic Images - edit profile')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <form class="form-horizontal" role="form" method="POST" action="{{url('/user/' . $user->id)}}">
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

                <form class="form-remove form-horizontal" role="form" action="{{url('user/' . $user->id)}}" method="POST">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <div class="form-group">
                        <button type="submit" id="delete-user-{{ $user->id }}" class="btn btn-danger">
                            Delete account
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection