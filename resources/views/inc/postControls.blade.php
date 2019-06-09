@if(!Auth::guest())
@if(Auth::user()->id == $post->user_id)
{!!Form::open(['action' => ['PostController@destroy', $post->id], 'method' => 'POST', 'class' => 'pull-right'])!!}
{{Form::hidden('_method', 'DELETE')}}
{{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
{!!Form::close()!!}
<a href="/posts/{{$post->id}}/edit" class="btn btn-primary pull-right">Edit</a>
@endif

@if(Auth::user()->id != $post->user_id)
<like-controls :user="{{ auth()->user() }}" :post="{{ $post }}" ></like-controls>
@endif

@endif

