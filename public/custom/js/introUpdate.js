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
    if(confirm('Wilt u de wijzigingen ook tonen in "Nieuw op de site" ?'))
    {
        document.getElementById("newOnSiteCheck").value = "TRUE";
    }
}