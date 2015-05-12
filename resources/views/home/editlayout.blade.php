@extends('app')

@section('content')
	<div class="container">
		<div class="row">
			{!! Breadcrumbs::render('home.editLayout') !!}
		</div>
		<div class="row">
			<div class="col-md-12">
				<h1>Home Layouyt Wijzigen</h1>
			</div>
		</div>
		<form id="dataform" method="post">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<div id="draggabledivs" class="row">
				{{-- Script for laying out modules on correct spots --}}
				<div class="col-md-8">
					@for ($i = 0; $i < count($layoutModules) - 2; $i++)					
						{{-- Loop all modules, except the last one --}}
						@include('home.partials._' . $layoutModules[$i]->moduleName)
					@endfor
				</div>
				<div class="col-md-4">
					@for ($i = count($layoutModules) - 2; $i < count($layoutModules); $i++)	
						@include('home.partials._' . $layoutModules[$i]->moduleName)
					@endfor
				</div>
				{{-- End layout script --}}
			</div>
		</form>
		<div>
			<a class="btn btn-success" onclick="submitLayoutForm()">Opslaan</a>
			<a class="btn btn-danger" onclick="location.href='{{route('admin.index')}}'">Annuleer</a>
		</div>
	</div>
@stop

@section('additional_scripts')
	<!-- JavaScript that enables dragging and dropping and sends form -->
	{!! HTML::script('custom/js/editlayout.js') !!}
@stop