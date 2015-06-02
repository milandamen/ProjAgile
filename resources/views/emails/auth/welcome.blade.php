@extends('email')

@section('content')
	<h4>Welkom bij Wijkplatform De Bunders - Veghel</h4>
	<p>
		Bedankt voor uw registratie bij onze website. Wij hopen dat u veel plezier beleeft op onze website en actief van uw account gebruik zal maken. 
		Om het registratieproces af te ronden moet u echter nog eerst even uw account activeren door op de onderstaande link te klikken:
	</p>
	<p>
		<a href="{{ route('registration.confirm', [$confirmation_Token]) }}">Voltooi het registratieproces</a>
	</p>
	<p>
		Heeft u nog vragen, dan kunt u ons mailen via het volgende emailadres:
		<a href="mailto:info@debunders-veghel.nl"> info@debunders-veghel.nl</a>
	</p>
	<p>
		Dit is een automatisch gegenereerd bericht. U kunt hier niet op reageren.
	</p>
@stop