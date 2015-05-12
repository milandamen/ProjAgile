@extends('app')

@section('content')
	<div class="container">
		<div class="row">
			{!! Breadcrumbs::render('menu.create') !!}
		</div>
		<div class="col-lg-12">
			<h2 class="page-header">Menu Item Aanmaken</h2>
			@include('errors.partials._list')
			<div class="col-md-4 col-xs-offset-4">
			{!! Form::open (['id' => 'menuItemForm','method' => 'PUT']) !!}
				<p>
					{!! Form::label('itemname', 'Naam', ['class' => 'label-form'])!!}
					{!! Form::text('name', old('Naam'), ['placeholder' => 'Naam', 'class' => 'form-control']) !!}
				</p>
				<p>
					{!! Form::label('itemlink', 'Link', ['class' => 'label-form'])!!}
					{!! Form::text('link', old('Link'), ['placeholder' => 'Link', 'class' => 'form-control autocomplete']) !!}
				</p>
				<p>
					{!! Form::label('itemvisible', 'Zichtbaar', ['class' => 'label-form'])!!}
					<div class="btn-group" data-toggle="buttons">
						<label class="btn btn-default active">
							<input type="radio" name="publish" value="true" checked=true>Ja
						</label>
						<label class="btn btn-default">
							<input type="radio" name="publish" value="false">Nee
						</label>
					</div>
				</p>
				{!! HTML::linkRoute('menu.index', 'Annuleren', [], ['class' => 'btn btn-danger']) !!}
				{!! Form::submit('Opslaan', ['class' => 'btn btn-success white pull-left']) !!}
			{!! Form::close() !!}
			</div>
		</div>
	</div>
	<script>
		var autocompleteURL = "{!! route('autocomplete.autocomplete', '') !!}";
	</script>
@stop

@section('additional_scripts')
	{!! HTML::script('custom/js/autocomplete.js') !!}
@stop