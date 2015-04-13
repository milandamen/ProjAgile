@extends('app')

@section('content')
    <div class="container">
        <div class="content">
            <div class="title"><h1>Sorry!</h1></div>
            <p>U moet ingelogd zijn om deze pagina te bezoeken.</p>
            <p>{!! link_to_route('home.index', 'Ga naar home', [], ['class' => 'btn btn-default']) !!}</p>
        </div>
    </div>
@stop