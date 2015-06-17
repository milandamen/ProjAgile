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
			{!! Breadcrumbs::render('postal.index') !!}
        </div>
        <div class="row">
            @include('flash::message')
        </div>
        <div class="row">
            @include('errors.partials._list')
        </div>
        <div class="row">
            <div class="panel panel-primary col-md-4 no-padding description">
                <div class="panel-heading">Beschrijving</div>
                <div class="panel-body">
                    <p>
                        <span class="descriptionSpan">Indeling</span><br/>
                        In het Excelbestand dat hieronder te downloaden is, vind u alle gegevens over de postcodes van de deelwijken.
                        Er is per deelwijk een werkblad aangemaakt met daarin de ID's, postcodes, huisnummers en toevoegingen, die bij de desbetreffende deelwijk horen.
                        Het ID is niet invulbaar en is alleen nodig om de koppeling met de database te kunnen leggen.

                        <br/><br/>

                        <span class="descriptionSpan">Postcodes toevoegen</span><br/>
                        Om een nieuwe postcode toe te kunnen voegen, moet u naar het werkblad gaan met als naam de deelwijk waartoe de postcode behoort.
                        Vervolgens scrollt u naar onderen naar een nieuwe regel (een witregel). Hier kunt u nieuwe regels toevoegen.
                        Dit doet u door op zijn minst een postcode en huisnr in te vullen (toevoeging is optioneel).

                        <br/><br/>

                        <span class="descriptionSpan">Postcodes bewerken</span><br/>
                        Om een postcode te kunnen bewerken, moet u naar het werkblad gaan met als naam de deelwijk waartoe de postcode behoort.
                        Vervolgens zoekt u de postcode die u wilt bewerken (ctrl + f). U kunt hier de postcode bewerken door de velden aan te passen.
                        De aan te passen velden zijn: postcode, huisnummer en toevoeging.

                        <br/><br/>

                        <span class="descriptionSpan">Postcodes verwijderen</span><br/>
                        Om een postcode te kunnen verwijderen, moet u naar het werkblad gaan met als naam de deelwijk waartoe de postcode behoort.
                        Vervolgens zoekt u de postcode die u wilt verwijderen (ctrl + f).
                        U kunt hier de postcode verwijderen door op zijn minst de velden postcode en huisnr leeg te maken.
                        Spaties, enters en overige whitespaces worden als leeg beschouwd.

                        <br/><br/>

                        <span class="descriptionSpan">Beveiliging</span><br/>
                        De kolommen B,C en D kunnen worden gewijzigd (Behalve de eerste rij).
                        De andere velden zijn beveiligd tegen bewerken.

                    </p>
                </div>
            </div>
        </div>
        <div class="row">
            {!! Form::open(array('route' => 'postal.download', 'method' => 'GET')) !!}
                <div class="panel panel-primary col-md-4 no-padding download">
                    <div class="panel-heading">Download Excel Bestand</div>
                    <div class="panel-body">
                        <div class="form-group downloadSubmit">
                            {!! Form::submit('Download postcodes', ['class' => 'btn btn-success']) !!}
                        </div>
                    </div>
                </div>
            {!! Form::close() !!}

            {!! Form::open(array('route' => 'postal.upload', 'files' => 'true')) !!}
                <div class="panel panel-primary col-md-4 no-padding upload">
                    <div class="panel-heading">Upload Excel Bestand</div>
                    <div class="panel-body">
                        <div class="form-group">
                            <div>
                                <div class="input-group">
                                    {!! Form::file('excel') !!}
                                </div>
                            </div>
                        </div>
                        <div class="form-group uploadSubmit">
                            {!! Form::submit('Bevestig', ['class' => 'btn btn-success']) !!}
                        </div>
                    </div>
                </div>
            {!! Form::close() !!}

		</div>
	</div>
@stop