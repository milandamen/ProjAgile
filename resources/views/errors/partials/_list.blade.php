@if (count($errors) > 0)
	<div class="alert alert-danger">
		<strong>Sorry!</strong>
		Er waren wat problemen met de ingevulde gegevens.
		<br><br>
		<ul>
			@foreach ($errors->all() as $error)
				<li>{{ $error }}</li>
			@endforeach
		</ul>
	</div>
@endif