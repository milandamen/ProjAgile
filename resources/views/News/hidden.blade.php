@extends('app')


@section('content')

	 <div class="container">

	 	<div class="row">
			{!! Breadcrumbs::render('newsmanage') !!}
		</div>

            <div class="row">	
                <div class="col-md-12">
                    <h2 class="page-header">
                        Nieuws Manage
                    </h2>
                </div>
            </div>

             <div class="row">
             	<div class="col-md-12">
             		     <p> Deze pagina is enkel zichtbaar voor de administrator en toont 
                    	al het nieuws. Inclusief de verborgen nieuwsberichten en de 
                    	berichten waarvan de publicatiedatum is verlopen.
                    </p>
             	<div class="col-md-12 addmargin">
					
					<table class="table">
						<thead> 
							<tr>
								<th> Status</th>
								<th> District </th>
								<th> Publicatie </th>
								<th> <i class="fa fa-user fa-lg"></i></th>
								<th> Artikel </th>
								<th> <i class="fa fa-comment-o fa-lg"></i> </th>
								<th colspan="3"> Acties </th>
																
							</tr>
						</thead>
						
						<tbody>
						@foreach($news as $newsItem)
							<tr>
								{{--*/ $date = date('Y-m-d H:i:s',time()-(7*86400)); // 7 days ago
        								$curDate = date('Y-m-d H:i:s',time());; /*--}}
								<td>
									@if(($newsItem->hidden == 1) && !($newsItem->publishEndDate < $date))
										<i class="fa fa-lock fa-lg"></i> 
									@elseif(($newsItem->publishEndDate < $curDate) && !($newsItem->hidden == 1))
										<i class="fa fa-archive"></i>
									@elseif(($newsItem->publishEndDate < $curDate) && ($newsItem->hidden == 1))
										<i class="fa fa-history fa-lg"></i> <i class="fa fa-lock fa-lg"></i> 
									@elseif($newsItem->publishStartDate > $curDate)
										<i class="fa fa-repeat fa-lg"></i>
									@endif
								</td>	
								<td> @if($newsItem->districtSection != null)
										{!! $newsItem->districtSection->name !!}
									@else
										Algemeen
									@endif 
								</td>
								<td> {!! $newsItem->normalDate() !!} tot  {!! $newsItem->endDate() !!}  </td>
								<td> {!! $newsItem->user->username !!}</td>
								<td> {!! $newsItem->title !!} </td>
								<td> {!! count($newsItem->newsComments) !!} </td>
								<td> <a href="{{ route('news.show', [$newsItem->newsId]) }}"> <span class="glyphicon glyphicon-new-window" aria-hidden="true"></span></a></td>
								<td> <!-- <a class="right" href="{{-- route('news.edit', [$newsItem->newsId]) --}}"> --> <i class="fa fa-pencil-square-o"></i><!--</a> --></td>
								<td> @if($newsItem->hidden == 0)
									<a href="{{ route('news.hide', [$newsItem->newsId]) }}" class="black"><i class="fa fa-lock fa-lg"></i></a> 
									@elseif($newsItem->hidden == 1)
									<a href="{{ route('news.unhide', [$newsItem->newsId]) }}" class="text-success"><i class="fa fa-unlock-alt fa-lg"></i></a>
									@endif
								</td>
							</tr>
						@endforeach
					</tbody>
					</table>
				</div>
			</div>
				
			</div>

@endsection