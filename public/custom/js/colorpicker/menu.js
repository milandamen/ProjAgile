var menuColorField = document.getElementById('menucolor');
var menuBar = document.getElementById('menuBar');

$('#picker').colpick(
{
	flat:true,
	layout:'hex',
	submit:0,
	color: color,
	onChange:function(hsb,hex) 
	{
		menuColorField.value = hex;
		$(menuBar).css("background-color","#" + hex + "!important");
	}
});