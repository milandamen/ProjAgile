
function addRow(button)
{
    var table = button.parentNode.parentNode.parentNode;
    var tableNumber = $(button).closest('table').attr("name");
    var row = table.insertRow(table.rows.length);
    var cell = row.insertCell(0);
    cell.innerHTML = 'Tekst: <input type="text" name="footer[' + tableNumber + '][text][]" id="footerText" required>'+
    ' <button type="button" onclick="removeRow(this)" class="btn btn-primary btn-xs">X</button>'+
    '<br/> Link: &nbsp; <input type="text" name="footer[' + tableNumber + '][link][]" class="autocomplete ui-autocomplete-input" id="footerLink">';

	$(function() {
	    $(".autocomplete").autocomplete({
	        source: autocompleteURL,
	        minLength: 2
	    });
	});
}

function removeRow(button)
{
    var row = button.parentNode;
    row.parentNode.removeChild(row);
}

function validate()
{
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

    return true;
}

