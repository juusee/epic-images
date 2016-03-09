@extends('layouts.app')

@section('title', 'Epic Images - image')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-2">
                <div class="image-info">
                    <ul class="list-group">
                        <li class="list-group-item">By <a href="{{url('/user/' . $user->username)}}">{{$user->username}}</a></li>
                        <li class="list-group-item">Uploaded at {{$image->created_at}}</li>
                    </ul>
                </div>
            </div>
            <div class="col-md-8">
                <h1>{{$image->description}}</h1>
                <div class="image-container">
                    <a target="_blank" href="{{url('images/' . $image->id . '.' . $image->extension)}}"><img src="{{url('/images/' . $image->id . '.' . $image->extension)}}" alt=""></a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div id="comment-area">

                </div>
            </div>
        </div>
    </div>

@endsection

@section('end')

<script src="https://cdnjs.cloudflare.com/ajax/libs/react/0.14.7/react.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/react/0.14.7/react-dom.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/babel-core/5.8.23/browser.min.js"></script>
<script type="text/babel" src="{{url('js/comments.js')}}"></script>

@endsection