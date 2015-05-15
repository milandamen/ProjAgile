<!-- Header Carousel --> 
<div id="mod-carousel">
	<div id="mod-carousel-images">
		@foreach ($carousel as $item)
			<a href="{{ route('news.show', $item->news->newsId) }}">
				<img src="{{ asset('uploads/img/carousel/' . $item->imagePath) }}" alt="De afbeelding kan niet geladen worden.." />
				<h3>{{ $item->news->title }}</h3>
			</a>
		@endforeach
	</div>
	<div id="mod-carousel-description">
		@foreach ($carousel as $item)
			<div>
				<span>{{ $item->description }}</span>
			</div>
		@endforeach
	</div>
	<div id="mod-carousel-linklist">
		@foreach ($carousel as $item)
			<div onclick="goToSlide(this)">
			</div>
		@endforeach
	</div>
</div>