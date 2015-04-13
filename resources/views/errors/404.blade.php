@extends('app')

@section('content')
    <div class="container">
        <div class="content">
            <div class="title"><h1>Sorry!</h1></div>
            <p>De pagina die u probeerde te bereiken is helaas niet gevonden!</p>
            <p>{!! link_to_route('home.index', 'Ga naar home', [], ['class' => 'btn btn-default']) !!}</p>
        </div>
    </div>
@stop