var footerColorField = document.getElementById('footerColor');

$('#picker').colpick({
	flat:true,
	layout:'hex',
	submit:0,
	color: color,
	onChange:function(hsb,hex) {
		footerColorField.value = '#'+hex;
	}
});

