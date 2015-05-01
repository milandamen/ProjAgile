@extends('app')

@section('content')
    <div class="container">
    	<div class="row">
				{!! Breadcrumbs::render('editcarousel') !!}
		</div>
        <div class="row">
            <div class="col-md-12">
                <h1>Wijzig carousel</h1>
            </div>
        </div>
		
		<div class="row">
			<div class="col-md-12">
				<form method="post" action="{!! route('carousel.update') !!}" enctype="multipart/form-data">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					
					<table id="articlelisttable" class="table">
						<thead>
							<tr>
								<th class="cu-smallcol">		<!-- Index -->
									Index
								</th>
								<th class="cu-smallcol">		<!-- Article ID -->
									ID
								</th>
								<th style="width: 100%";>		<!-- Article title -->
									Nieuws artikel
								</th>
								<th>
									Image
								</th>
								<th class="cu-smallcol">		<!-- Move up -->
								</th>
								<th class="cu-smallcol">		<!-- Move down -->
								</th>
								<th class="cu-smallcol">		<!-- Remove -->
								</th>
							</tr>
						</thead>
						<tbody id="articlelist">
							@foreach ($carousel as $article)
								<tr>
									<td>
										
									</td>
									<td>
										<input type="text" name="artikel[0]" value="{{ $article->news->newsId }}" class="hiddenInput" />
										<span>{{ $article->news->newsId }}</span>
									</td>
									<td>
										<span>{{ $article->news->title }}</span>
									</td>
									<td>
										@if ($article->imagePath !== 'blank.jpg')
											<a href="{{ asset('uploads/img/carousel/' . $article->imagePath) }}" target="_blank">Bekijk huidig</a>
										@endif
										<input type="file" name="file[0]" />
									</td>
									<td>
										<a class="btn btn-primary btn-xs" onclick="moveArticleUp(this)"><i class="fa fa-arrow-up"></i></a>
									</td>
									<td>
										<a class="btn btn-primary btn-xs" onclick="moveArticleDown(this)"><i class="fa fa-arrow-down"></i></a>
									</td>
									<td>
										<a class="btn btn-danger btn-xs" onclick="removeArticle(this)"><i class="fa fa-times"></i></a>
									</td>
								</tr>
							@endforeach
						</tbody>
					</table>
					
					<button type="submit" class="btn btn-success">Opslaan</button>
					<button type="button" class="btn btn-danger" onclick="location.href='{{route('admin.index', '')}}'">Annuleer</button>
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
							<th class="cu-smallcol">
								ID
							</th>
							<th>
								Titel
							</th>
							<th class="cu-smallcol">
								
							</th>
						</tr>
					</thead>
					<tbody id="searchresults">
						
					</tbody>
				</table>
			</div>
		</div>
    </div>
	
	<script>
		var getArticlesByTitleURL = "{!! route('news.getArticlesByTitle', '') !!}";			// Sets the URI for the Ajax request for searching an article by title for use in the carouselUpdate.js script.
	</script>
@endsection

@section('additional_scripts')
    <!-- JavaScript file that handles removing and adding of rows and posting of the data form -->
	{!! HTML::script('custom/js/carouselUpdate.js') !!}
@endsection