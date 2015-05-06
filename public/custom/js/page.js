var panelIndex = document.getElementById("newPanels").getElementsByTagName("div").length;
document.getElementById('panelIndex').value = panelIndex;

var pagePanelsDiv = document.getElementById('newPanels');

function newPanel(size){

	var newPanelDiv = document.createElement("div");
	var label= '<h4 >Nieuw vak met grootte ' + size + '<a onclick="removePanel(this)" class="btn btn-danger btn-xs white"> Verwijder paneel</a></h4>';

	var inputtitle = '<input type="text" class="form-control" placeholder="Titel" name="panel['+panelIndex+'][title]"/><br/>';
	var inputcontent = '<textarea class="summernote" name="panel['+panelIndex+'][content]" placeholder="Inhoud"> </textarea>';
	var hiddenfield = '<input type="number" name="panel['+panelIndex+'][size]"  value="'+size+'" hidden/>';

	newPanelDiv.innerHTML = label + inputtitle + inputcontent + hiddenfield;
	pagePanelsDiv.appendChild(newPanelDiv);

	summer();
	panelIndex++;
}

function removePanel(link){
	
	oldPanelDiv = link.parentNode.parentNode;
	pagePanelsDiv.removeChild(oldPanelDiv);
}

function validate(){

	if (document.getElementById("title").value == "") {
        alert("Vul a.u.b. een titel in.");
        event.preventDefault();
        return false;
    }

	validateSummer();


}