@extends('app')

@section('title')
	De Bunders - Carousel Wijzigen
@stop

@section('description')
	Dit is de beveiligde carousel wijzig pagina van De Bunders.
@stop

@section('content')
	<div class="container">
		<div class="row">
			{!! Breadcrumbs::render('carousel.edit') !!}
		</div>
		<div class="row">
			<div class="col-md-12">
				<h1>Carousel Wijzigen</h1>
			</div>
		</div>
		<div class="row">
			@include('flash::message')
		</div>
		<div class="row">
			<div class="col-md-12">
				<form method="post" action="{!! route('carousel.update') !!}" enctype="multipart/form-data" onsubmit="validateCarousel()">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					{{-- */ $curDate = date('Y-m-d H:i:s',time()); $someRed = false; /* --}}
					<table id="articlelisttable" class="table">
						<thead>
							<tr>
								<th class="cu-smallcol">Index</th>		<!-- Index -->
								<th class="cu-smallcol">Soort</th>		<!-- Sort -->
								<th class="cu-smallcol">ID</th>			<!-- Article ID -->
								<th class="cu-smallcol">Titel</th>
								<th class="cu-smallcol">Start datum</th>
								<th class="cu-smallcol">Eind datum</th>
								<th>Beschrijving</th>					<!-- Article description -->

								<th>Image</th>
								<th class="cu-smallcol"></th>			<!-- Move up -->
								<th class="cu-smallcol"></th>			<!-- Move down -->
								<th class="cu-smallcol"></th>			<!-- Remove -->
							</tr>
						</thead>
						<tbody id="articlelist">
							@foreach ($carousel as $article)
								@if($article->news != null)
									@if ($article->news->hidden == 1 || $article->news->publishStartDate > $curDate || $article->news->publishEndDate < $curDate)
										<tr class="slightlyRed">
										{{-- */ $someRed = true; /* --}}
									@else
										<tr>
									@endif

								@elseif($article->page != null)

									@if($article->page->visible == 0 || $article->page->publishDate > $curDate || $article->page->publishEndDate < $curDate)
										<tr class="slightlyRed">
										{{-- */ $someRed = true; /* --}}
									@endif

								@else

									@if($article->publishStartDate > $curDate || $article->publishEndDate < $curDate)
										<tr class="slightlyRed">
										{{-- */ $someRed = true; /* --}}
									@endif

								@endif
									<td></td>
									<td>
										@if($article->news != null)
											<input type="hidden" name="sort[0]" value="news">
											Nieuws
										@elseif($article->page != null)
											<input type="hidden" name="sort[0]" value="page">
											Pagina
										@else
											<input type="hidden" name="sort[0]" value="carousel">
											Carousel item
										@endif
									</td>
									<td>
										<input type="text" name="artikel[0]" value="
											@if($article->news != null)
												{{ $article->news->newsId }}
											@elseif($article->page != null)
												{{$article->page->pageId}}
											@else
													{{$article->carouselId}}
											@endif
										" class="hiddenInput" />
										<span>
											@if($article->news != null)
												{{ $article->news->newsId }}
											@elseif($article->page != null)
												{{$article->page->pageId}}
											@else
												{{$article->carouselId}}
											@endif
										</span>
									</td>
									<td>
										@if($article->news != null)
											{{$article->news->title}}
										@elseif($article->page != null)
											{{$article->page->introduction->title}}
										@else
											<input type="text" name="carouselTitle[]" value="{{$article->title}}" class="carouselTitle"/>
										@endif
									</td>
									<td class="date-box">
										@if($article->news != null)
											{{$article->news->normalDate()}}
										@elseif($article->page != null)
											{{$article->page->publishDate}}
										@else
											<div class="input-group date icon-width">
												<input type="hidden" name="carouselStartDate[]" value="{{$article->startDate()}}" class="carousel-start-date"/>
												<span class="input-group-addon">
													<span class="glyphicon glyphicon-calendar"></span>
												</span>
											</div>
										@endif
									</td>
									<td class="date-box">
										@if($article->news != null)
											{{$article->news->endDate()}}
										@elseif($article->page != null)
											{{$article->page->publishEndDate}}
										@else
											<div class="input-group date icon-width">
												<input type="hidden" name="carouselEndDate[]" value="{{$article->endDate()}}" class="carousel-end-date"/>
												<span class="input-group-addon">
													<span class="glyphicon glyphicon-calendar"></span>
												</span>
											</div>
										@endif
									</td>
									<td>
										<textarea name="beschrijving[]" class="fullwidth">{{ $article->description }}</textarea>
									</td>
									<td>
										@if ($article->imagePath !== 'blank.jpg')
											<a href="{{ asset('uploads/img/carousel/' . $article->imagePath) }}" target="_blank">Bekijk huidig</a>
											<div class="floatRight">
												<input type="checkbox" name="deletefile[0]" value="true"/> Verwijder huidig
											</div>
										@endif
										<input type="file" name="file[0]" />
									</td>
									<td>
										<a class="btn btn-primary btn-xs" onclick="moveArticleUp(this)">
											<i class="fa fa-arrow-up"></i>
										</a>
									</td>
									<td>
										<a class="btn btn-primary btn-xs" onclick="moveArticleDown(this)">
											<i class="fa fa-arrow-down"></i>
										</a>
									</td>
									<td>
										<a class="btn btn-danger btn-xs" onclick="removeArticle(this)">
											<i class="fa fa-times"></i>
										</a>
									</td>
								</tr>
							@endforeach
						</tbody>
					</table>
					@if ($someRed)
						<p class="redText">De publicatiedatum van één of meerdere artikelen is verlopen.</p>
					@endif
					<button type="button" class="btn btn-danger" onclick="location.href='{{ route('management.index') }}'">Annuleren</button>
					<button type="button" class="btn btn-primary add-carousel-button">Voeg carousel item toe</button>
					<button type="submit" class="btn btn-success">Opslaan</button>
				</form>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<h2>Zoek artikel op titel</h2>
				<input type="text" id="artikeltitel" />
				<a onclick="searchArticle()" class="btn btn-primary">Zoek</a>
			</div>
			<div class="col-md-12">
				<table class="table">
					<thead>
						<tr>
							<th class="cu-smallcol">ID</th>
							<th>Titel</th>
							<th>Start datum</th>
							<th>Eind datum</th>
							<th class="cu-smallcol"></th>
						</tr>
					</thead>
					<tbody id="searchresults"></tbody>
				</table>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<h2>Zoek pagina op titel</h2>
				<input type="text" id="pageTitle" />
				<a onclick="searchPage()" class="btn btn-primary">Zoek</a>
			</div>
			<div class="col-md-12">
				<table class="table">
					<thead>
					<tr>
						<th class="cu-smallcol">ID</th>
						<th>Titel</th>
						<th>Start datum</th>
						<th>Eind datum</th>
						<th class="cu-smallcol"></th>
					</tr>
					</thead>
					<tbody id="page-searchresults"></tbody>
				</table>
			</div>
		</div>
	</div>
	<script>
		// Sets the URI for the Ajax request for searching an article by title for use in the carouselUpdate.js script.
		var getArticlesByTitleURL = "{!! route('news.getArticlesByTitle', '') !!}";
		// Sets the URI for the Ajax request for searching a page by title for use in the carouselUpdate.js script.
		var getPagesByTitleURL = "{!! route('page.getPagesByTitle', '') !!}";
	</script>
@stop

@section('additional_scripts')
	<!-- JavaScript file that handles removing and adding of rows and posting of the data form -->
	{!! HTML::script('custom/js/carouselUpdate.js') !!}

	{!! HTML::script('moment/moment.js') !!}
	{!! HTML::script('moment/locale/nl.js') !!}
	{!! HTML::script('bootstrap/js/bootstrap-datetimepicker.js') !!}
	{!! HTML::script('custom/js/datepicker.js') !!}

	{!! HTML::script('custom/js/flash_message.js') !!}
@stop