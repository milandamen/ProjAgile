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
		<label class="btn btn-default {{ $menuItem->publish ? 'active' : '' }}">
			<input type="radio" name="publish" value="true" {{ $menuItem->publish ? 'checked="true"' : '' }}>Ja
		</label>
		<label class="btn btn-default {{ !$menuItem->publish ? 'active' : '' }}">
			<input type="radio" name="publish" value="false" {{ !$menuItem->publish ? 'checked="true"' : '' }}>Nee
		</label>
	</div>
</p>
{!! link_to_route('menu.index', 'Annuleren', [], ['class' => 'btn btn-danger']) !!}
{!! Form::submit('Opslaan', ['class' => 'btn btn-success white pull-left']) !!}

@section('additional_scripts')
	{!! HTML::script('custom/js/autocomplete.js') !!}
@stop