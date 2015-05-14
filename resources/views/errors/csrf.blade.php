@extends('app')

@section('title')
	De Bunders - CSRF Fout
@stop

@section('description')
	Dit is de csrf foutmelding pagina van De Bunders.
@stop

@section('content')
	<div class="container">
		<div class="content">
			{!! Breadcrumbs::render('error', 'Fatale Fout') !!}
			<div class="title">
				<h1>Sorry!</h1>
			</div>
			<p>Wegens beveiligings redenen is uw formulier verlopen. Probeer het alstublieft opnieuw.</p>
			<p>{!! link_to_route('home.index', 'Ga naar home', [], ['class' => 'btn btn-primary']) !!}</p>
		</div>
	</div>
@stop