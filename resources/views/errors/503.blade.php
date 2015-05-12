@extends('app')

@section('title')
	De Bunders - 503
@stop

@section('description')
	De Bunders 503 error pagina.
@stop

@section('content')
	<div class="container">
		<div class="content">
			{!! Breadcrumbs::render('error', '503') !!}
			<div class="title"><h1>Sorry!</h1></div>
			<p>Wij ervaren op dit moment een probleem. Wij zijn zo terug!</p>
		</div>
	</div>
@stop