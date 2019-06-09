@extends('layouts.app')

@section('content')


@include('inc.browseLinks')

<div class="row">
    <div class="col-md-10 post-list">

       
            
        <div id="Posts" class="tabcontent">
            <h3>Posts</h3>
    
                        <table class="table table-bordered">
                            <tr>
                                <th>@sortablelink('title')</th>
                                <th>@sortablelink('created_at', 'Created at')</th>
                                <th>@sortablelink('top_category_id', 'Category')</th>
                                <th>@sortablelink('rep')</th>
                            </tr>
                            @if($posts->count())
                                @foreach($posts as $key => $post)
                                    <tr class="@foreach($post->programming_languages as $p_language) {{$p_language->cName}}@endforeach">
                                        <td>{{ $post->title }}<br>
                                            @include('inc.pLangTags')
                                        </td>
                                        <td>{{ $post->created_at->format('d-m-Y') }}</td>
                                        <td>{{ $post->top_category->name }}</td>
                                        <td class="text-center"><span class="post-rep @if($post->rep < 0)negative @endif">{{$post->rep}}</span></td>
                                    </tr>
                                @endforeach
                            @endif
                        </table>
                        {!! $posts->appends(\Request::except('page'))->render() !!}
                

            </div>

   

        <div id="Projects" class="tabcontent">
            <h3>Projects</h3>

                <table class="table table-bordered">
                        <tr>
                            <th>@sortablelink('title')</th>
                            <th>@sortablelink('created_at', 'Created at')</th>
                            <th>@sortablelink('deadline')</th>
                            <th>@sortablelink('price')</th>
                            <th>@sortablelink('price_type')</th>
                        </tr>
                        @if($projects->count())
                            @foreach($projects as $key => $project)
                                <tr class="@foreach($project->programming_languages as $p_language) {{$p_language->cName}}@endforeach">
                                    <td>{{ $project->title }}<br>
                                        @include('inc.pLangTags')
                                    </td>
                                    <td>{{ $project->created_at->format('d-m-Y') }}</td>
                                    <td>{{ $project->deadline }}</td>
                                    <td>{{ $project->price }}</td>
                                    <td>{{ $project->price_type }}</td>
                                </tr>
                            @endforeach
                        @endif
                    </table>
                    {!! $projects->appends(\Request::except('page'))->render() !!}

            {{-- <h3>Projects</h3>
            <div class="row">
                <div class="question-list col-md-12">
                    @if(count($projects) > 0)
                    @foreach($projects as $project)
                    <div
                        class="card card-body post-wrapper bg-med container list-post @foreach($project->programming_languages as $p_language){{$p_language->cName}}@endforeach">
                        <div class="row">
                            <div class="col-md-2 col-sm-2">
                                <span><a
                                        href="/profiles/{{$project->user->id}}"><strong>{{$project->user->name}}</strong></a></span>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <h3><a href="/projects/{{$project->id}}">{{$project->title}}</a></h3>

                                @foreach($project->programming_languages as $p_language)
                                @if($p_language->name != 'Other')
                                <div class="p-language-tag">{{$p_language->name}}</div>
                                @endif
                                @endforeach

                            </div>
                            <div class="col-md-2 col-sm-2">
                                <small>{{$project->created_at}}</small>
                            </div>
                            <div class="col-md-2 col-sm-2">
                                <small>{{$project->deadline}}</small>
                            </div>

                        </div>
                    </div>

                    @endforeach
                    @else
                    <p>No posts found</p>
                    @endif
                </div>



            </div> --}}

        </div>
    </div>


    <div class="col-md-2 p-lang-sort">
        @foreach($pLanguages as $pLanguage)
        <div>
            <input type="checkbox" class="toggle_{{$pLanguage->cName}}"
                onchange="togglePLanguage('{{$pLanguage->cName}}')" checked>
            <label>{{$pLanguage->name}}</label>
        </div>
        @endforeach
        <div>

        </div>
    </div>
</div>
@endsection
