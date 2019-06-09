@extends('layouts.app')
@section('content')
<div class="card bg-med">
        <div class="card-header">
                Edit post
        </div>
        <div class="card-body">   
                            
 {!! Form::open(['action' => ['PostController@update', $post->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                <div class="form-group">
                {{Form::text('title', $post->title, ['class' => 'form-control post-title', 'placeholder' => 'Title'])}}
            </div>
            <div class="form-group">
                    {{Form::textarea('body', $post->body, ['id' => 'post-editor', 'class' => 'form-control', 'placeholder' => 'Write a post...'])}}
                </div>
                <div class="form-group">
                        {{Form::radio('top_category', '1')}}
                        {{Form::label('question', 'Question')}}
                        {{Form::radio('top_category', '2')}}
                        {{Form::label('project', 'Project')}}
                        {{Form::radio('top_category', '3')}}
                        {{Form::label('misc', 'Miscellaneous')}}
        
                        
                        </div>
                        {{Form::hidden('_method','PUT')}}
                {{Form::submit('Submit', ['class'=>'btn btn-primary pull-right'])}}
        {!! Form::close() !!}
        </div>
        </div>

@endsection


