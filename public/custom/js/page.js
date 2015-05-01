var panelIndex = document.getElementById("newPanels").getElementsByTagName("div").length;
document.getElementById('panelIndex').value = panelIndex;


function newPanel(size){
	var div = document.querySelector('#newPanels');

	var newDiv = document.createElement("div");
	var label= '<h4 >Nieuw vak met grootte ' + size + '<a onclick="removePanel(this)" class="btn btn-danger btn-xs white"> Verwijder paneel</a></h4>';

	var inputtitle = '<input type="text" class="form-control" placeholder="Titel" name="panel['+panelIndex+'][title]"/><br/>';
	var inputcontent = '<textarea class="summernote" name="panel['+panelIndex+'][content]" placeholder="Inhoud"> </textarea>';
	var hiddenfield = '<input type="number" name="panel['+panelIndex+'][size]"  value="'+size+'" hidden/>';

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

function validate(){

	if (document.getElementById("title").value == "") {
        alert("Vul a.u.b. een titel in.");
        event.preventDefault();
        return false;
    }

	var code = $('#summernote').code(),
    filteredContent = $(code).text().replace(/\s+/g, '');

	if(filteredContent.length > 0) {
	    // content is not empty
	} else {
	   	alert("De pagina introductie heeft geen inhoud, voer deze alstublieft in.");
        event.preventDefault();
        return false;
	}


}