@extends('layouts.app')
@section('content')


<div id="sidebar" class="col-md-4">
    <div id="profile" class="card bg-med">
    <div class="card-header">
    <span>{{$name}} <span class="secondary-text">(#{{$id}})</span></span>
    @auth
    @if (Auth::user()->id == $id)
    <a href="/profiles/{{$id}}/edit"class="pull-right">Edit</a>
    @endif
    @endauth
    </div>
    <div class="card-body">
    <img class="profile-picture" src="../storage/profile-pictures/{{$profile_picture}}">
    <span>Reputation: {{$rep}}</span><br>
    @if ($country != null)
    <span>Lives in {{$country}}</span><br>
    @endif    
    <span><a href="{{$website}}">{{$website}}</a></span><br>

    @if ($birthDate != null)
    <span>Born on {{$birthDate}}</span><br>
    @endif

    <span class="secondary-text"><small>Joined on {{substr($created_at,0,10)}}</small></span>
    </div>
    </div>
    
</div>
    <div class="row justify-content-center col-md-8">

            

                
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @include('inc.post')
                    <div id="posts" class="col-md-12">
                    <h3>{{$name}}'s posts</h3>
                    
                    @if(count($posts) > 0)
                    @foreach($posts as $post)
                
                    <div class="card card-body post-wrapper bg-med {{$post->top_category->name}}">
                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <h3><a href="/posts/{{$post->id}}">[{{$post->top_category->name}}]{{$post->title}}</a></h3>
                                <div class="post body">{!!$post->body!!}</div>
                            <small class="secondary-text">Written on {{$post->created_at}}</small>
                            <br>
                            @include('inc.postControls')    
                        </div>
                        </div>
                    </div>
                    @endforeach
                    @else
                    <p>No posts found</p>
                    @endif
                    
                </div>
           
        
    </div>



@endsection
