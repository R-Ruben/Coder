@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
            <div class="card-header">{{$name}}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @include('inc.post')
                    <h3>{{$name}}'s posts</h3>
                    @if(count($posts)>0)
                    <table class="table table-striped">
                    @foreach ($posts as $post)
                    <tr>
                            <td>{{$post->title}}</td>
                            <td>{!!$post->body!!}</td>
                            <td>
                                    @include('inc.postControls')
                            </td>
                        </tr>
                        @endforeach
                    </table>
                    @else
                    <p>No posts found.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
