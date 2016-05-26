@extends('layouts.app')
@section('title', 'Epic Images - frontpage')
@section('content')

<div class="frontpage container">
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
                    <a href="{{url('images/' . $image->id)}}"><img width="240" height="240" src="{{url('imgs/' . $image->id . '.' . $image->extension)}}" alt="{{$image->description}}"></a>
                </div>
            </div>
        <?php $i++; ?>
    @endforeach
    </div>
</div>
@endsection
