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
							@for($i = 0; $i < count($news); $i++)
								<tr>
									<a href="{{ route('news.show', [$news[$i]->newsId]) }}">{{ $news[$i]->title }}</a>
									<br>
									@if($i !== count($pages) -1)
										<div class="addmargin">
											{{ trunc(strip_tags($news[$i]->content), 50) }}
										</div>
									@else
										{{ trunc(strip_tags($news[$i]->content), 50) }}
									@endif
								</tr>
							@endfor
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
							@for($i = 0; $i < count($pages); $i++)
								<tr>
									<a href="{{ route('page.show', [$pages[$i]->pageId]) }}">{{ $pages[$i]->introduction->title }}</a>
									<br>
									@if($i !== count($pages) -1)
										<div class="addmargin">
											{{ trunc(strip_tags($pages[$i]->introduction->text), 50) }}
										</div>
									@else
										{{ trunc(strip_tags($pages[$i]->introduction->text), 50) }}
									@endif
								</tr>
							@endfor
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