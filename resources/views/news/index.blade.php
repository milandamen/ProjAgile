@extends('app')


@section('content')

	 <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="page-header">
                        Nieuws overzicht
                    </h2>
                </div>
            </div>

             <div class="row">
             	<div class="col-md-8">
             	<ul>
				@foreach($news as $newsItem)
				<li> {!! $newsItem->date !!} - {!! $newsItem->title !!} 
					  {{--*/ trunc($newsItem->content, 10); /*--}}
				<br/> Reacties ({!! count($newsItem->newsComments) !!}) </li>


				

				@endforeach
				</ul>
				</div>

		
					@if($sidebar->count())

						@include('partials/_sidebar')
					@endif
	

				
			</div>

@endsection