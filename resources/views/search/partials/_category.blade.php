<div class="panel panel-default">
	<div class="panel-heading">
		{{ $categoryTitle }}
	</div>
	<div class="panel-body">
		@foreach($categories as $category)
			<div class="form-group">
				{!! link_to_route({{ $category }}'.show', 'test', []) !!}
				<div class="col-md-8">
					{{ $category }}
				</div>
			</div>
		@endforeach
	</div>
</div>