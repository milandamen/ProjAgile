@extends('app')

@section('title')
	Placeholder News Create Title
@stop

@section('description')
	Placeholder News Create Description
@stop

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
			{!! Form::model($newsItem, ['method' => 'PUT', 'files' => true, 'onsubmit' => 'validate()']) !!}
				@include('news.partials._createEdit', ['submitButton' => 'Opslaan'])
			{!! Form::close() !!}
		</div>
	</div>
@stop

@section('additional_scripts')
	{!! HTML::script('custom/js/news.js') !!}

	{!! HTML::script('summernote/js/summernote.js') !!}
	{!! HTML::script('custom/js/summernoteFunctions.js') !!}

	{!! HTML::script('moment/moment.js') !!}
	{!! HTML::script('moment/locale/nl.js') !!}
	{!! HTML::script('bootstrap/js/bootstrap-datetimepicker.js') !!}
	{!! HTML::script('custom/js/datepicker.js') !!}
@stop