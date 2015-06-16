@if (count($errors) > 0)
	<div class="alert alert-danger alert-important" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <strong>Foutieve invoer!</strong>
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