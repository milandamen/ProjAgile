@extends('email')

@section('content')

	<b> Onderwerp: {!! $subject !!}  <br/>
	 Naam: {!! $name !!}</b>
	<p> 
		{!! nl2br($text) !!}
	</p>
	<hr/>
	<p> <i> Deze email is verzonden via het contactformulier op de website. U kunt deze rechtstreeks beantwoorden. </i></p>
@stop