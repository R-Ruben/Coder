@extends('layouts.app')
@section('content')



<div id="profile" class="card bg-med">
    <div class="card-header">
        <span>Edit profile</span>
    </div>
    <div class="card-body container">

        {!! Form::open(['action' => ['ProfileController@update', $user->id], 'method' => 'POST', 'enctype' =>
        'multipart/form-data']) !!}
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <img class="profile-picture" src="/storage/profile-pictures/{{$user->profile_picture}}">
                    <a class="btn btn-primary upload-replace">Upload profile picture</a>
                    {{Form::file('profile_picture', ['class' => 'hidden'])}}
                </div>
            </div>
            <div class="col-md-8">
                <h4>Personal information</h4>
                <div class="form-group">
                    <label>Name: <span class="secondary-text">*</span></label>
                    {{Form::text('name', $user->name, ['class' => 'form-control'])}}
                </div>
                <div class="form-group">
                    <label>E-mail: <span class="secondary-text">*</span></label>
                    {{Form::text('email', $user->email, ['class' => 'form-control'])}}
                </div>
                <div class="form-group">
                    <label>Birth date:</label>
                    {{Form::date('birthDate', $user->birthDate, ['class' => 'form-control', 'placeholder' => ''])}}
                </div>
                <div class="form-group">
                    <label>Country:</label>
                    @include('inc.countries', ['default' => $user->country])
                </div>

                <div class="form-group">
                    <label>Website:</label>
                    {{Form::text('website', $user->website, ['class' => 'form-control', 'placeholder' => 'http://www.example.com'])}}
                </div>
                <br>
                <h4>Application information</h4>
                <div class="row">
                        <div class="form-group col-md-7">
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
                    <div class="form-group col-md-5">
                        <a class="btn btn-primary upload-replace">Upload CV</a>
                        {{Form::file('cv', ['accept' => '.doc, .docx, .pdf', 'class' => 'hidden'])}}<br>
                        <small>Only accepts PDF and Word files (.pdf, .doc, .docx) up to 2MB</small>
                    </div>
                    
                </div>

            </div>

        </div>
        <br>
        <div class="row">
            <div class="col-md-4 col-sm-4">
                <div class="form-group">
                    <img class="company-logo" src="/storage/company-logos/{{$user->company_logo}}">
                    <a class="btn btn-primary upload-replace">Upload company logo</a>
                    {{Form::file('company_logo', ['class' => 'hidden'])}}
                </div>
            </div>
            <div class="col-md-8 col-sm-8">
                <h4>Company information</h4>
                <div class="form-group">
                    <label>Company name:</label>
                    {{Form::text('company_name', '', ['class' => 'form-control', 'placeholder' => ''])}}
                </div>
                <div class="form-group">
                    <label>VAT identification number:</label>
                    {{Form::text('company_vat', '', ['class' => 'form-control', 'placeholder' => ''])}}
                </div>

                {{Form::hidden('_method','PUT')}}
                {{Form::submit('Submit', ['class'=>'btn btn-primary pull-right'])}}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>


@endsection
