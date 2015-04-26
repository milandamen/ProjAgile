function goBack() {
    window.history.back()
}


function validate() {
    if (document.getElementById("title").value == "") {
        alert("Vul a.u.b. een titel in.");
        return false;
    }
    if(document.getElementById("content").value == "")
    {
        alert("Vul a.u.b. een tekst in.");
        return false;
    }

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