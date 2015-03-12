
function removeSideRow(button)
{
    var row=button.parentNode.parentNode;
    row.parentNode.removeChild(row);
}

function addSideRow(button){
	console.log('testSideRow');

 	var table = document.getElementById("sidebarTable");
 	var tableNumber = document.getElementById("sidebarTable").getElementsByTagName("tr").length;
 	var row = table.insertRow(tableNumber); 
 	var cellText = row.insertCell(0);
 	var cellLink = row.insertCell(1);
 	var cellRadio = row.insertCell(2);
 	var cellDelete = row.insertCell(3);

 	var tableNumber = tableNumber - 1;

 	cellText.innerHTML = 'Tekst: <input type="text" name="sidebar['+ tableNumber+'][text][]" id="sidebarText" value="" required>';
 	cellLink.innerHTML = 'Link: <input type="text" name="sidebar['+ tableNumber+'][link][]" id="sidebarText" value=""> ';


 	var div = document.createElement("div");
 	div.className = "radio";
 	//div.innerHTML = "<label class="radio-inline"><input type="radio" name="optradio[X]">Extern</label>
	//							<label class="radio-inline"><input type="radio" name="optradio[X]" checked="true">Intern</label>
	//				";

	div.innerHTML = '<label class="radio-inline"><input type="radio" name="sidebar[' + tableNumber + '][radio1]">Extern</label>\
	<label class="radio-inline"><input type="radio" name="sidebar[' + tableNumber + '][radio2]" checked="true">Intern</label>';

 	cellRadio.appendChild(div);
 	cellDelete.innerHTML = '<button type="text" onclick="removeSideRow(this)" class="btn btn-danger btn-xs">X</button>';
 	console.log(row);
}


function goBack() {
    window.history.back()
}
