@extends('layouts.app')

@section('content')

@include('inc.post')

@guest

@include('inc.login')

@endguest

<div id="posts">
    <h1>Posts</h1>


    <input type="checkbox" class="toggle_questions" onchange="toggleCategories()" checked>
    Questions
    <input type="checkbox" class="toggle_projects" onchange="toggleCategories()" checked>
    Projects
    <input type="checkbox" class="toggle_misc" onchange="toggleCategories()" checked>
    Miscellaneous

    @if(count($posts) > 0)
    @foreach($posts as $post)

    @include('inc.postDisplay')
    
    @endforeach
    @else
    <p>No posts found</p>
    @endif
</div>
@endsection
