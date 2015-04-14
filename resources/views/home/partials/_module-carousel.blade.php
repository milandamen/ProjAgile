<!-- Header Carousel --> 
<div id="carousel" class="carousel slide" data-ride="carousel">
	<!-- Indicators -->
	<ol class="carousel-indicators">
		@for ($i = 0; $i < count($carousel); $i++)
			@if ($i == 0)
				<li data-target="#carousel" data-slide-to="{{ $i }}" class="active"></li>
			@else
				<li data-target="#carousel" data-slide-to="{{ $i }}"></li>
			@endif
		@endfor
	</ol>
	
	<!-- Wrapper for slides -->
	<div class="carousel-inner">
		{{-- */ $i = 0 /* Counter used to determine if item is first --}}
		
		@foreach ($carousel as $item)
			@if ($i == 0)
				<div class="item active">
					<a href="{{ route('news.show', $item->news->newsId) }}">
						<img src="{{ asset('uploads/img/carousel/' . $item->imagePath) }}" alt="...">
						<div class="carousel-caption">
							<h3>{{ $item->news->title }}</h3>
						</div>
					</a>
				</div>
			@else
				<div class="item">
					<a href="{{ route('news.show', $item->news->newsId) }}">
						<img src="{{ asset('uploads/img/carousel/' . $item->imagePath) }}" alt="...">
						<div class="carousel-caption">
							<h3>{{ $item->news->title }}</h3>
						</div>
					</a>
				</div>
			@endif
			
			{{-- */ $i++ /* Add one to the counter --}}
		@endforeach
	</div>
	
	<!-- Controls -->
	<a class="left carousel-control" href="#carousel" role="button" data-slide="prev">
		<span class="glyphicon glyphicon-chevron-left"></span>
	</a>
	<a class="right carousel-control" href="#carousel" role="button" data-slide="next">
		<span class="glyphicon glyphicon-chevron-right"></span>
	</a>
</div>