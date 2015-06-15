@extends('app')

@section('content')
	 <div class="container">
		<div class="row">
			{!! Breadcrumbs::render('news.index') !!}
		</div>
		<div class="row">
			<div class="col-md-12">
				<h2 class="page-header">
					@if(Auth::check() && Auth::user()->usergroup->name === 'Administrator')
						<a href="{{ route('news.manage')}}"><i class="fa fa-pencil-square-o"></i></a>
					@endif
					Nieuws
				</h2>
			</div>
		</div>
		<div class="row">
			<div class="col-md-8">
			<div class="col-md-12 addmargin">
				<h3> Recent </h3>
				<ul>
					@foreach($news as $newsItem)
						<li>
							<p class="newstitle"><a href="{{ route('news.show', [$newsItem->newsId]) }}">{!! $newsItem->title !!} </a></p>
							<p class="newsdate">{!! $newsItem->normalDate() !!} 
								| <i class="fa fa-user"></i> <b>{!! $newsItem->user->username !!} </b> 
								|@if(count($newsItem->districtSections))
										 {!! $newsItem->districtSections[0]->name !!}
										@if(count($newsItem->districtSections) > 1)
										,..
										@endif
									@else
										Algemeen
									@endif </p>
							 {{--*/ $phrase = trunc($newsItem->content, 30); /*--}}
							<p class="newstext"><i>	  {!! $phrase !!} <a href="{{ route('news.show', [$newsItem->newsId]) }}" class="reactions"> Lees verder </a></i></p>
							<p class="reactions"><a href="{{ route('news.show', [$newsItem->newsId]) }}#reacties">Reacties ({!! count($newsItem->newsComments) !!}) </a></p>
						</li>
					@endforeach
				</ul>
			</div>
			<div class="col-md-12 addmargin">
				<h3> Oud </h3>
				<table class="table">
					<thead> 
						<tr>
							<th> District </th>
							<th> Datum </th>
							<th> <i class="fa fa-user fa-lg"></i></th>
							<th> Artikel </th>
							<th> <i class="fa fa-comment-o fa-lg"></i> </th>
							<th></th>
						</tr>
					</thead>
					<tbody>
					@foreach($oldnews as $newsItem)
						<tr>
							<td> 
								@if(count($newsItem->districtSections))
										 {!! $newsItem->districtSections[0]->name !!}
										@if(count($newsItem->districtSections) > 1)
										,..
										@endif
								@else
									Algemeen
								@endif 
							</td>
							<td> {!! $newsItem->normalDate() !!} </td>
							<td> {!! $newsItem->user->username !!}</td>
							<td> {!! $newsItem->title !!} </td>
							<td> {!! count($newsItem->newsComments) !!} </td>
							<td> <a href="{{ route('news.show', [$newsItem->newsId]) }}"> <span class="glyphicon glyphicon-new-window" aria-hidden="true"></span></a></td>
						</tr>
					@endforeach
				</tbody>
				</table>
			</div>
		</div>
		@if($sidebar->count())
			@include('partials/_sidebar')
		@endif					
	</div>
@stop