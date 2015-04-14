@foreach ($items as $item)
	<li>
		@if(isset($item['sub']))
			<a href="#" class="trigger right-caret">{{ url($main['main']->name) }}</a>
			
			<ul class="dropdown-menu sub-menu">
				@include('partials.menu._subMenuItem', ['items' => $item['sub'],'main' => $item])
			</ul>
		@else
			<a href="{{ url($item['main']->relativeUrl) }}">{{ $item['main']->name }}</a>
		@endif
	</li>
@endforeach