function validate()
{
	var message = prompt('Wilt u de wijzigingen ook tonen in "Nieuw op de site" ? (max. 30 karakters)');

	if(message != null)
	{
		while(message.length > 30)
		{
			message = prompt("Maximaal aantal karakters is 30. Verkort uw bericht.", message)
		}
	}

	if(message != null && message != '')
	{
		document.getElementById("newOnSiteCheck").value = "TRUE";
		document.getElementById("newOnSiteMessage").value = message;
	}

	return true;
}