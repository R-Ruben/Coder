@extends('layouts.app')

@section('content')

<chats :user="{{auth()->user()}}" :correspondent="{{$correspondent}}" :friends="{{$friends}}"></chats>

@endsection
