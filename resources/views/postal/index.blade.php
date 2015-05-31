@extends('app')

@section('content')
    <div class="container">
        <div class="row">
            {!! Breadcrumbs::render('postal.edit') !!}
        </div>

        <div class="row">
            <div class="col-md-8">
                <h1>Postcodes beheren </h1>
                <p >
                    Op deze pagina kunnen postcodes toegewezen worden aan de deelwijken.
                </p><br/>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                {!! Form::open() !!}
                    <div class="form-group">
                        {!! Form::label('Districtsections', 'Selecteer een deelwijk') !!}<br/>
                        {!! Form::select('Districtsections') !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('PostalCodes', 'Postcodes') !!}<br/>
                        {!! Form::textarea('PostalCodes') !!}
                    </div>
                    <div class="form-group">
                        {!! Form::submit('Voeg toe aan deelwijk', ['class' => 'btn btn-default']) !!}
                    </div>
                {!! Form::close() !!}
            </div>
            <div class="col-lg-6">
                {!! Form::open() !!}

                <div class="form-group">
                    {!! Form::label('PostalCodes', 'Zoek een postcode') !!}<br/>
                    {!! Form::Select('PostalCodes') !!}
                </div>
                <div class="form-group">
                    {!! Form::submit('Verwijder postcode', ['class' => 'btn btn-default']) !!}
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection

@section('additional_scripts')
    <!-- JavaScript file that handles removing and adding of rows and posting of the data form -->
    {!! HTML::script('custom/js/carouselUpdate.js') !!}
@endsection