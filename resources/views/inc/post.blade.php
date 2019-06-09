@auth
@if (empty($id) || Auth::user()->id == $id)
<button class="collapseCreate" onclick="collapseCreate.call(this)">Create post</button>


<div class="card create-post bg-med">
<div class="card-body">        
{!! Form::open(['action' => 'PostController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
    <div class="form-group">
        {{Form::text('title', '', ['class' => 'form-control post-title', 'placeholder' => 'Title'])}}
    </div>
    <div class="form-group">
            {{Form::textarea('body', '', ['id' => 'post-editor', 'class' => 'form-control', 'placeholder' => 'Write a post...'])}}
        </div>
        <div class="form-group">
                {{Form::radio('top_category', '1')}}
                {{Form::label('question', 'Question')}}
                {{Form::radio('top_category', '2')}}
                {{Form::label('project', 'Project')}}
                {{Form::radio('top_category', '3')}}
                {{Form::label('misc', 'Miscellaneous')}}

                
                </div>
                
        {{Form::submit('Submit', ['class'=>'btn btn-primary pull-right'])}}
{!! Form::close() !!}
</div>
</div>

@endif
@endauth

