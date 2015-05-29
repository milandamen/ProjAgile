var panelIndex = document.getElementById("newPanels").getElementsByTagName("div").length;
document.getElementById('panelIndex').value = panelIndex;

var pagePanelsDiv = document.getElementById('newPanels');

function newPanel(size)
{
	var newPanelDiv = document.createElement("div");
	var label= '<h4 >Nieuw vak met grootte ' + size + '<a onclick="removePanel(this)" class="btn btn-danger btn-xs white"> Verwijder paneel</a><a onclick="up(this)" class="btn btn-primary white btn-xs addright"><i class="fa fa-arrow-up"></i></a> &nbsp; <a onclick="down(this)" class="btn btn-primary white btn-xs addright"><i class="fa fa-arrow-down"></i></a></h4>';

	var inputtitle = '<input type="text" class="form-control titlevalue" placeholder="Titel" name="panel['+panelIndex+'][title]"/><br/>';
	var inputcontent = '<textarea class="summer form-control" name="panel['+panelIndex+'][content]" placeholder="Inhoud" rows="6"> </textarea>';
	var hiddenfield = '<input type="number" class="sizevalue" name="panel['+panelIndex+'][size]"  value="'+size+'" hidden/>';
	newPanelDiv.innerHTML = label + inputtitle + inputcontent + hiddenfield;
	pagePanelsDiv.appendChild(newPanelDiv);

	//summer();
	panelIndex++;
}

function removePanel(link)
{
	oldPanelDiv = link.parentNode.parentNode;
	pagePanelsDiv.removeChild(oldPanelDiv);
}

function validatePage()
{
	var success = true;

	if (document.getElementById("title").value == "") 
	{
		event.preventDefault();
		alert("Vul a.u.b. een titel in.");
		success = false;

		return false;
	}

	var children = pagePanelsDiv.children;
	for(i = 0;  i<children.length; i++)
	{
		if(children[i].getElementsByClassName("summer")[0].value == "")
		{
			event.preventDefault();
			alert("Niet alle inhoudsvelden zijn ingevuld.");
			success = false;

			return false;
		}
	}

	if (!moment([document.querySelector('#publishStartDate').value, 'nl', true]).isValid())
	{
		event.preventDefault();
		alert('Selecteer alstublieft een datum en een tijdstip voor de Publicatiedatum.');

		return false;
	}
	var publishStartDate = moment([document.querySelector('#publishStartDate').value]);

	if (!moment([document.querySelector('#publishEndDate').value, 'nl', true]).isValid())
	{
		event.preventDefault();
		alert('Selecteer alstublieft een datum en een tijdstip voor de Einde Publicatiedatum.');

		return false;
	}
	var publishEndDate = moment([document.querySelector('#publishEndDate').value]);

	// Deze vergelijking werkt niet!!!
	// if (publishStartDate.isAfter(publishEndDate) || 
	// 	publishStartDate.isSame(publishEndDate))
	// {
	// 	event.preventDefault();
	// 	alert('Selecteer alstublieft een startdatum en een tijdstip vóór de Einde Publicatiedatum.');

	// 	return false;
	// }


	if(!validateSummer())
	{
		success = false;
	}

	if(success)
	{
		newOnSiteValidate();
		
	}
}

function up(panel)
{
	panelDiv = panel.parentNode.parentNode;
	var children = pagePanelsDiv.children;
	var index =0;
	
	for(i = 0;  i<children.length; i++)
	{
		if(children[i] == panelDiv )
		{
			index = i;
		}	
	}

	if(children[index-1] != null)
	{
		switchPanels(children[index-1], children[index]);
	}
}

function down(panel)
{
	panelDiv = panel.parentNode.parentNode;
	var children = pagePanelsDiv.children;
	var index =0;
	
	for(i = 0;  i<children.length; i++)
	{
		if(children[i] == panelDiv )
		{
			index = i;
		}	
	}

	if(children[index+1] != null)
	{
		switchPanels(children[index+1], children[index]);
	}
}

