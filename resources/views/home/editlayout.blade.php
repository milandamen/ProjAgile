@extends('app')

@section('content')
    <div class="container">
		<form id="dataform" method="post">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			
			<div id="draggabledivs" class="row">
				{{-- Script for laying out modules on correct spots --}}
				
				<div class="col-md-8">
					@for ($i = 0; $i < count($layoutmodules) - 1; $i++)					{{-- Loop all modules, except the last one --}}
						@include('home.' . $layoutmodules[$i]->modulename)
					@endfor
				</div>
				
				<div class="col-md-4">
					@include('home.' . $layoutmodules[ count($layoutmodules) - 1 ]->modulename)
				</div>
				
				{{-- End layout script --}}
			</div>
		</form>
		
		<div>
			<a href="#" class="btn btn-success" onclick="submitLayoutForm()">Opslaan</a>
		</div>
	</div>
@endsection

@section('additional_scripts')
	<!-- JavaScript that enables dragging and dropping and sends form -->
	{!! HTML::script('custom/js/editlayout.js') !!}
@endsection