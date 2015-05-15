<div class="col-md-3">
	<h3>Nieuws</h3>
	<div class="btn-group-vertical">
		{!! link_to_route('news.index', 'Nieuws Overzicht', [], ['class' => 'btn btn-default']) !!}
		{!! link_to_route('news.manage', 'Nieuws Beheer', [], ['class' => 'btn btn-default']) !!}
		{!! link_to_route('news.create', 'Nieuws Toevoegen', [], ['class' => 'btn btn-default']) !!}
	</div>
</div>