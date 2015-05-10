@extends('app')

@section('content')
    <div class="container">
        <div class="row">
            {!! Breadcrumbs::render('editMenuItem') !!}
        </div>
        <div class="col-lg-12">
            <h2 class="page-header">Menu Item Wijzigen</h2>
                @include('errors.partials._list')
                <div class="col-md-4 col-xs-offset-4">
                {!! Form::open (['id' => 'menuItemForm','method' => 'PATCH']) !!}
                {!! Form::hidden('id', $MenuItem->menuId, ['class' => 'menuGroupItem' ]) !!}
                <p>
					{!! Form::label('itemname', 'Naam', ['class' => 'label-form'])!!}
					{!! Form::text('name', $MenuItem->name, ['placeholder' => 'Naam', 'class' => 'form-control']) !!}
				</p>
                <p>
					{!! Form::label('itemlink', 'Link', ['class' => 'label-form'])!!}
					{!! Form::text('link', $MenuItem->link, ['placeholder' => 'Link', 'class' => 'form-control autocomplete']) !!}
				</p>
                <p>
					{!! Form::label('itemvisible', 'Zichtbaar', ['class' => 'label-form'])!!}
					
					@if($MenuItem->publish == 1)
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
@endsection