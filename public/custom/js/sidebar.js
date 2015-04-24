
var maxRowIndex = document.getElementById("sidebarTable").getElementsByTagName("tr").length - 2;
document.getElementById('maxRowIndex').value = maxRowIndex;

function removeSideRow(button)
{
    var row=button.parentNode.parentNode;
	row.parentNode.removeChild(row);
}

function addSideRow(button){
	var table = document.getElementById("sidebarTable");
 	var tableNumber = maxRowIndex + 1;
	var row = table.insertRow();
 	var cellText = row.insertCell();
 	var cellIntern = row.insertCell();

 	var cellRadio = row.insertCell();
 	var cellDelete = row.insertCell();

 	cellText.innerHTML = 'Tekst: <input type="text" name="sidebar['+ tableNumber+'][text][]" id="sidebarText" value="" required>';
 	cellIntern.innerHTML = 'Link <input id="page_name" class="autocomplete ui-autocomplete-input" name="sidebar['+ tableNumber+'][pagename][]" type="text"/>';
 
	$(function() {
	    $(".autocomplete").autocomplete({
	        source: "/autocomplete/",
	        minLength: 2
	    });
	});


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
