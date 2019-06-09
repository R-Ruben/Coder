@extends('layouts.app')

@section('content')

<div id="applications">
    <h1>My applications</h1>

    @if(count($applications) > 0)
    @foreach($applications as $application)
    <div class="row project">
    <div class="card bg-med">
        <div class="card-header">
            <h4>{{$application->project->title}}</h4>
        </div>
        <div class="container bootstrap-table">
            <div class="row">
                    <div class="col-md-3 col-sm-3 projects-column">
                            <span><strong>Created by</strong></span>
                        <p>{{$application->project->user->name}}</p>
                    </div>
                <div class="col-md-3 col-sm-3 projects-column">
                        <span><strong>Start date</strong></span>
                    <p>{{$application->project->created_at}}</p>
                </div>
                <div class="col-md-2 col-sm-2 projects-column">
                        <span><strong>Deadline</strong></span>
                    <p>{{$application->project->deadline}}</p>
                </div>
                <div class="col-md-2 col-sm-2 projects-column">
                        <span><strong>Price</strong></span>
                    @if($application->project->price != null)
                    <p>{{$application->project->price}}</p>
                    @else
                    <p>TBD</p>
                    @endif
                </div>
                <div class="col-md-2 col-sm-2 projects-column">
                        <span><strong>Price type</strong></span>
                    <p>{{$application->project->price_type}}</p>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-12 col-sm-12">
                        <span><strong>Description</strong></span><br>
                    {!!$application->project->description!!}
                </div>
            </div>
            <div class="row">
                <div class="col-md-9 col-sm-9">
                    @foreach($application->project->programming_languages as $p_language)
                    @if($p_language->name != 'Other')
                    <div class="p-language-tag">{{$p_language->name}}</div>
                    @endif
                    @endforeach
                   
                </div>

            </div>
        </div>


        
            <div class="container bootstrap-table">
               
                <div class="row">
        <div class="col-md-7 col-sm-7">
                <span><strong>Motivation</strong></span>
            </div>
            @if ($application->project->price_type == 'open')
            <div class="col-md-2 col-sm-2">
                    <span><strong>Price</strong></span>
                </div>
    @endif
    </div>
                   
                    <div class="row application">
                <div class="col-md-12 col-sm-12">
                        {!!Form::open(['action' => ['ApplicationController@update', $application->id], 'method' => 'POST'])!!}
                    <div class="row">
                            @if ($application->project->price_type == 'open')
                            <div class="col-md-7 col-sm-7">
                                @else
                                <div class="col-md-9 col-sm-9">
                            @endif   
                                
                                {{Form::textarea('motivation', $application->motivation, ['class' => 'form-control', 'placeholder' => ''])}}
                            </div>
                            @if ($application->project->price_type == 'open')
                            <div class="col-md-2 col-sm-2">
                                    
                                    <span>{{Form::number('price', $application->price, ['class' => 'form-control'])}}</span>
                                    
                        </div>
                        @endif   
                        <div class="col-md-3 col-sm-3">
                        <div class="row">
                                <div class="col-md-12 col-sm-12">
                                <a href="/chat/{{$application->user->id}}" class="btn btn-primary">Send a message</a>
                            </div>
                        </div>
                            <div class="row">
                                @if($application->accepted == '1')
                                <div class="col-md-6 col-sm-6">
                                        <div class="positive-text">Accepted</div>
                                    </div>
                                @elseif($application->accepted == '-1')
                                <div class="col-md-6 col-sm-6">
                                        <div class="negative-text">Declined</div>
                                    </div>
                                @else
                                    <div class="col-md-6 col-sm-6">
                                    {{Form::hidden('_method', 'PUT')}}
                                    {{Form::submit('Edit', ['class' => 'btn btn-success'])}}
                                    {!!Form::close()!!}
                                </div>
                                @endif
                                    <div class="col-md-6 col-sm-6">
                                    {!!Form::open(['action' => ['ApplicationController@destroy', $application->id], 'method' => 'POST'])!!}
                                    {{Form::hidden('_method', 'DELETE')}}
                                    {{Form::submit('Remove', ['class' => 'btn btn-danger'])}}
                                    
                                </div>
                                
                            </div>
                            </div>
                            </div>
                            

                            
                                
                      

                            
                        </div>
                        {!!Form::close()!!}
                    </div>
                
                    
                </div>
               
                
            
        </div>
    </div>
        @endforeach
        @else
        <p>No projects found</p>
        @endif
    </div>
    @endsection
