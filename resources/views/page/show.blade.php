@extends('app')

@section('title')
	De Bunders - {{ $page->introduction->title }}
@stop

@section('description')
	Dit is de {{ $page->introduction->title }} pagina van De Bunders.
@stop

@section('content')
	<div class="container">
		<div class="row">
			{!! Breadcrumbs::render('page.show', (object)['id' => $page->pageId, 'title' => $page->introduction->title]) !!}
		</div>
		<div class="row">
			<div class="col-md-12">
				<h2 class="page-header">
					@if(Auth::check() && Auth::user()->usergroup->name === 'Administrator')	
						<a href="{{ route('page.edit', [$page->pageId])}}" class="right">
							<i class="fa fa-pencil-square-o"></i>
						</a>
					@endif
					{!! $page->introduction->title !!}
				</h2>
			</div>
		</div>
		<div class="row col-md-12">
			@if(count($children))
				@foreach($children as $child)
				<div class="subpage">
					<a href="{{ route('page.show', [$child->pageId])}}" class="right">
						{!! $child->introduction->title !!}  
						</a>
					</div>
				@endforeach
			@endif

		</div>
		<div class="row">
			<div class="col-md-8">
				<h4>	
					{!! $page->introduction->subtitle  !!} 
				</h4>
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
				{{-- Loop all panels --}}
				@foreach($page->panels as $panel)
					<div class="col-md-{!! $panel->panel->size !!}">
						<div class="panel panel-default">
							@if($panel->title != '')
								<div class="panel-heading">{!! $panel->title !!}</div>
							@endif
							<div class="panel-body">{!! nl2br($panel->text) !!}</div>
						</div>
					</div>
				@endforeach
			</div>
		{{-- End layout script --}}
		</div>
	</div>
@stop