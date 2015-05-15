@extends('app')

@section('title')
	De Bunders - Beheer Paneel
@stop

@section('description')
	Dit is de beveiligde beheer paneel van De Bunders.
@stop

@section('content')
	<div class="container">
		<div class="row">
			{!! Breadcrumbs::render('management.index') !!}
		</div>
		<div class="row">
			<div class="col-lg-12">
				<h2 >Beheer</h2>
				<div class="col-md-12">
					<p class="col-md-8"> 
						Op deze pagina zijn alle elementen te vinden die men kan beheren.
						U heeft toegang tot alle onderdelen die hieronder te vinden zijn. Mocht u een onderdeel missen meld dit dan bij de beheerder!
					</p>
				  </div>
				<div class="col-md-12">
					@if(Auth::check() && Auth::user()->usergroup->name === 'Administrator')
						@include('management.partials._managementGeneral')
						@include('management.partials._managementHome')
						@include('management.partials._managementNews')
						@include('management.partials._managementUsers')
					@elseif(Auth::check() && Auth::user()->usergroup->name === 'Content Beheerder')
						@include('management.partials._managementHome')
						@include('management.partials._managementNews')
					@endif
				</div>
			</div>
		</div>
	</div>
@stop