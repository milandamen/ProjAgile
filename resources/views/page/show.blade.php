@extends('app')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h2 class="page-header">{!! $page->title !!}</h2>
			</div>
		</div>

		<div class="row">
			<div class="col-md-8">
				<h4> {!! $page->introduction->title  !!} </h4>
			</div>
			<div class="panel-body col-md-8">
				{!! nl2br($page->introduction->text) !!}
			</div>

			@if($sidebar->count())
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
