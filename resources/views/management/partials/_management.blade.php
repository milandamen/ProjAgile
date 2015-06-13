<div class="col-md-3">
	<h3>Beheer</h3>
	<div class="btn-group-vertical">
		{!! link_to_route('news.manage', 'Nieuws', [], ['class' => 'btn btn-default']) !!}
		{!! link_to_route('postal.index', 'Postcodes ', [], ['class' => 'btn btn-default']) !!}
		{!! link_to_route('district.manage', 'Deelwijken ', [], ['class' => 'btn btn-default']) !!}
		{!! link_to_route('page.index', 'Pagina\'s', [], ['class' => 'btn btn-default']) !!}
	</div>
</div>
