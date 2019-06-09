@auth

<div class="comment card card-body bg-med">        
{!! Form::open(['action' => ['CommentController@store'], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
    <div class="form-group">
            {{Form::textarea('body', '', ['id' => 'comment-editor', 'class' => 'form-control', 'placeholder' => 'Place a comment...'])}}
            {{ Form::hidden('post_id', $post->id) }}
        </div>
        {{Form::submit('Submit', ['class'=>'btn btn-primary'])}}
{!! Form::close() !!}
</div>

@endauth