function getPreview(){

	var preview = document.querySelector('.preview');
	preview.style.display = 'block';

	pagePanelsDiv = document.getElementById('newPanels');

	// setup a fake menu bar
	var menu = document.querySelector('.previewMenu');
	menu.style.visibility = 'visible';


	// get all current content
	var row = document.querySelector(".side");
	var title = document.querySelector('.title');
	var subtitle = document.querySelector('.subtitle');
	var sidebar = document.querySelector('#sidebarOn');
	var intro = $('#summernote').code();


	var titlediv = document.createElement("div");
	titlediv.className = "col-md-12";
	titlediv.innerHTML = "<h2 class=page-header>" + title.value + "</h2>";

	var subdiv = document.createElement("div");
	subdiv.className = "col-md-8";
	subdiv.innerHTML  = "<h4>"+ subtitle.value +"</h4>";

	var headerbar = document.createElement("div");
	headerbar.className = "row";
	var rowdiv = document.createElement("div");
	rowdiv.className = "col-md-12";

	headerbar.appendChild(titlediv);
	headerbar.appendChild(rowdiv);
	headerbar.appendChild(subdiv);

	var titlesdiv = document.querySelector(".previewTitles");
	titlesdiv.innerHTML = "";
	titlesdiv.appendChild(headerbar);


 	// show intro
	var introdiv = document.createElement("div");
	introdiv.className = "col-md-8";
	introdiv.innerHTML = intro;
	
	row.innerHTML = "";
	row.appendChild(introdiv);

	var sidecol = document.createElement("div");
		sidecol.className = "col-md-4";
		sidecol.innerHTML = "";

	// show sidebar
	if(sidebar.checked){
		var side = document.createElement("div");
		side.className = "panel panel-default";

		var sideHeader = document.createElement("div");
		sideHeader.className = "panel-heading sidebar";
		sideHeader.innerHTML = "<h4>Sidebar Title</h4>";

		var sideBody = document.createElement("div");
		sideBody.className = "panel-body";
		sideBody.innerHTML = '<ul><li class="sidebar"><a href="#">&gt; Home	</a></li></ul>';

		side.appendChild(sideHeader);
		side.appendChild(sideBody);
		sidecol.appendChild(side);

		row.appendChild(sidecol);
	} else {
		sidecol.innerHTML = "";
	}


	// Preview all panels 
	var previewPanels = document.querySelector('#previewPanels');
	previewPanels.innerHTML = "";
	var children = pagePanelsDiv.children;
	var index =0;
	
	for(i = 0;  i<children.length; i++)
	{
		
		var previewPanel = document.createElement("div");
		previewPanel.className =  'col-md-' + children[i].getElementsByClassName('sizevalue')[0].value; 

		var panel = document.createElement("div");
		panel.className = 'panel panel-default';


		if(children[i].getElementsByClassName('titlevalue')[0].value != ''){
			
			var title =  document.createElement("div");
			title.className = 'panel-heading';
			title.innerHTML = children[i].getElementsByClassName('titlevalue')[0].value;

			var content = document.createElement("div");
			content.className = 'panel-body';
			content.innerHTML = children[i].getElementsByClassName('summer')[0].value;

			panel.appendChild(title);
			panel.appendChild(content);

		} else {
			var content = document.createElement("div");
			content.className = 'panel-body';
			content.innerHTML = children[i].getElementsByClassName('summer')[0].value;
			panel.appendChild(content);
			
		}

		previewPanel.appendChild(panel);
		previewPanels.appendChild(previewPanel);
	}

	return true;
}


// Event listeners for live preview!
$( "textarea" ).on(
	"keypress",
	function( eventObject ) {
		var previewDiv = $('.preview');
		if(previewDiv.css("display") === "block"){
			getPreview();
		}
	}
);

$( "input" ).on(
	"keypress",
	function( eventObject ) {
		var previewDiv = $('.preview');
		if(previewDiv.css("display") === "block"){
			getPreview();
		}
	}
);

$('#summernote').summernote({
	onChange: function() {
		var previewDiv = $('.preview');
		if(previewDiv.css("display") === "block"){
			getPreview();
		}
}});



function hidePreview(){
	var preview = document.querySelector('.preview');
	preview.style.display = 'none';

	var menu = document.querySelector('.previewMenu');
	menu.style.visibility = 'hidden';

	// empty all panels
	var previewPanels = document.querySelector('#previewPanels');
	previewPanels.innerHTML = "";

	var row = document.querySelector(".side");
	row.innerHTML = "";

	var titlesdiv = document.querySelector(".previewTitles");
	titlesdiv.innerHTML = "";

}


function switchPanels(old, current)
{
	var temp = old.innerHTML;
	var oldValue = old.getElementsByClassName("titlevalue")[0].value;
	var oldContent = old.getElementsByClassName("summer")[0].value;

	// var oldSummer = $(old.getElementsByClassName("summernote")[0]).code();
	// var newSummer = $(current.getElementsByClassName("summernote")[0]).code();

	var newValue = current.getElementsByClassName("titlevalue")[0].value;
	var newContent = current.getElementsByClassName("summer")[0].value;

	old.innerHTML = current.innerHTML;
	old.getElementsByClassName("titlevalue")[0].value = newValue;
	old.getElementsByClassName("summer")[0].value = newContent;

	current.innerHTML = temp;
	current.getElementsByClassName("titlevalue")[0].value = oldValue;
	current.getElementsByClassName("summer")[0].value = oldContent;
}



