@extends('layouts.app')

@section('title', 'Epic Images - upload image')

@section('content')

    <div class="container">
        <div class="row col-md-4 col-md-offset-4">
            <form class="form-horizontal" role="form" method="POST" action="{{url('images')}}" enctype="multipart/form-data">
                {!! csrf_field() !!}
                <div class="form-group">
                    <label class="control-label" for="image">File input</label>
                    <input type="file" id="image" name="image">
                </div>
                <div class="form-group">
                    <label class="control-label" for="description">Description</label>
                    <input class="form-control" type="text" id="description" name="description">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-default">
                        Upload
                    </button>
                </div>
                <div class="alert">
                    {{ session('message') }}
                </div>
            </form>
        </div>
    </div>

@endsection