<div class="panel panel-default dragdiv">								<!-- The dragdiv class is used in /Home/editlayout -->
	<input class="hiddenInput" type="text" name="module-news"/>		<!-- This input gets sent in /Home/editlayout -->
	<div class="panel-heading">
		<h4> 
			Nieuws
			@if(Auth::check() && (Auth::user()->usergroup->name === 'Administrator' || Auth::user()->usergroup->name === 'Content Beheerder'))
				<a href="{{ route('news.create') }}" class="right">
					<i class="fa fa-plus"></i>
				</a> 
			@endif
		</h4>
	</div>
	<div class="panel-body">
		@foreach ($news as $newsItem)
			@if (!$newsItem->hidden)
				<a href="{{ route('news.show', [$newsItem->newsId]) }}">
					<span class="glyphicon glyphicon-new-window" aria-hidden="true"></span>
					{{ $newsItem->normalDate() }} - {{ $newsItem->title }}
				</a>
				</br>
			@endif
		@endforeach
		<p class="goback">
			<a href="{{ route('news.index') }}">Toon alles</a> 
		</p>
	</div>
</div>