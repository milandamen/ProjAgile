@extends('app')

@section('content')
	@if($news == null)
		<div class="container">
			<div class="row">
				{!! Breadcrumbs::render('news.show') !!}
			</div>
			<div class="row">
				<div class="col-lg-12">
					<h2 class="page-header">Dit artikel bestaat niet!</h2>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-6">
					<p class="goback">{!! link_to_route('home.index', 'Terug naar de homepage') !!}</p>
				</div>
			</div>
		</div>
	@else
		<div class="container">
			<div class="row">
				{!! Breadcrumbs::render('news.show', (object)['id' => $news->newsId, 'title' => $news->title]) !!}
			</div>
			<div class="row">
				<div class="col-lg-12">
					<h2 class="page-header">
						@if(Auth::check() &&  (Auth::user()->usergroup->name === 'Administrator' || Auth::user()->usergroup->name === 'Content Beheerder'))
							<a href="{{ route('news.edit', [$news->newsId]) }}">
								<i class="fa fa-pencil-square-o"></i>
							</a>
						@endif
						{!! $news->title !!}
					</h2>
				</div>
				<div class="col-md-8">
					<p class="news-info">
						{{ $news->date }}
						Door: {{ $news->user->username }} |
						@if($news->districtSection != null)
							{{ $news->districtSection->name }}
						@else
							Algemeen
						@endif
					</p>
					{!! nl2br($news->content) !!}
					<br/>
					@if(count($news->files) > 0)
						<br/>
						<p>Bijlagen:</p>
					@endif
					@foreach($news->files as $file)
						<a href="{{ asset('uploads/file/news/' . $file->path) }}">{{ $file->path }}</a>
						<br>
					@endforeach
					<br/>
					<p class="goback">{!! link_to_route('home.index', 'Terug naar de homepage') !!}</p>
				</div>
			</div>
			@if($news->newsComments->count() > 0)
				<h2 id="reacties">Reacties</h2>
				@foreach($news->newsComments as $comment)
					<div class="row">
						<div class="col-lg-6">
							<h4>{{$comment->user->username}}</h4>
							<p>{{$comment->message}}</p>
							<br/>
							<h6>{{$comment->created_at}}</h6>
							<hr>
						</div>
					</div>
				@endforeach
			@endif
			<div class="row">
				<div class="col-lg-6">
					@if(Auth::check())
						@if($news->commentable || (Auth::user()->usergroup->name === 'Administrator' || Auth::user()->usergroup->name === 'Content Beheerder'))
							@if(isset($news->districtSection))
								@if(isset(Auth::user()->districtSection))
									@if(Auth::user()->districtSection->name === $news->districtSection->name || 
										(Auth::user()->usergroup->name === 'Administrator' || Auth::user()->usergroup->name === 'Content Beheerder'))
										{!! Form::open(['route' => 'news.postComment', 'method' => 'POST']) !!}
											<h3>Plaats een reactie</h3>
											<div class="form-group">
												<input type="hidden" name="newsId" value="{{$news->newsId}}">
												<textarea name="comment" class="form-control"></textarea>
											</div>
											<button type="submit" class="btn btn-success" style="float: right;">Plaats reactie</button>
										{!! Form::close() !!}
									@endif
								@endif
							@else
								{!! Form::open(['route' => 'news.postComment', 'method' => 'POST']) !!}
									<h3>Plaats een reactie</h3>
									<div class="form-group">
										<input type="hidden" name="newsId" value="{{$news->newsId}}">
										<textarea name="comment" class="form-control"></textarea>
									</div>
									<button type="submit" class="btn btn-success" style="float: right;">Plaats reactie</button>
								{!! Form::close() !!}
							@endif
						@endif
					@endif
				</div>
			</div>
		</div>
	@endif
@stop