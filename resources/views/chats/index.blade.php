@extends('layouts.app')

@section('content')

<div id="chat" class="row">

          <friend-list :friends="{{$friends}}"></friend-list>

    <div class="col-md-9">
      <div class="card card-default chat">
        <div class="card-body" style="height:500px;overflow-y:scroll">
         
        </div>

        <input type="text"
          name="message"
          placeholder="Choose someone to chat with on the left-hand side"
          class="form-control"
        >
      </div>
    </div>
  </div>

@endsection
