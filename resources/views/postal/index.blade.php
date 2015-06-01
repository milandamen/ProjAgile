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
                <div class="panel panel-primary col-md-4 no-padding" style='margin-top:25px'>
                    <div class="panel-heading">
                        Upload Excel file
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <div>
                                <div class="input-group">
                                    {!! Form::file('Excel') !!}
                                </div>
                            </div>
                        </div>
                        <div class="form-group" style='margin-top:30px; float:right'>
                            {!! Form::submit('Bevestig', ['class' => 'btn btn-success']) !!}
                        </div>
                    </div>
                </div>

            {!! Form::close() !!}


        </div>

    </div>
@stop

@section('additional_scripts')
@stop