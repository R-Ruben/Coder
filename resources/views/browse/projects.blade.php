@extends('layouts.app')
@section('content')

@include('inc.browseLinks')

<div class="row browse">
    <div class="col-md-10 project-list">



        <div id="projects" class="tabcontent">


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
                <tr onclick="window.location='projects/{{ $project->id }}';" class="tr-link @foreach($project->programming_languages as $p_language) {{$p_language->cName}}@endforeach">
                    <td>{{ $project->title }}<br>

                        @foreach($project->programming_languages as $p_language)
                        @if($p_language->name != 'Other')
                        <div class="p-language-tag">{{$p_language->name}}</div>
                        @endif
                        @endforeach

                    </td>
                    <td>{{ $project->created_at->format('Y-m-d') }}</td>
                    <td>{{ $project->deadline }}</td>
                    @if($project->price != null)
                    <td>{{ $project->price }}</td>
                    @else 
                    <td>TBD</td>
                    @endif
                    <td>{{ $project->price_type }}</td>
                </tr>
                @endforeach
                @endif
            </table>
            {!! $projects->appends(\Request::except('page'))->render() !!}


        </div>
    </div>

    <div class="col-md-2 p-lang-sort">
        @include('inc.pLangSelect')
    </div>

</div>

@endsection
