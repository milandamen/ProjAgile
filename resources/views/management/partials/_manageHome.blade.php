<div class="col-md-3">
	<h3>Homepage</h3>
	<div class="btn-group-vertical">
		{!! link_to_route('home.editLayout', 'Home Layout Wijzigen', [], ['class' => 'btn btn-default']) !!}
		{!! link_to_route('carousel.edit', 'Home Carousel Wijzigen', [], ['class' => 'btn btn-default']) !!}
		{!! link_to_route('sidebar.edit', 'Home Sidebar Wijzigen', [], ['class' => 'btn btn-default']) !!}
		{!! link_to_route('home.editIntroduction', 'Home Introduction Wijzigen', [], ['class' => 'btn btn-default']) !!}
	</div>
</div>