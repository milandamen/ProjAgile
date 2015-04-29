var panelIndex = document.getElementById("newPanels").getElementsByTagName("div").length;
document.getElementById('panelIndex').value = panelIndex;


function newPanel(size){
	var div = document.querySelector('#newPanels');

	var newDiv = document.createElement("div");
	var label= '<h4 >Nieuw vak met grootte ' + size + '<a onclick="removePanel(this)" class="btn btn-danger btn-xs white"> Verwijder paneel</a></h4>';

	var inputtitle = '<input type="text" class="form-control" placeholder="Titel" name="panel['+panelIndex+'][\'title\']"/><br/>';
	var inputcontent = '<input type="text" class="summernote" name="panel[\'content\']['+panelIndex+'] placeholder="Inhoud"/>';
	var hiddenfield = '<input type="hidden" name="panel[\'size\']['+panelIndex+']  value="'+size +'"/>'

	newDiv.innerHTML = label + inputtitle + inputcontent + hiddenfield;
	div.appendChild(newDiv);

	summer();
	panelIndex++;
}

function removePanel(link){
	var div = document.querySelector('#newPanels');
	newDiv = link.parentNode.parentNode;
	div.removeChild(newDiv);
}