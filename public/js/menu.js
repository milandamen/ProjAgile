
var maxRowIndex = document.getElementById("sidebarTable").getElementsByTagName("tr").length - 2;
document.getElementById('maxRowIndex').value = maxRowIndex;

function removeMenuRow(button)
{
    var row=button.parentNode.parentNode;
	row.parentNode.removeChild(row);
}

function addMenuRow(button){
	var table = document.getElementById("menuTable");
 	var tableNumber = maxRowIndex + 1;
	var row = table.insertRow();
 	var cellID = row.insertCell();
 	var cellMenuItem = row.insertCell();
 	var cellMenuURL = row.insertCell();
 	var cellMenuLvl = row.insertCell();
    var cellMenuPublic= row.insertCell();
    var cellMenuDelete= row.insertCell();

    cellMenuItem.innerHTML = '<input type="text" name="sidebar['+ tableNumber+'][text][]" id="sidebarText" value="" required>';
    cellMenuURL.innerHTML = '<input type="text" name="sidebar['+ tableNumber+'][link][]" id="sidebarText" value=""> ';
    cellMenuLvl.innerHTML = '';
    cellMenuPublic.innerHTML = '';

 	var div = document.createElement("div");
 	div.className = "radio";

	div.innerHTML = '<label class="radio-inline"><input type="radio" name="sidebar[' + tableNumber + '][radio1]" value="Extern">Extern</label>\
	<label class="radio-inline"><input type="radio" name="sidebar[' + tableNumber + '][radio1]" value="Intern">Intern</label>';

 	cellRadio.appendChild(div);
 	cellDelete.innerHTML = '<button type="text" onclick="removeSideRow(this)" class="btn btn-danger btn-xs">X</button>';
 	
	maxRowIndex++;
	
	document.getElementById("maxRowIndex").value = maxRowIndex;
}


function goBack() {
    window.history.back()
}
