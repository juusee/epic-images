@extends('layouts.app')

@section('title', 'Epic Images - user images')

@section('content')

    <div class="user-images container">
        <div class="row">
            @if ($user)
                <div class="col-md-2">
                    <ul class="nav nav-stacked nav-pills">
                        <li role="presentation"><a href="{{url('/users/' . $user->username)}}">Profile</a></li>
                        <li role="presentation" class="active"><a href="{{url('users/' . $user->username . '/images')}}">Images</a></li>
                    </ul>
                </div>
                <div class="col-md-10">
                    <?php $i = 0;?>
                    @foreach($images as $image)
                        @if($i != 0 && $i % 4 == 0)
                            </div>
                        @endif
                        @if($i % 4 == 0)
                            <div class="row">
                        @endif
                        <div class="col-md-3">
                            <div class="image-list">
                                <a href="{{url('images/' . $image->id)}}"><img width="200" height="200" src="{{url('imgs/' . $image->id . '.' . $image->extension)}}" alt=""></a>

                                @if(Auth::user()->allowed('delete.images', $image))

                                    <form class="form-remove" action="{{url('images/' . $image->id)}}" method="POST">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <button type="submit" id="delete-image-{{$image->id}}" class="btn btn-danger btn-sm">
                                            Delete
                                        </button>
                                    </form>

                                @endif
                            </div>
                        </div>
                        <?php $i++; ?>
                    @endforeach
                </div>
                </div>
            @else
                <div>
                    <p>User doesn't exist</p>
                </div>
            @endif

        </div>
    </div>

@endsection