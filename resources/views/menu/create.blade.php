@extends('app')

@section('title')
	De Bunders - Menu Aanmaken
@stop

@section('description')
	Dit is de beveiligde menu item aanmaak pagina van De Bunders.
@stop

@section('content')
	<div class="container">
		<div class="row">
			{!! Breadcrumbs::render('menu.create') !!}
		</div>
		<div class="col-lg-12">
			<h2 class="page-header">Menu Item Aanmaken</h2>
			<div class="row">
				@include('flash::message')
			</div>
			@include('errors.partials._list')
			<div class="col-md-4 col-xs-offset-4">
				{!! Form::model($menuItem, ['id' => 'menuItemForm', 'method' => 'PUT']) !!}
					@include('menu.partials._createEdit')
				{!! Form::close() !!}
			</div>
		</div>
	</div>
	<script>
		var autocompleteURL = "{!! route('autocomplete.autocomplete') !!}";
	</script>
@stop

@section('additional_scripts')
	{!! HTML::script('custom/js/autocomplete.js') !!}
	{!! HTML::script('custom/js/flash_message.js') !!}
@stop