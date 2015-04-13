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

				@foreach($news as $newsItem)


				{!! $newsItem !!}

				@endforeach

				</div>

		
					@if($sidebar->count())

						@include('partials/_sidebar')
					@endif
	

				
			</div>

@endsection