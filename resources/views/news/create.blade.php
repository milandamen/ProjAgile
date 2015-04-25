@extends('app')

@section('content')
    <div class="container">
        <div class="row">
            {!! Breadcrumbs::render('addnews') !!}
        </div>
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Nieuws Aanmaken</h1>
            </div>
        </div>
        <div class="col-lg-12">
            @include('errors.partials._list')
            {!! Form::model($newsItem, ['method' => 'PUT', 'files' => true]) !!}
                @include('news.partials._createEdit', ['submitButton' => 'Nieuwsbericht Aanmaken'])
            {!! Form::close() !!}
        </div>
    </div>

@stop