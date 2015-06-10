@if (count($errors) > 0)
	<div class="alert alert-danger alert-important">
		<strong>Sorry!</strong>
		Er waren wat problemen met de ingevulde gegevens.
		<br><br>
		<ul>
			@foreach ($errors->all() as $error)
				@if($error !== '')
					<li>{{ $error }}</li>
				@endif
			@endforeach
		</ul>
	</div>
@endif