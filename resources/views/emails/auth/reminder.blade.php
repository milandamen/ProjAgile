@extends('email')

@section('content')
	<h4>Geachte heer / mevrouw,</h4>
	<p>
		Wij hebben van u een aanvraag ontvangen om uw wachtwoord te resetten. Als u hieronder op de link klikt dan wordt u begeleid naar de wachtwoord reset pagina.
	</p>
	<p>
		<a href="{{ route('password.reset', [$token]) }}">Begeleid mij naar de wachtwoord reset pagina</a>
	</p>
	<p>
		Heeft u nog vragen, dan kunt u ons mailen via het volgende emailadres:
		<a href="mailto:info@debunders-veghel.nl"> info@debunders-veghel.nl</a>
	</p>
	<p>
		Dit is een automatisch gegenereerd bericht. U kunt hier niet op reageren.
	</p>
@stop