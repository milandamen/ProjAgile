@extends('app')

@section('title')
	De Bunders - {{ $user->username }}
@stop

@section('description')
	Dit is de {{ $user->username }} overzicht pagina van De Bunders.
@stop

@section('content')
	<div class="container">
		<div class="row">
			{!! Breadcrumbs::render('user.showProfile') !!}
		</div>
		<div class="row">
			<div class="col-md-12">
				<h2 class="page-header">
					<a href="{{ route('user.editProfile') }}">
						<i class="fa fa-pencil-square-o"></i>
					</a>
					Mijn profiel
				</h2>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-1 addmargin">
				<h2>{{ $user->username }}</h2>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-5">
				<table class="table credentials-table">
					@include('user.partials._profile')
				</table>
			</div>
		</div>
		{!! link_to_route('home.index', 'Terug naar Home', [], ['class' => 'btn btn-info']) !!}
	</div>
@stop