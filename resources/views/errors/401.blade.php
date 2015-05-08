@extends('app')

@section('title')
	De Bunders - 401
@stop

@section('description')
	De Bunders 401 error pagina.
@stop

@section('content')
    <div class="container">
        <div class="content">
        	{!! Breadcrumbs::render('error') !!}
            <div class="title"><h1>Sorry!</h1></div>
            <p>U moet ingelogd zijn om deze pagina te bezoeken.</p>
            <p>{!! link_to_route('home.index', 'Ga naar home', [], ['class' => 'btn btn-primary']) !!}</p>
        </div>
    </div>
@stop