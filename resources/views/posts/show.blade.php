@extends('layouts.app')
@section('content')
<a href="/posts" class="btn btn-default">Back</a>
@include('inc.postDisplay')


@include('inc.comment')

@if ($post->comments->count() > 0)

@foreach($post->comments->sortByDesc('created_at') as $comment) 

    <div class="card card-body post-wrapper bg-med">
        <div class="row">
            <div class="col-md-2 col-sm-2">
                <img class="profile-picture" style="width:100%"
                    src="../storage/profile-pictures/{{$comment->user->profile_picture}}">
                <span><a href="/profiles/{{$comment->user->id}}"><strong>{{$comment->user->name}}</strong></a></span><br>
                <span>Reputation: {{$comment->user->rep}}</span><br>
                @if ($comment->user->country != null)
                <span>{{$comment->user->country}}</span><br>
                @endif
            </div>
            <div class="col-md-10 col-sm-10">
                <h3>{{$comment->title}}</h3>
                <div class="post-body">{!!$comment->body!!}</div>

                <div class="post-footer">
                    
                        
                    <small class="secondary-text">Written on {{$comment->created_at}}</small>
                    @include('inc.commentControls')
                    </div>
                </div>

            </div>
        </div>
@endforeach
@endif

@endsection

