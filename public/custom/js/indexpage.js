
function controlPublic(item){
	
	var url = getURL;
	var id = $(item).find("i").attr("name");
	url = url.replace("/0/", "/"+id+"/");
	var icon =  $(item).find("i");
		
	console.log(icon);

	$.get(url).done(function() {
		if ($(icon).hasClass('fa fa-eye')){
			$(icon).removeClass('fa fa-eye').addClass('fa fa-eye-slash')
		}else{
			$(icon).removeClass('fa fa-eye-slash').addClass('fa fa-eye')
		}
	});
}