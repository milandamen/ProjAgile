
function controlPublic(item){
	
	// getting al necessary information from view
	var route = getURL;							// getURL is set in the view as routelink and must not be changed. 
	var id = $(item).find("i").attr("name");

	// making the right url 
	route = route.replace("/0/", "/"+id+"/");		// replaces the /0/ part in the route url to the correct id. 
	var icon =  $(item).find("i");
	
	$.get(route).done(function() {
		if ($(icon).hasClass('fa fa-eye')){
			$(icon).removeClass('fa fa-eye').addClass('fa fa-eye-slash')
		}else{
			$(icon).removeClass('fa fa-eye-slash').addClass('fa fa-eye')
		}
	});
}