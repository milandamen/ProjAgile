<div class="panel panel-default">
	<div class="panel-heading">
		{{ $title }}
	</div>
	<div class="panel-body">
		@foreach($categories as $category)
			<div class="form-group">
				<div class="col-md-8">
					{{ $category }}
				</div>
			</div>
		@endforeach
	</div>
</div>