@foreach ($items as $item)
	<li>
		@if(isset($item['sub']))
			<a class="trigger right-caret">{{ $main['main']->name }}</a>
			
			<ul class="dropdown-menu sub-menu">
				@include('partials.partials._subMenuItem', ['items' => $item['sub'],'main' => $item])
			</ul>
		@else
			<a href="{{ url($item['main']->relativeUrl) }}">{{ $item['main']->name }}</a>
		@endif
	</li>
@endforeach