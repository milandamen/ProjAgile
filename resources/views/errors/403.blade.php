@extends('app')

@section('title')
	De Bunders - 403
@stop

@section('description')
	De Bunders 403 error pagina.
@stop

@section('content')
	<div class="container">
		<div class="content">
			{!! Breadcrumbs::render('error', '403') !!}
			<div class="title"><h1>Sorry!</h1></div>
			<p>U probeerde een pagina te bezoeken waar u niet voor geautoriseerd bent.</p>
			<p>{!! link_to_route('home.index', 'Ga naar home', [], ['class' => 'btn btn-primary']) !!}</p>
		</div>
	</div>
@stop