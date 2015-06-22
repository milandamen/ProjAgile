@extends('app')

@section('content')
	<div class="container">
		<div class="row">
			{!! Breadcrumbs::render('news.manage') !!}
		</div>
		<div class="row">	
			<div class="col-md-12">
				<h2 class="page-header">Nieuws Beheer</h2>
			</div>
		</div>
		<div class="row">
			@include('flash::message')
		</div>
		<div class="row">
			<div class="col-md-12">
				<p class="col-md-8"> 
					Deze pagina is enkel zichtbaar voor de administrator en toont 
					al het nieuws. Inclusief de verborgen nieuwsberichten en de 
					berichten waarvan de publicatiedatum is verlopen.
				</p>

				{!! link_to_route('news.create', 'Nieuw Bericht', [], array('class' => 'btn btn-success white')) !!}
				{!! link_to_route('management.index', 'Terug naar Beheer', [], ['class' => 'btn btn-danger white']) !!}
			</div>
			<div class="col-md-12 addmargin">
				<table class="table">
					<thead> 
						<tr>
							<th>Status</th>
							<th>District </th>
							<th>Publicatie </th>
							<th>
								<i class="fa fa-user fa-lg"></i>
							</th>
							<th>Artikel </th>
							<th>
								<i class="fa fa-comment-o fa-lg"></i> 
							</th>
							<th colspan="4">Acties</th>
						</tr>
					</thead>
					<tbody>
						@foreach($news as $newsItem)
							<tr>
								{{--*/ $date = date('d-m-Y H:i:',time()-(7*86400)); // 7 days ago
								 $curDate = date('d-m-Y H:i', time()); 
								 $daysAgo = strtotime($date);
								 $current = strtotime($curDate);
								 $endDate = strtotime($newsItem->publishEndDate);
								 $pubDate = strtotime($newsItem->publishStartDate);

								 /*--}}
								<td>
									@if(($newsItem->hidden) && !($endDate < $daysAgo))
										<i class="fa fa-eye-slash fa-lg"></i> 
									@elseif(($endDate < $current) && !($newsItem->hidden))
										<i class="fa fa-ban fa-lg"></i> 
									@elseif(($endDate < $current) && ($newsItem->hidden))
										<i class="fa fa-ban fa-lg"></i>  
										<i class="fa fa-eye-slash fa-lg"></i> 
									@elseif($pubDate > $current)
										<i class="fa fa-repeat fa-lg"></i>
									@endif
								</td>	
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
								<td>{!! $newsItem->normalDate() !!} tot  {!! $newsItem->endDate() !!}</td>
								<td>{!! $newsItem->user->username !!}</td>
								<td>{!! $newsItem->title !!}</td>
								<td>{!! count($newsItem->newsComments) !!}</td>
								<td> 
									<a href="{{ route('news.show', [$newsItem->newsId]) }}"> 
										<span class="glyphicon glyphicon-new-window" aria-hidden="true"></span>
									</a>
								</td>
								<td> 
									<a class="right" href="{{ route('news.edit', [$newsItem->newsId]) }}">
										<i class="fa fa-pencil-square-o fa-lg"></i>
									</a>
								</td>
								
								<td> 
									@if(!$newsItem->hidden)
										<a href="{{ route('news.toggleHide', [$newsItem->newsId]) }}" class="black">
											<i class="fa fa-eye-slash fa-lg"></i>
										</a> 
									@else
										<a href="{{ route('news.toggleHide', [$newsItem->newsId]) }}" class="text-success">
											<i class="fa fa-eye fa-lg"></i>
										</a>
									@endif
								</td>
								<td><a href="{{ route('news.delete', [$newsItem->newsId]) }}" onclick="confirmDelete()">
											<i class="fa fa-times fa-lg text-danger"></i>
										</a>
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
@stop

@section('additional_scripts')
	{!! HTML::script('custom/js/flash_message.js') !!}
@stop