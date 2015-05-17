
var maxRowIndex = document.getElementById("menuTable").getElementsByTagName("tr").length - 2;
document.getElementById('maxRowIndex').value = maxRowIndex;

function removeMenuRow(button)
{
	var row=button.parentNode.parentNode;
	row.parentNode.removeChild(row);
}

function addMenuRow(button)
{
	var table = document.getElementById("menuTable");
	var tableNumber = maxRowIndex + 1;
	var row = table.insertRow();
	var cellID = row.insertCell();
	var cellMenuItem = row.insertCell();
	var cellMenuURL = row.insertCell();
	var cellMenuLvl = row.insertCell();
	var cellMenuPublic= row.insertCell();
	var cellMenuDelete= row.insertCell();

	cellID.innerHTML = '<input type="text" name="menuItem['+ tableNumber+'][0]" id="id" value="" style="display:none;">';
	cellMenuItem.innerHTML = '<input type="text" name="menuItem['+ tableNumber+'][1]" id="item" value="">';
	cellMenuURL.innerHTML = '<input type="text" name="menuItem['+ tableNumber+'][2]" id="url" value=""> ';
	cellMenuLvl.innerHTML = '<input type="text" name="menuItem['+ tableNumber+'][3]" id="lvl" value="">';
	cellMenuPublic.innerHTML = '<input type="checkbox" name="menuItem['+ tableNumber+'][4]" id="public" value="">';
	cellMenuDelete.innerHTML = '<a onclick="removeMenuRow(this)" class="btn btn-danger btn-xs">X</a>';
	
	maxRowIndex++;
	
	document.getElementById("maxRowIndex").value = maxRowIndex;
}

function goBack() 
{
	window.history.back()
}