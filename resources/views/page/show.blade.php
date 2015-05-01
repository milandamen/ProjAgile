@extends('app')

@section('content')
	<div class="container">
		<div class="row">
				{!! Breadcrumbs::render('showpage', (object)['id' => $page->pageId, 'title' => $page->introduction->title]) !!}
			</div>

		<div class="row">
			<div class="col-md-12">
				<h2 class="page-header">{!! $page->title !!}</h2>
			</div>
		</div>

		<div class="row">
			<div class="col-md-8">
			<h4>	@if(Auth::check() && Auth::user()->usergroup->name === 'Administrator')	
				<a href="{{ route('page.edit', [$page->pageId])}}"><i class="fa fa-pencil-square-o"></i></a>
				@endif
			 {!! $page->introduction->title  !!} </h4>
			</div>
			<div class="panel-body col-md-8">
				{!! nl2br($page->introduction->text) !!}
			</div>

			@if(isset($sidebar))
			@include('partials/_sidebar')
			@endif
		</div>



			<!-- Panel placement -->
		<div class="row">
		{{-- Script for laying out modules on correct spots --}}
			<div class="col-md-12">
				@foreach($page->panels as $panel)					{{-- Loop all panels --}}
					<div class="col-md-{!! $panel->panel->size !!}">
						<div class="panel panel-default">
							<div class="panel-heading">
								{!! $panel->title !!}
							</div>
							<div class="panel-body">
								{!! nl2br($panel->text) !!}
							</div>
						</div>
					</div>
				@endforeach
			</div>

		{{-- End layout script --}}
		</div>

	
	</div>
@endsection
