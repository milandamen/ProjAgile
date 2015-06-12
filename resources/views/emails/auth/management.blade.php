@extends('email')

@section('content')
	<h4>Geachte beheerder,</h4>
	<p>
		Bij deze willen we u op de hoogte stellen van de registratie van {{ $name }}. 
		Deze gebruiker valt op dit moment onder deelwijk {{ $districtSection }}, en heeft de volgende rechten binnen het systeem:
		<ul> 
			<li>Tonen van pagina's en nieuws binnen de eigen deelwijk</li>
			<li>Reageren op nieuwsberichten in Algemeen of binnen de eigen deelwijk</li>
			<li>Het wijzigen van de eigen gegevens met betrekking tot naamsgegevens, profielgegevens en het wachtwoord.</li>
		</ul>
		
		Dit is een automatisch gegenereerd bericht. U kunt hier niet op reageren.
	</p>
@stop