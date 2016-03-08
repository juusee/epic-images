@extends('layouts.app')

@section('title', 'Epic Images - image')

@section('content')

    <div class="image container">
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
                <div class="comment-area">
                    <div class="comment-area-title">
                        <label>Comments</label>
                    </div>
                    <div class="actionBox">
                        @if (Auth::guest())
                            <p>You have to login or register to comment</p>
                        @else
                            <form id="commentForm" class="form-inline" role="form" method="POST" action="{{url('image/' . $image->id . '/comment')}}">
                                <div class="form-group">
                                    <textarea form="commentForm" class="form-control" name="comment" placeholder="Add comment!"></textarea>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-default">Add</button>
                                </div>
                                {!! csrf_field() !!}
                            </form>
                        @endif
                        <ul class="commentList">
                            @foreach($comments as $comment)
                                <li>
                                    <div class="commentText">
                                        <p class="commenter">{{$comment->user}}:</p>
                                        <p class="">{{$comment->content}}</p> <span class="date sub-text">{{$comment->created_at}}</span>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection