@extends('app')

@section('content')
    <div class="container">
        <div class="content">
            <div class="title"><h1>Sorry!</h1></div>
            <p>U probeerde een pagina te bezoeken waar u niet voor geautoriseerd bent.</p>
            <p>{!! link_to_route('home.index', 'Ga naar home', [], ['class' => 'btn btn-default']) !!}</p>
        </div>
    </div>
@stop