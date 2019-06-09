@extends('layouts.app')

@section('content')

<div id="projects">
    <div class="row project">
    <div class="card bg-med">
        <div class="card-header">
            <h4>{{$project->title}}</h4>
        </div>
        <div class="container bootstrap-table">
            <div class="row">
                <div class="col-md-3 col-sm-3 projects-column">
                    <span><strong>Created by</strong></span>
                <p>{{$project->user->name}}</p>
            </div>
        <div class="col-md-3 col-sm-3 projects-column">
                <span><strong>Start date</strong></span>
            <p>{{$project->created_at}}</p>
        </div>
        <div class="col-md-2 col-sm-2 projects-column">
                <span><strong>Deadline</strong></span>
            <p>{{$project->deadline}}</p>
        </div>
        <div class="col-md-2 col-sm-2 projects-column">
                <span><strong>Price</strong></span>
            @if($project->price != null)
            <p>{{$project->price}}</p>
            @else
            <p>TBD</p>
            @endif
        </div>
        <div class="col-md-2 col-sm-2 projects-column">
                <span><strong>Price type</strong></span>
            <p>{{$project->price_type}}</p>
        </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-12 col-sm-12">
                        <span><strong>Description</strong></span>
                    {!!$project->description!!}
                </div>
            </div>
            <div class="row">
                <div class="col-md-9 col-sm-9">
                    @foreach($project->programming_languages as $p_language)
                    @if($p_language->name != 'Other')
                    <div class="p-language-tag">{{$p_language->name}}</div>
                    @endif
                    @endforeach
                   
                </div>

            </div>
        </div>

    </div>
    </div>

    <div class="row">
            
        <div class="col-md-12 col-sm-12">
                <h4>Apply</h4>
                {!! Form::open(['action' => ['ApplicationController@store'], 'method' => 'POST', 'enctype' =>
                'multipart/form-data']) !!}
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Motivation:</label>
                            {{Form::textarea('motivation', '', ['class' => 'form-control', 'placeholder' => ''])}}
                        </div>
                        <div class="row">
                        <div class="form-group col-md-4 @if($project->price != null)hidden @endif " id="payment-price">
                            <label>Price:</label>
                            {{Form::number('price', '', ['class' => 'form-control'])}}
                        </div>
                    </div>
                
                    </div>
                </div>
                {{ Form::hidden('project_id', $project->id) }}
                {{Form::hidden('_method','PUT')}}
                {{Form::submit('Apply', ['class'=>'btn btn-primary'])}}
                {!! Form::close() !!}

        </div>
        
    </div>
    @endsection
