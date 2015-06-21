<div class="col-md-3">
	<h3>Home </h3>
	<div class="btn-group-vertical">
		{!! link_to_route('carousel.edit', 'Carousel Wijzigen', [], ['class' => 'btn btn-default']) !!}
		{!! link_to_route('home.editLayout', 'Layout Wijzigen', [], ['class' => 'btn btn-default']) !!}
		{!! link_to_route('home.editIntroduction', 'Introductie Wijzigen', [], ['class' => 'btn btn-default']) !!}
		{!! link_to_route('sidebar.edit', 'Sidebar Wijzigen', ['id' => '1'], ['class' => 'btn btn-default']) !!}
	</div>
</div>