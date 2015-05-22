@extends('app')

@section('title')
	De Bunders - Niet gepubliceerd
@stop

@section('description')
	Dit is een foutmeldings pagina van De Bunders.
@stop

@section('content')
	<div class="container">
		<div class="content">
			{!! Breadcrumbs::render('error', '404') !!}
			<div class="title">
				<h1>Sorry!</h1>
			</div>
			<p>De pagina die u probeert te bereiken is helaas niet (langer) toegankelijk.</p>
			<p>{!! link_to_route('home.index', 'Ga naar home', [], ['class' => 'btn btn-primary']) !!}</p>
		</div>
	</div>
@stop