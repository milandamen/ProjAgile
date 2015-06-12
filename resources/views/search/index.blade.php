@extends('app')

@section('title')
	De Bunders Zoeken - {{ $query ? : '' }}
@stop

@section('description')
	Dit is de zoekopdracht resultaten scherm van De Bunders.
@stop

@section('content')
	<div class="container">
		<div class="row">
			{!! Breadcrumbs::render('search.index', $query ? : '') !!}
		</div>
		<div class="row">
			<h2 class="page-header">Zoekresultaten</h2>
			@if(count($news))
				<div class="panel panel-default">
					<div class="panel-heading">
						Nieuws Resultaten
					</div>
					<div class="panel-body">
						<table class="table">
							@foreach($news as $newsItem)
								<tr>
									<a href="{{ route('news.show', [$newsItem->newsId]) }}">{{ $newsItem->title }}</a>
								</tr>
								<tr>
									<br>
									{!! trunc( $newsItem->content, 50) !!}
								</tr>
							@endforeach
						</table>
					</div>
				</div>
			@endif
			@if(count($pages))
				<div class="panel panel-default">
					<div class="panel-heading">
						Pagina Resultaten
					</div>
					<div class="panel-body">
						<table class="table">
							@foreach($pages as $page)
								<tr>
									<a href="{{ route('page.show', [$page->pageId]) }}">{{ $page->introduction->title }}</a>
								</tr>
								<tr>
									<br>
									{!! trunc($page->introduction->text, 50) !!}
								</tr>
							@endforeach
						</table>
					</div>
				</div>
			@endif
			@if(!count($news) && !count($pages))
				<div class="panel panel-default">
					<div class="panel-heading">
						Geen Zoekresultaten
					</div>
					<div class="panel-body">
						<div class="form-group">
							<div class="col-md-12">
								Er zijn helaas geen resultaten gevonden op uw zoekopdracht.
							</div>
						</div>
					</div>
				</div>	
			@endif
		</div>
	</div>
@stop