<div class="card card-body post-wrapper bg-med {{$post->top_category->name}}">
    <div class="row">
        <div class="col-md-2 col-sm-2">
            <img class="profile-picture" style="width:100%"
                src="../storage/profile-pictures/{{$post->user->profile_picture}}">
            <span><a href="/profiles/{{$post->user->id}}"><strong>{{$post->user->name}}</strong></a></span><br>
            <span>Reputation: {{$post->user->rep}}</span><br>
            @if ($post->user->country != null)
            <span>{{$post->user->country}}</span><br>
            @endif
        </div>
        <div class="col-md-10 col-sm-10">
            <h3><a href="/posts/{{$post->id}}">[{{$post->top_category->name}}]{{$post->title}}</a></h3>
            <div class="post-body">{!!$post->body!!}</div>

            <div class="post-footer">
                
                    <span class="post-rep @if($post->rep < 0)negative @endif">{{$post->rep}}</span>
                <small class="secondary-text">Written on {{$post->created_at}}</small>
                @include('inc.postControls')
                </div>
            </div>

        </div>
    </div>