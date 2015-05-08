
function addRow(button)
{
    var table = button.parentNode.parentNode.parentNode;
    var tableNumber = $(button).closest('table').attr("name");
    var row = table.insertRow(table.rows.length);
    var cellText = row.insertCell(0);
  
    cellText.innerHTML = 'Tekst: <input type="text" name="footer[' + tableNumber + '][text][]" id="footerText" required>';

    var cellLink = row.insertCell(1);
    cellLink.innerHTML = 'Link: &nbsp; <input type="text" name="footer[' + tableNumber + '][link][]" class="autocomplete" id="footerLink" value="">'; 
    var cellX = row.insertCell(2);
    cellX.innerHTML = '<a type="button" onclick="removeRow(this)" class="btn btn-danger btn-xs">X</a>';

	$(function() {
	    $(".autocomplete").autocomplete({
	        source: autocompleteURL,
	        minLength: 2
	    });
	});
}

function removeRow(button)
{
    var row = button.parentNode.parentNode;
    row.parentNode.removeChild(row);
}



