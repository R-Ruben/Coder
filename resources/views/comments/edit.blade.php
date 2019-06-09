@extends('layouts.app')
@section('content')
<h1>Edit comment</h1>
{!! Form::open(['action' => ['CommentController@update', $comment->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
    <div class="form-group">
            {{Form::textarea('body', $comment->body, ['id'=> 'article-ckeditor', 'class' => 'form-control', 'placeholder' => ''])}}
        </div>
        {{Form::hidden('_method','PUT')}}
        {{Form::submit('Submit', ['class'=>'btn btn-primary'])}}
{!! Form::close() !!}
@endsection