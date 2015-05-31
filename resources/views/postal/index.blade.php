@extends('app')

@section('title')
    De Bunders - Postcodes beheren
@stop

@section('description')
    De is de beveiligde postcodebeheerpagina van De Bunders.
@stop

@section('content')
    <div class="container">
        <div class="row">
            {{--{!! Breadcrumbs::render('news.edit', (object)['id' => $newsItem->newsId, 'title' => $newsItem->title]) !!}--}}
            {!! Breadcrumbs::render('postal.index') !!}
            {!! Form::open(array('route' => 'postal.upload', 'files' => 'true')) !!}

                {!! Form::file('Excel') !!}
                {!! Form::submit('Bevestig') !!}

            {!! Form::close() !!}


        </div>

    </div>
@stop

@section('additional_scripts')
@stop