@extends('App')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Nieuws wijzigen</h1>
            </div>
        </div>
        <div class="col-lg-12">
            @include('errors.partials._list')
            {!! Form::model($newsItem, ['method' => 'PATCH', 'files' => true]) !!}
                @include('news.partials._createEdit', ['submitButton' => 'Nieuwsbericht Wijzigen'])
            {!! Form::close() !!}
        </div>
    </div>
@stop