@extends('layouts.app')
@section('content')



<div class="card bg-med">
    <div class="card-header">
        <span>Create project</span>
    </div>
    <div class="card-body container">

        {!! Form::open(['action' => ['ProjectController@store'], 'method' => 'POST', 'enctype' =>
        'multipart/form-data']) !!}
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label>Project title:</label>
                    {{Form::text('project-title', '', ['class' => 'form-control'])}}
                </div>
                <div class="form-group">
                    <label>Project description:</label>
                    {{Form::textarea('project-description', '', ['id' => 'post-editor', 'class' => 'form-control', 'placeholder' => ''])}}
                </div>
                <div class="row">
                <div class="form-group col-md-4">
                    <label>Payment type: &nbsp;</label>
                    <select name="payment-type" onchange="togglePrice()">
                        <option value="open">Open negotiation</option>
                        <option value="fixed">Fixed</option>
                    </select>
                    
                    <div id="payment-price" class="hidden">
                            <br>
                        <label>Payment:</label>
                        {{Form::number('payment-price', '', ['class' => 'form-control'])}}
                    </div>
                </div>
            
                
                
                    <div class="col-md-8">
                    <label>Programming languages:</label>
                                @foreach($pLanguages->chunk(3) as $chunk)
                                <div class="row">
                                    @foreach($chunk as $pLanguage)
                                    <div class="col-md-4">
                                    {{Form::checkbox($pLanguage->cName)}}
                                    <label>{{$pLanguage->name}}</label>
                                    </div>
                                    @endforeach
                                </div>
                                @endforeach
                            </div>
                
            </div>
            <div class="row">
            <div class="form-group col-md-4">
                    <label>Deadline:</label>
                    {{Form::date('deadline', '', ['class' => 'form-control', 'placeholder' => ''])}}
                </div>
            </div>
            {{-- <div class="row">
                    <div class="form-group col-md-4">
            @foreach($pLanguages as $pLanguage)
        <div>
                {{Form::checkbox($pLanguage->cName)}}
            <label>{{$pLanguage->name}}</label>
        </div>
        @endforeach
    </div>
</div> --}}
            </div>
        </div>

        {{Form::hidden('_method','PUT')}}
        {{Form::submit('Submit', ['class'=>'btn btn-primary'])}}
        {!! Form::close() !!}
    </div>

</div>


@endsection
