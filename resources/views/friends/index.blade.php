@extends('layouts.app')

@section('content')

<div id="friends">
        <div class="row">      
            
            <div class="col-md-6">
    <h2>Friends</h2>
    @foreach($friends as $friend)
    <div class="card card-body post-wrapper bg-med">
        <div class="row">
            <div class="col-md-2 col-sm-2" style="padding-right:0px;margin-top:3px;">
                <img class="profile-picture" style="width:100%"
                    src="../storage/profile-pictures/{{$friend->profile_picture}}">
            </div>
            <div class="col-md-5 col-sm-5">
                    <span><a href="/profiles/{{$friend->id}}"><strong>{{$friend->name}}</strong></a></span><br>
                    <span>Reputation: {{$friend->rep}}</span><br>
                    @if ($friend->country != null)
                    <span>{{$friend->country}}</span><br>
                    @endif
                </div>
            @if($friend->company_name != null)
                        <div class="col-md-5 col-sm-5">
                            <span><strong>Company information</strong></span><br>
                            <span>Name: {{$friend->company_name}}</span><br>
                            <span>VAT: {{$friend->company_vat}}</span>
                        </div>
                        <div class="col-md-2 col-sm-2">
                            @else
                            <div class="col-md-4 col-sm-4">
                                @endif
                                
                            </div>
            </div>
        </div>
   

 

    @endforeach
</div>


<div class="col-md-6">
    <h2>Friend requests</h2>

    @foreach($friendRequests as $friendRequest)
    <div class="card card-body post-wrapper bg-med">
        <div class="row">
                
            <div class="col-md-2 col-sm-2" style="padding-right:0px;margin-top:3px;">
                <img class="profile-picture" style="width:100%"
                    src="../storage/profile-pictures/{{$friendRequest->profile_picture}}">
            </div>
            <div class="col-md-3 col-sm-3">
                    <span><a href="/profiles/{{$friendRequest->id}}"><strong>{{$friendRequest->name}}</strong></a></span><br>
                    <span>Reputation: {{$friendRequest->rep}}</span><br>
                    @if ($friendRequest->country != null)
                    <span>{{$friendRequest->country}}</span><br>
                    @endif
                </div>
            @if($friendRequest->company_name != null)
                        <div class="col-md-4 col-sm-4">
                            <span><strong>Company information</strong></span><br>
                            <span>Name: {{$friendRequest->company_name}}</span><br>
                            <span>VAT: {{$friendRequest->company_vat}}</span>
                        </div>
                        <div class="col-md-2 col-sm-2">
                            @else
                            <div class="col-md-3 col-sm-3">
                                @endif
                            <friend-controls :user="{{auth()->user()}}" :correspondent="{{$friendRequest}}"></friend-controls>    
                            </div>
            </div>
        </div>

    @endforeach
</div>

    
@endsection
