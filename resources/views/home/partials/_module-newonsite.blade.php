<div class="panel panel-default dragdiv">								{{-- The dragdiv class is used in /Home/editlayout --}}
	<input class="hiddenInput" type="text" name="module-newonsite"/>	{{-- This input gets sent in /Home/editlayout --}}
	<div class="panel-heading">
		<h4>Nieuw op de site</h4>
	</div>
	<div class="panel-body">
		<ul>
			@foreach($newOnSite as $newOnSiteItem)
				@if($newOnSiteItem->link != null)
					<li class="sidebar">
						{{ $newOnSiteItem->dateOnly() }} - 
						<a href="{!! url($newOnSiteItem->link) !!}">
							{{ $newOnSiteItem->message }}
						</a>
					</li>
				@else
					<li class="sidebar">
						{{ $newOnSiteItem->dateOnly() }} - {{ $newOnSiteItem->message }}
					</li>
				@endif
			@endforeach
		</ul>
		<p class="showMore">
			<a href="{{ route('newOnSite.index') }}">Toon alles</a>
		</p>
	</div>
</div>