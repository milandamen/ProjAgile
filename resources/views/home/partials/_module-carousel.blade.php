<!-- Header Carousel --> 
<div id="mod-carousel">
	<div id="mod-carousel-images">
		@foreach ($carousel as $item)
			@if(isset($item->news))
				<a href="{{ route('news.show', $item->news->newsId) }}">
					<img src="{{ asset('uploads/img/carousel/' . $item->imagePath) }}" alt="De afbeelding kan niet geladen worden.." />
					<h3>{{ $item->news->title }}</h3>
				</a>
			@elseif(isset($item->page))
				<a href="{{ route('page.show', $item->page->pageId) }}">
					<img src="{{ asset('uploads/img/carousel/' . $item->imagePath) }}" alt="De afbeelding kan niet geladen worden.." />
					<h3>{{ $item->page->introduction->title }}</h3>
				</a>
			@else
				<a href="#">
					<img src="{{ asset('uploads/img/carousel/' . $item->imagePath) }}" alt="De afbeelding kan niet geladen worden.." />
					 <h3>{{-- $item->title --}} &nbsp;</h3> 
				</a>
			@endif
		@endforeach
	</div>
	<div id="mod-carousel-description">
		@foreach ($carousel as $item)
			<div>
				@if(isset($item->news))
				<a href="{{ route('news.show', $item->news->newsId) }}">
				@elseif(isset($item->page))
				<a href="{{ route('page.show', $item->page->pageId) }}">
				@endif
					<span>{{ $item->description }}</span>
				</a>
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