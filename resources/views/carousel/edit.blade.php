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
				<form method="post" action="{!! route('carousel.update') !!}" enctype="multipart/form-data">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					{{-- */ $curDate = date('Y-m-d H:i:s',time()); $someRed = false; /* --}}
					<table id="articlelisttable" class="table">
						<thead>
							<tr>
								<th class="cu-smallcol">Index</th>		<!-- Index -->
								<th class="cu-smallcol">Soort</th>		<!-- Sort -->
								<th class="cu-smallcol">ID</th>			<!-- Article ID -->	
								<th class="fullwidth">Beschrijving</th>	<!-- Article title -->	
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
								@endif
									<td></td>
									<td>
										@if($article->news != null)
											Nieuws
										@elseif($article->page != null)
											Pagina
										@else
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
												Carousel-item
										@endif
										 " class="hiddenInput"/>
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
										<input type="text" name="beschrijving[0]" class="fullwidth" value="{{ $article->description }}"/>
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
						<p class="redText">De publicatiedatum van één of meerdere nieuws artikelen is verlopen.</p>
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
							<th class="cu-smallcol"></th>
						</tr>
					</thead>
					<tbody id="searchresults"></tbody>
				</table>
			</div>
		</div>
	</div>
	<script>
		// Sets the URI for the Ajax request for searching an article by title for use in the carouselUpdate.js script.
		var getArticlesByTitleURL = "{!! route('news.getArticlesByTitle', '') !!}";
	</script>
@stop

@section('additional_scripts')
	<!-- JavaScript file that handles removing and adding of rows and posting of the data form -->
	{!! HTML::script('custom/js/carouselUpdate.js') !!}
	{!! HTML::script('custom/js/flash_message.js') !!}
@stop