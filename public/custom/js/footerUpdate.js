function addColumn()
{
    //get table container
    var container = document.getElementById('footer-tables');
    //get number of tables
    var numTables = container.children.length;
    //create table
    var table = document.createElement('table');
    //set attributes
    table.setAttribute('class', 'col-sm-4');
    table.setAttribute('name', numTables);

    if(numTables < 3)
    {
        //create edit buttons
        var row1 = table.insertRow(0);
        var row2 = table.insertRow(1);
        var cell1 = row1.insertCell(0);
        var cell2 = row2.insertCell(0);
        cell1.innerHTML = '<button type="button" onclick="addRow(this)" class="btn btn-primary btn-sm">Voeg link toe</button> <button type="button" onclick="removeColumn(this)" class="btn btn-primary btn-sm">Verwijder kolom</button>';
        cell2.innerHTML = '&nbsp;';
        //create first link
        var row = table.insertRow(2);
        var cell = row.insertCell(0);
        cell.innerHTML = 'Titel: <input type="text" name="footer[' + numTables + '][text][]" id="footerText" required>'+
        '<button type="button" onclick="removeRow(this)" class="btn btn-primary btn-xs">X</button>'+
        '<br/> Link: <input type="text" name="footer[' + numTables + '][link][]" id="footerLink">';

        //finally, append table to container
        container.appendChild(table);
    }
    else
    {
        alert('U kunt geen kolom meer toevoegen, maximaal aantal bereikt.');
    }

}

function removeColumn(button)
{
    //get table via button.td.tr.table
    var table = button.parentNode.parentNode.parentNode;
    //remove table via table.div.removeChild(table)
    table.parentNode.removeChild(table);
}

function addRow(button)
{
    var table = button.parentNode.parentNode.parentNode;
    var tableNumber = $(button).closest('table').attr("name");
    var row = table.insertRow(table.rows.length);
    var cell = row.insertCell(0);
    cell.innerHTML = 'Text: <input type="text" name="footer[' + tableNumber + '][text][]" id="footerText" required>'+
    ' <button type="button" onclick="removeRow(this)" class="btn btn-primary btn-xs">X</button>'+
    '<br/> Link: <input type="text" name="footer[' + tableNumber + '][link][]" class="autocomplete ui-autocomplete-input" id="footerLink">';

	$(function() {
	    $(".autocomplete").autocomplete({
	        source: "/autocomplete/",
	        minLength: 2
	    });
	});
}

function removeRow(button)
{
    var row = button.parentNode;
    row.parentNode.removeChild(row);
}


function goBack() {
    window.history.back()
}
