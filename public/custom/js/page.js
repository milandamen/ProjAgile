var panelIndex = document.getElementById("newPanels").getElementsByTagName("div").length;
document.getElementById('panelIndex').value = panelIndex;

var pagePanelsDiv = document.getElementById('newPanels');

function newPanel(size){

	var newPanelDiv = document.createElement("div");
	var label= '<h4 >Nieuw vak met grootte ' + size + '<a onclick="removePanel(this)" class="btn btn-danger btn-xs white"> Verwijder paneel</a><a onclick="up(this)" class="btn btn-primary white btn-xs addright"><i class="fa fa-arrow-up"></i></a> &nbsp; <a onclick="down(this)" class="btn btn-primary white btn-xs addright"><i class="fa fa-arrow-down"></i></a></h4>';

	var inputtitle = '<input type="text" class="form-control titlevalue" placeholder="Titel" name="panel['+panelIndex+'][title]"/><br/>';
	var inputcontent = '<textarea class="summer" name="panel['+panelIndex+'][content]" placeholder="Inhoud" rows="6"> </textarea>';
	var hiddenfield = '<input type="number" name="panel['+panelIndex+'][size]"  value="'+size+'" hidden/>';
	newPanelDiv.innerHTML = label + inputtitle + inputcontent + hiddenfield;
	pagePanelsDiv.appendChild(newPanelDiv);

	//summer();
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

    var children = pagePanelsDiv.children;
    for(i = 0;  i<children.length; i++){
		if(children[i].getElementsByClassName("summer")[0].value == ""){
			alert("Niet alle inhoudsvelden zijn ingevuld.");
        	event.preventDefault();
        	return false;
		}	
	}
	
	validateSummer();
}

function up(panel){
	panelDiv = panel.parentNode.parentNode;
	var children = pagePanelsDiv.children;
	var index =0;
	
	for(i = 0;  i<children.length; i++){
		if(children[i] == panelDiv ){
			index = i;
		}	
	}

	if(children[index-1] != null){
		switchPanels(children[index-1], children[index]);
	}
}

function down(panel){
	panelDiv = panel.parentNode.parentNode;
	var children = pagePanelsDiv.children;
	var index =0;
	
	for(i = 0;  i<children.length; i++){
		if(children[i] == panelDiv ){
			index = i;
		}	
	}

	if(children[index+1] != null){
		switchPanels(children[index+1], children[index]);
	}

}


function switchPanels(old, current){
	var temp = old.innerHTML;
	var oldValue = old.getElementsByClassName("titlevalue")[0].value;
	var oldContent = old.getElementsByClassName("summer")[0].value;

	var newValue = current.getElementsByClassName("titlevalue")[0].value;
	var newContent = current.getElementsByClassName("summer")[0].value;

	old.innerHTML = current.innerHTML;
	old.getElementsByClassName("titlevalue")[0].value = newValue;
	old.getElementsByClassName("summer")[0].value = newContent;

	current.innerHTML = temp;
	current.getElementsByClassName("titlevalue")[0].value = oldValue;
	current.getElementsByClassName("summer")[0].value = oldContent;
	
}



