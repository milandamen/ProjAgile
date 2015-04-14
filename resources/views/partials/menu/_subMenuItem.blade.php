@foreach ($items as $item)
	<li>
		@if(isset($item['sub']))
			<!-- <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{!! $main['main']->name !!} <span class="caret"></span></a> -->
			<a href="#" class="trigger right-caret">{!! $main['main']->name !!}</a>
			
			<ul class="dropdown-menu sub-menu">
				@include('partials.menu._subMenuItem', ['items' => $item['sub'],'main' => $item])
			</ul>
		@else
			<a href="{!! $item['main']->relativeUrl !!}">{!! $item['main']->name !!}</a>
		@endif
	</li>
@endforeach