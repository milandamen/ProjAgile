@section('title')
	De Bunders - 500
@stop

@section('description')
	Dit is de 500 foutmelding pagina van De Bunders.
@stop

@section('content')
	<div class="container">
		<div class="content">
			{!! Breadcrumbs::render('error', 'Fatale Fout') !!}
			<div class="title">
				<h1>Sorry!</h1>
			</div>
			<p>Er heeft zich een fatale fout plaatsgevonden.</p>
			<p>{!! link_to_route('home.index', 'Ga naar home', [], ['class' => 'btn btn-primary']) !!}</p>
		</div>
	</div>
@stop