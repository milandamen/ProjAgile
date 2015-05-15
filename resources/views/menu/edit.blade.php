@extends('app')

@section('title')
	De Bunders - Menu Item Wijzigen
@stop

@section('description')
	Dit is de beveiligde menu item wijzig pagina van De Bunders.
@stop

@section('content')
	<div class="container">
		<div class="row">
			{!! Breadcrumbs::render('menu.edit') !!}
		</div>
		<div class="col-lg-12">
			<h2 class="page-header">Menu Item Wijzigen</h2>
				@include('errors.partials._list')
				<div class="col-md-4 col-xs-offset-4">
				{!! Form::open (['id' => 'menuItemForm','method' => 'PATCH']) !!}
					{!! Form::hidden('id', $menuItem->menuId, ['class' => 'menuGroupItem' ]) !!}
					<p>
						{!! Form::label('itemname', 'Naam', ['class' => 'label-form'])!!}
						{!! Form::text('name', $menuItem->name, ['placeholder' => 'Naam', 'class' => 'form-control']) !!}
					</p>
					<p>
						{!! Form::label('itemlink', 'Link', ['class' => 'label-form'])!!}
						{!! Form::text('link', $menuItem->link, ['placeholder' => 'Link', 'class' => 'form-control autocomplete']) !!}
					</p>
					<p>
						{!! Form::label('itemvisible', 'Zichtbaar', ['class' => 'label-form'])!!}
						@if($menuItem->publish)
							<div class="btn-group" data-toggle="buttons">
								<label class="btn btn-default active">
									<input type="radio" name="publish" value="true" checked=true>Ja
								</label>
								<label class="btn btn-default">
									<input type="radio" name="publish" value="false">Nee
								</label>
							</div>
						@else
							<div class="btn-group" data-toggle="buttons">
								<label class="btn btn-default">
									<input type="radio" name="publish" value="true">Ja
								</label>
								<label class="btn btn-default active">
									<input type="radio" name="publish" value="false" checked=true>Nee
								</label>
							</div>
						@endif
					</p>
					{!! link_to_route('menu.index', 'Annuleren', [], ['class' => 'btn btn-danger']) !!}
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