//nog in gebruik in andere onderdelen (o.a. sidebar en intro)
function validate()
{
	var message = prompt('Wilt u de wijzigingen ook tonen in "Nieuw op de site" ? (max. 30 karakters)');

	if(message != null)
	{
		while(message.length > 30)
		{
			message = prompt("Maximaal aantal karakters is 30. Verkort uw bericht.", message)
		}
	}

	if(message != null && message != '')
	{
		document.getElementById("newOnSiteCheck").value = "TRUE";
		document.getElementById("newOnSiteMessage").value = message;
	}

	return true;
}

$('input[type=radio][name=newOnSite]').change(function() {
	if (this.value == 'true') {
		$('#newOnSiteGroup').append('<div class="row newOnSiteMessage">' +
		'<div class="form-group col-sm-4">' +
		'<br/>'+
		'<label class="control-label col-sm-2">Bericht:</label>'+
		'<div class="col-sm-10">'+
		'<input type="text" class="form-control" id="message" name="newOnSiteMessage" maxlength="30">'+
		'</div>'+
		'</div>'+
		'</div>');
	}
	else if (this.value == 'false') {
		$('.newOnSiteMessage').remove();
	}
});

// The input box and styling for page is just one bit different.. 
$('input[type=radio][name=newOnSite]').change(function() {
	if (this.value == 'true') {
		if($('#newOnSiteGroupPage') != null){
			$('#newOnSiteGroupPage').append('<div class="newOnSiteMessage">' +
			'<div class="form-group col-sm-8">' +
			'<br/>'+
			'<label class="control-label col-sm-2">Bericht:</label>'+
			'<div class="col-sm-10">'+
			'<input type="text" class="form-control" id="message" name="newOnSiteMessage" maxlength="30">'+
			'</div>'+
			'</div>'+
			'</div>');
		}
	}
	else if (this.value == 'false') {
		$('.newOnSiteMessage').remove();
	}
});



function newOnSiteValidate()
{
	if($('#message').val() == ''){
		alert('Nieuw op de site bericht mag niet leeg gelaten worden!');
		event.preventDefault();
		return false;
	}
}

