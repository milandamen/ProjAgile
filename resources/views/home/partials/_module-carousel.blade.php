<!-- Header Carousel --> 
<div id="mod-carousel" class="mod-carousel">
	<div id="mod-carousel-images" class="mod-carousel-images">
		@foreach ($carousel as $item)
			<a href="{{ route('news.show', $item->news->newsId) }}">
				<img src="{{ asset('uploads/img/carousel/' . $item->imagePath) }}" alt="..." />
				<h3>{{ $item->news->title }}</h3>
			</a>
		@endforeach
	</div>
	<div id="mod-carousel-linklist" class="mod-carousel-linklist">
		@foreach ($carousel as $item)
			<table>
				<tbody>
					<tr>
						<td>
							<span>{{ $item->news->title }}</span>
						</td>
					</tr>
					<tr>
						<td>
							<span>{{ $item->news->content }}</span>
						</td>
					</tr>
				</tbody>
			</table>
		@endforeach
	</div>
</div>