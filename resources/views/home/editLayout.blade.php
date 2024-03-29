@extends('app')

@section('title')
	De Bunders - Home Layout Wijzigen
@stop

@section('description')
	Dit is de beveiligde home layout wijzig pagina van De Bunders.
@stop

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
		<div class="row">
			@include('flash::message')
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
			<a class="btn btn-danger" onclick="location.href='{{ route('management.index') }}'">Annuleren</a>
			<a class="btn btn-success" onclick="submitLayoutForm()">Opslaan</a>
		</div>
	</div>
@stop

@section('additional_scripts')
	{!! HTML::script('custom/js/editlayout.js') !!}
	{!! HTML::script('custom/js/flash_message.js') !!}
@stop