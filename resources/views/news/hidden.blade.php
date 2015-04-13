@extends('app')


@section('content')

	 <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="page-header">
                        Nieuws Manage
                    </h2>
                    <p class="col-md-8"> Deze pagina is enkel zichtbaar voor de administrator en toont 
                    	al het nieuws. Inclusief de verborgen nieuwsberichten en de 
                    	berichten waarvan de publicatiedatum is verlopen.
                    </p>
                </div>
            </div>

             <div class="row">
             	<div class="col-md-8">
             	<div class="col-md-12 addmargin">
			
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
						@foreach($news as $newsItem)
							<tr>
								<td> @if($newsItem->districtSection != null)
										{!! $newsItem->districtSection->name !!}
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

@endsection