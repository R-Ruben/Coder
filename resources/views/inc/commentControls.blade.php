@if(!Auth::guest())
@if(Auth::user()->id == $comment->user_id)
<a href="/comments/{{$comment->id}}/edit" class="btn btn-default">Edit</a>
{!!Form::open(['action' => ['CommentController@destroy', $comment->id], 'method' => 'POST', 'class' => 'pull-right'])!!}
{{Form::hidden('_method', 'DELETE')}}
{{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
{!!Form::close()!!}
@endif
@endif