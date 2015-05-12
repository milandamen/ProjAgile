@extends('app')

@section('title')
	De Bunders - 404
@stop

@section('description')
	De Bunders 404 error pagina.
@stop

@section('content')
	<div class="container">
		<div class="content">
			{!! Breadcrumbs::render('error', '404') !!}
			<div class="title"><h1>Sorry!</h1></div>
			<p>De pagina die u probeerde te bereiken is helaas niet gevonden!</p>
			<p>{!! link_to_route('home.index', 'Ga naar home', [], ['class' => 'btn btn-primary']) !!}</p>
		</div>
	</div>
@stop