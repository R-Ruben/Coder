@extends('layouts.app')

@section('content')

<div id="projects">
    <h1>My projects</h1>


    @if(count($projects) > 0)
    @foreach($projects as $project)
    <div class="row project">
    <div class="card bg-med">
        <div class="card-header">
            <h4>{{$project->title}}</h4>
        </div>
        <div class="container bootstrap-table">
            <div class="row">
                <div class="col-md-3 col-sm-3 projects-column">
                        <span><strong>Start date</strong></span>
                    <p>{{$project->created_at}}</p>
                </div>
                <div class="col-md-3 col-sm-3 projects-column">
                        <span><strong>Deadline</strong></span>
                    <p>{{$project->deadline}}</p>
                </div>
                <div class="col-md-3 col-sm-3 projects-column">
                        <span><strong>Price</strong></span>
                    @if($project->price != null)
                    <p>{{$project->price}}</p>
                    @else
                    <p>TBD</p>
                    @endif
                </div>
                <div class="col-md-3 col-sm-3 projects-column">
                        <span><strong>Price type</strong></span>
                    <p>{{$project->price_type}}</p>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-12 col-sm-12">
                        <span><strong>Description</strong></span><br>
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


            @if(auth()->user()->id == $project->user->id)
            <!--Check if there are any applications, excluding declined ones-->
            @if(count($project->applications->where('accepted', null)) + count($project->applications->where('accepted', '1')) > 0) 
            
            <div class="container bootstrap-table">
                <h4>Applications</h4>
                <div class="row">
                        <div class="col-md-2 col-sm-2">
                <span><strong>User information</strong></span>
            </div>
            
                    <div class="col-md-2 col-sm-2">
            <span><strong>Company information</strong></span>
        </div>
        <div class="col-md-2 col-sm-2">
                <span><strong>Motivation</strong></span>
            </div>
            <div class="col-md-2 col-sm-2">
                    <span><strong>Price</strong></span>
                </div>
    </div>
                    @foreach($project->applications as $application)
                    @if ($application->accepted != '0')
                    <div class="row application">
                <div class="col-md-12 col-sm-12">
                    
                    <div class="row">
                        <div class="col-md-2 col-sm-2">
                               
                            <span><a href="/profiles/{{$application->user->id}}"><strong>{{$application->user->name}}</strong></a></span><br>

                            <span>Reputation: {{$application->user->rep}}</span><br>
                            @if ($application->user->country != null)
                            <span>{{$application->user->country}}</span><br>
                            @endif
                        </div>
                        @if($application->user->company_name != null)
                        <div class="col-md-2 col-sm-2">
                            
                            <span>Name: {{$application->user->company_name}}</span><br>
                            <span>VAT: {{$application->user->company_vat}}</span>
                        </div>
                        <div class="col-md-2 col-sm-2">
                            @else
                            <div class="col-md-4 col-sm-4">
                                @endif
                                <a class="motivation">Read motivation...</a>
                                <div class="popup-container hidden">
                                    <div class="popup">
                                    {!!$application->motivation!!}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-1 col-sm-1">
                            <span>{{$application->price}}</span>
                        </div>
                        <div class="col-md-5 col-sm-5">
                        <div class="row">
                            <div class="col-md-6 col-sm-6">
                                  
                                <a href="/storage/cv/{{$application->user->cv}}" class="btn btn-primary">Download CV</a>
                            </div>
                                <div class="col-md-6 col-sm-6">
                                <a href="/chat/{{$application->user->id}}" class="btn btn-primary">Send a message</a>
                            </div>
                        </div>
                            <div class="row">
                                    <div class="col-md-6 col-sm-6">
                                        </div>
                                        @if($application->accepted != '1')
                                    <div class="col-md-3 col-sm-3">
                                    {!!Form::open(['action' => ['ApplicationController@update', $application->id], 'method' => 'POST', 'class' => 'pull-right'])!!}
                                    {{ Form::hidden('accepted', 1) }}
                                    {{Form::hidden('_method', 'PUT')}}
                                    {{Form::submit('Accept', ['class' => 'btn btn-success'])}}
                                    {!!Form::close()!!}
                                </div>
                                    <div class="col-md-3 col-sm-3">
                                    {!!Form::open(['action' => ['ApplicationController@update', $application->id], 'method' => 'POST'])!!}
                                    {{ Form::hidden('accepted', -1) }}
                                    {{Form::hidden('_method', 'PUT')}}
                                    {{Form::submit('Decline', ['class' => 'btn btn-danger'])}}
                                    {!!Form::close()!!}
                                </div>
                                @else 
                                <div class="col-md-6 col-sm-6">
                                    <div class="positive-text">Accepted</div>
                                    </div>
                                @endif
                            </div>
                            </div>
                            </div>
                            

                            
                                
                      

                            
                        </div>
                        
                    </div>
                @endif
                    @endforeach
                </div>
                @endif
                @endif
            
        </div>
    </div>
        @endforeach
        @else
        <p>No projects found</p>
        @endif
    </div>
    @endsection
