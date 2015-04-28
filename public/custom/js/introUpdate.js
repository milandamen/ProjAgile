function goBack() {
    window.history.back()
}

function validate() {

    var message = prompt('Wilt u de wijzigingen ook tonen in "Nieuw op de site" ? (max. 30 karakters)');

    while(message.length > 30)
    {
        message = prompt("Maximaal aantal karakters is 30. Verkort uw bericht.", message)
    }

    if(message != null)
    {
        document.getElementById("newOnSiteCheck").value = "TRUE";
        document.getElementById("newOnSiteMessage").value = message;
    }
}