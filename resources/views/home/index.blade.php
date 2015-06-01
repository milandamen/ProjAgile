@extends('app')

@section('title')
	De Bunders - Home
@stop

@section('description')
	Dit is de home pagina van De Bunders.
@stop

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				@include('home.partials._module-carousel')
			</div>
		</div>
		@include('flash::message')
		<div class="row">
			<div class="col-md-12">
				<h2 class="page-header"> {!! $introduction->title !!}</h2>
			</div>
		</div>
		<div class="row">
			{{-- Script for laying out modules on correct spots --}}
			<div class="col-md-8">
				@for ($i = 0; $i < count($layoutModules) - 2; $i++)					
					{{-- Loop all modules, except the last one --}}
					@include('home.partials._' . $layoutModules[$i]->moduleName)
				@endfor
			</div>
			<div class="col-md-4">
				@for ($i = count($layoutModules) - 2; 
					$i < count($layoutModules); $i++)	
					@include('home.partials._' . $layoutModules[$i]->moduleName)
				@endfor
			</div>
			{{-- End layout script --}}
		</div>
	</div>
@stop

@section('additional_scripts')
	{!! HTML::script('custom/js/flash_message.js') !!}
	{!! HTML::script('custom/js/carousel.js') !!}
@stop