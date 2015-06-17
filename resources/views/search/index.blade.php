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
				<div class="col-md-12">
					<h4>Nieuws Resultaten</h4>
					<p>Hieronder vindt u een overzicht van alle resultaten binnen de nieuws- afdeling van onze website. </p>
					<table class="table">
						<tr>
							<th class="col-md-1"> Datum </th>
							<th class="col-md-1"> Deelwijk </th>
							<th class="col-md-2">Naam</th>
							<th class="col-md-7">Inhoud</th>
							<th class="col-md-1"><i class="fa fa-comment-o fa-lg floatRight"></i>  </th>
						</tr>
						@for($i = 0; $i < count($news); $i++)
							<tr>
								<td>{!!  $news[$i]->normalDate() !!} </td>
								<td> @if(count($news[$i]->districtSections))
									 {!! $news[$i]->districtSections[0]->name !!}
									@if(count($news[$i]->districtSections) > 1)
									,..
									@endif
								@else
									Algemeen
								@endif  
									</td>
								<td><a href="{{ route('news.show', [$news[$i]->newsId]) }}">{{ $news[$i]->title }}</a></td>
								<td>
									{{ trunc(strip_tags($news[$i]->content), 50) }}
								</td>
								<td>
									<span class="floatRight">{!! count($news[$i]->newsComments) !!} </span>
								</td>
								<td><a href="{{ route('news.show', [$news[$i]->newsId]) }}"> 
										<span class="glyphicon glyphicon-new-window" aria-hidden="true"></span>
									</a> 
								</td>
							</tr>
						@endfor
					</table>
				</div>
			@endif
			@if(count($pages))
				<div class="col-md-12">
					<h4>	Pagina Resultaten</h4>
					<p>Hieronder vindt u een overzicht van alle resultaten binnen de pagina-afdeling van onze website. </p>
						
					<table class="table">
						<tr>
							<th class="col-md-1"> Deelwijk </th>
							<th class="col-md-2">Naam</th>
							<th class="col-md-7">Inhoud</th>
						</tr>
						@for($i = 0; $i < count($pages); $i++)
							<tr>
								<td>
									 @if(count($pages[$i]->districtSections))
									 {!! $pages[$i]->districtSections[0]->name !!}
									@if(count($pages[$i]->districtSections) > 1)
										,..
										@endif
									@else
										Algemeen
									@endif 
								</td>
								<td>
									<a href="{{ route('page.show', [$pages[$i]->pageId]) }}">{{ $pages[$i]->introduction->title }}</a>
								</td>
								<td>
									{{ trunc(strip_tags($pages[$i]->introduction->text), 50) }}
								</td>
								<td></td>
							</tr>
						@endfor
					</table>
				</div>
			@endif
			@if(!count($news) && !count($pages))
				<div class="row">
					<div class="col-md-12">
						<h4> Geen Zoekresultaten </h4>
						<p>Er zijn helaas geen resultaten gevonden op uw zoekopdracht.</p>
					</div>
				</div>
				
			@endif
		</div>
	</div>
@stop