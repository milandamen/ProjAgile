<html>
	<head>
	</head>
	<body>
		<h4> {!!  $data->title !!} </h4>
		<div>
			<!-- Tekst die aan de email meegegeven moet worden ( deze tekst kan als data meegegeven worden ) -->
			<!-- Geachte gebruiker,
			Bedankt voor uw registratie bij onze website. Wij hopen dat u veel plezier beleeft op onze
			website en actief van uw account gebruik zal maken. Heeft u nog vragen, dan kunt u ons mailen
			via het volgende emailadres: <a href="mailto:info@debunders-veghel.nl"> info@debunders-veghel.nl </a> -->
			

			<!-- Geachte Administrator /(beheerder),
			Bij deze willen we u op de hoogte stellen van de registratie van "insertname" . 
			Deze gebruiker valt op dit moment onder deelwijk "X", en heeft de volgende rechten binnen het systeem:
			<ul> 
				<li>Tonen van pagina's en nieuws binnen de eigen deelwijk</li>
				<li> Reageren op nieuwsberichten in Algemeen of binnen de eigen deelwijk </li>
				<li> Het wijzigen van de eigen gegevens met betrekking tot naamsgegevens, profielgegevens en het wachtwoord. </li>
			</ul>
			Dit is een automatisch gegenereerd bericht -->


			<p> {{ $data->text}}</p>
		</div>
	</body>
</html>