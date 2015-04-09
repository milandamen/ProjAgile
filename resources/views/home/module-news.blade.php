<div class="panel panel-default dragdiv">								<!-- The dragdiv class is used in /Home/editlayour -->
	<input class="hiddenInput" type="text" name="module-news" />		<!-- This input gets sent in /Home/editlayout -->
	
	<div class="panel-heading">
		<h4> 
			Nieuws
			
			{{-- TODO --}}
			{{-- Check if user logged in and is an admin or editor --}}
				{{-- <a href="NewsController/create"><i class="fa fa-plus"></i></a> --}}
			{{-- End auth check --}}
		</h4>
	</div>
	<div class="panel-body">
		@foreach ($news as $newsItem)
			@if ($newsItem->hidden == false)
				<a href="NewsController/show/{{ $newsItem->newsId }}">
					<span class="glyphicon glyphicon-new-window" aria-hidden="true"></span>
					{{ $newsItem->normalDate() }} - {{ $newsItem->title }}
				</a>
				</br>
			@endif
		@endforeach
	</div>
</div>