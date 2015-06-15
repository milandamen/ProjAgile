@extends('app')

@section('title')
	De Bunders - Deelwijk {!! $district->name !!}
@stop

@section('description')
	Dit is de pagina van de deelwijk {!! $district->name !!} van De Bunders.
@stop

@section('content')
	 <div class="container">
		<div class="row">
			{!! Breadcrumbs::render('district.show', (object)['id' => $district->districtSectionId, 'name' => $district->name]) !!}
		</div>
		<div class="row">
			<div class="col-md-12">
				<h2 class="page-header">
					@if(Auth::check() &&  (Auth::user()->usergroup->name === 'Administrator' || Auth::user()->usergroup->name === 'Content Beheerder'))
							<a href="{{ route('district.edit', [$district->districtSectionId]) }}">
								<i class="fa fa-pencil-square-o"></i>
							</a>
						@endif
					Deelwijk {!! $district->name !!}
				</h2>
			</div>
		</div>

		<div class="row addmargin">
			<div class="col-md-8">
				<p> {!! nl2br($district->generalInfo) !!} </p>
			</div>
		</div>

		<div class="row">
			<div class="col-md-8">
				<h4>Al het nieuws van {!! $district->name !!}</h4>
				<div class="col-md-12 addmargin">
					<table class="table">
						<tr>
							<th> Nieuws</th>
							<th> Tekst </th>
							<th></th>
							<th> Reacties </th>
						</tr>
						
						{{--*/  
							$curDate = date('d-m-Y H:i', time());
							$count = 0; 
							$current = strtotime($curDate);
						/*--}}

						@foreach($district->news as $news)
							{{--*/
								$endDate = strtotime($news->publishEndDate);
								$pubDate = strtotime($news->publishStartDate);
							/*--}}

							@if($pubDate <= $current && $endDate >= $current && !$news->hidden)	
								@if($news->top)
									<tr>
										<td> <a href="{!! route('news.show', $news->newsId) !!}">{!! $news->title !!} </a></td>
										 {{--*/ $phrase = trunc($news->content, 20); /*--}}
										<td colspan="2"><i> {!! $phrase !!} </i></td>
										<td> {!! count($news->comments) !!}</td>
									</tr>
								@endif
								{{--*/ $count++; /*--}}
							@endif
						@endforeach

						@foreach($district->news as $news)

							{{--*/
								$endDate = strtotime($news->publishEndDate);
								$pubDate = strtotime($news->publishStartDate);
							/*--}}
							@if($pubDate <= $current && $endDate >= $current && !$news->hidden)
								@if(!$news->top)
									<tr>
										<td> <a href="{!! route('news.show', $news->newsId) !!}">{!! $news->title !!} </td>
										 {{--*/ $phrase = trunc($news->content, 30); /*--}}
										<td colspan="2"> {!! $phrase !!} </td>
										<td> {!! count($news->comments) !!}</td>
									</tr>
									{{--*/ $count++; /*--}}
								@endif
							@endif
						@endforeach

						@if($count == 0)

						<td colspan="4"> Er is op dit moment geen nieuws voor deze deelwijk </td>
					
						@endif
					</table>
				</div>
			</div>
		</div>



		<div class="row">
			<div class="col-md-8">
				<h4>Alle pagina's van {!! $district->name !!}</h4>
				<div class="col-md-12 addmargin">
					<table class="table">
						<tr>
							<th> Pagina</th>
							<th> Tekst </th>
							<th> </th>
							<th>  </th>
						</tr>
<!--
						@\foreach($district->pages as $page)
							<tr>
								<td> {--!! $page->title !!--} </td>
								 {{-- //$phrase = trunc($page->introduction->text, 30); --}}
								<td> {--!! //$phrase !!--} </td>
								<td> </td>
								<td> </td>
							</tr>
						@\endforeach
					-->
					</table>
				</div>
			</div>
		</div>	
	</div>
@endsection




