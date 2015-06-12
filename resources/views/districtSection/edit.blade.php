@extends('app')

@section('title')
	De Bunders - Deelwijk toevoegen
@stop

@section('description')
	Dit is de beveiligde deelwijk toevoeg pagina van De Bunders.
@stop

@section('content')
	<div class="container">
		<div class="row">
			/breadcrumbs
		</div>
		<div class="row">
			<div class="col-md-8">
				<h1>Deelwijk toevoegen</h1>
				<p> 
					Hieronder kunt u alle benodige informatie aan een deelwijk toevoegen. De naam en de algemene informatie over de deelwijk.	</p>
			</div>
		</div>
		<div class="row">
			@include('flash::message')
		</div>
		<div class="row">
			<div class="col-md-12">
				
				@include('errors.partials._list')
				{!! Form::model($district, ['method' => 'POST', 'onsubmit' => 'newOnSiteValidate();'])!!}
					{!! Form::hidden('districtId', $district->districtSectionId) !!}
					<div class="row col-md-8">
						<div class="form-group">
						{!! Form::label('name', 'Naam Deelwijk', ['class' => 'label-form'])!!}
						{!! Form::text('name', old('name'), ['class' => 'form-control', 'placeholder' => 'Naam deelwijk']) !!}
						</div>
					</div>
					
					<div class="row col-md-8">
						<div class="form-group">
							{!! Form::label('text', 'Informatie', ['class' => 'label-form']) !!}
							{!! Form::textarea('text', $district->generalInfo, ['placeholder' => 'Informatie over de deelwijk', 'class' => 'form-control', 'id' => 'summernote', 'rows' => '6']) !!}
						</div>
					</div>
					<!--new on site-->
					<div class="row">
						<div class="form-group col-md-12" id="newOnSiteGroupPage">
							{!! Form::label('newOnSite', 'Tonen op nieuw op de site?', ['class' => 'label-form']) !!}<br/>
							<div class="btn-group" data-toggle="buttons">
								<label class="btn btn-default">
									<input type="radio" class="newOnSite" name="newOnSite" value="true">Ja
								</label>
								<label class="btn btn-default active">
									<input type="radio" class="newOnSite" name="newOnSite" value="false" checked="true">Nee
								</label>
							</div>
						</div>
					</div>
					<div class="row col-md-8">
						<div class="form-group">
							{!! HTML::linkRoute('management.index', 'Annuleren', [], ['class' => 'btn btn-danger']) !!}
							{!! Form::submit('Opslaan', ['class' => 'btn btn-success'])!!}
						</div>
					</div>
				{!! Form::close() !!}
			</div>
		</div>
	</div>
@stop

@section('additional_scripts')
	{!! HTML::script('summernote/js/summernote.js') !!}
	{!! HTML::script('custom/js/summernoteFunctions.js') !!}
	{!! HTML::script('custom/js/validateNewOnSite.js') !!}
	{!! HTML::script('custom/js/flash_message.js') !!}
@stop