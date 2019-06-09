@extends('layouts.app')
@section('content')

@include('inc.browseLinks')

<div class="row browse">
    <div class="col-md-10 post-list">

       
            
        <div id="Posts" class="tabcontent">
            
    
                        <table class="table table-bordered">
                            <tr>
                                <th>@sortablelink('title')</th>
                                <th>@sortablelink('created_at', 'Created at')</th>
                                <th>@sortablelink('top_category_id', 'Category')</th>
                                <th>@sortablelink('rep')</th>
                            </tr>
                            @if($posts->count())
                                @foreach($posts as $key => $post)
                                    <tr onclick="window.location='posts/{{ $post->id }}';" class="tr-link @foreach($post->programming_languages as $p_language) {{$p_language->cName}}@endforeach">
                                        <td>{{ $post->title }}<br>
                                            @include('inc.pLangTags')
                                        </td>
                                        <td>{{ $post->created_at->format('Y-m-d') }}</td>
                                        <td>{{ $post->top_category->name }}</td>
                                        <td class="text-center"><span class="post-rep @if($post->rep < 0)negative @endif">{{$post->rep}}</span></td>
                                    </tr>
                                @endforeach
                            @endif
                        </table>
                        {!! $posts->appends(\Request::except('page'))->render() !!}
                

            </div>
        </div>

        <div class="col-md-2 p-lang-sort">
            @include('inc.pLangSelect')        
        </div>

    </div>

@endsection