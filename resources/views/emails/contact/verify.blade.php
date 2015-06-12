@extends('email')

@section('content')
	<h4>Vraag verstuurd</h4>
	<p>
		Uw email aan Wijkraad de Bunders is in goede staat verzonden! We zullen proberen zo spoedig mogelijk te reageren. 
		Hieronder de inhoud van uw bericht.
	</p>
	<hr/>

	<h4> {!! $subject !!} </h4>

	<p>
		{!! nl2br($text) !!}
	</p>

	<hr/>
	<p>
		Dit is een automatisch gegenereerd bericht. U kunt hier niet op reageren.
	</p>
@stop