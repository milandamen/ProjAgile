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
				<li>
					<p class="newstitle"><a href="{{ route('news.show', [$newsItem->newsId]) }}">{!! $newsItem->title !!} </a></p>
					<p class="newsdate">{!! $newsItem->publishStartDate  !!} door  <b>{!! $newsItem->user->username !!} </b></p>
					 {{--*/ $phrase = trunc($newsItem->content, 10); /*--}}
					<p class="newstext"><i>	  {!! $phrase !!} </i></p>
					<p class="reactions"><a href="{{ route('news.show', [$newsItem->newsId]) }}#reacties">Reacties ({!! count($newsItem->newsComments) !!}) </a></p>
				</li>
				@endforeach
				</ul>
				</div>
					@if($sidebar->count())
						@include('partials/_sidebar')
					@endif
			</div>

@endsection