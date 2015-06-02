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

            @if(isset($success))
                </br>
                @if($success == 'true')
                    <div class="alert alert-success alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <strong>Success!</strong> Postcodes zijn succesvol opgeslagen in de database!
                    </div>
                @else
                    <div class="alert alert-danger alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <strong>Foutieve invoer!</strong></br>
                        @if(isset($errors))
                            @foreach($errors as $error)
                                {!! $error . '</br>' !!}
                            @endforeach
                        @endif

                    </div>
                @endif
            @endif

            {{--{!! Form::open(array('route' => 'postal.upload', 'files' => 'true')) !!}            --}}
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