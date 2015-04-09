@extends('app')

@section('content')
    <div class="container">
		<div class="row">
			<div class="col-md-12">
				{{-- Require de carousel hier --}}
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<h2 class="page-header">De Bunders</h2>
			</div>
		</div>
		
		<!-- Module placement -->
		<div class="row">
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
		
		<div class="row">
			<!-- Test if data is coming through -->

			<div class="col-md-8">
				<div class="col-md-10">
					<h3> Menu </h3>
					{{ $menu }}
				</div>
				<div class="col-md-10">
					<h3> Carousel </h3>
				</div>
				<div class="col-md-10">
					<h3> introduction </h3>
					{{ $intro }}
				</div>
				<div class="col-md-10">
					<h3> Sidebar </h3>
					{{ $sidebar }}
				</div>


				<div class="col-md-10">
					<h3> Footer </h3>
					{{ $footer }}
				</div>

			</div>	
			<!-- end test incoming data -->

        </div>
    </div>
@endsection