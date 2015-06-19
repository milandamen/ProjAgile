@extends('app')

@section('title')
	De Bunders - Nieuws Aanmaken
@stop

@section('description')
	De is de beveiligde nieuws aanmaak pagina van De Bunders.
@stop

@section('content')
	<div class="container">
		<div class="row">
			{!! Breadcrumbs::render('news.create') !!}
		</div>
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Nieuws Aanmaken</h1>
			</div>
		</div>
		<div class="row">
			@include('flash::message')
		</div>
		<div class="col-lg-12">
			@include('errors.partials._list')
			{!! Form::model($newsItem, ['method' => 'PUT', 'files' => true, 'onsubmit' => 'return validateNews()']) !!}
				@include('news.partials._createEdit')
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
	{!! HTML::script('custom/js/flash_message.js') !!}
@stop