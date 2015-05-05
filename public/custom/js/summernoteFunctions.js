$(document).ready(function() 
{
	$('#summernote').summernote();
	summer();
});

/* 
*  Will start summernote editor on later added editor fields with class summernote.
*/
function summer()
{
	$('.summernote').summernote();
}

/* 
* Function validateSummer will validate a summernote text field width id summernote, 
* if called by the right validator function. 
*/
function validateSummer()
{
	var code = $('#summernote').code(),
	filteredContent = $(code).text().replace(/\s+/g, '');

	if(filteredContent.length <= 0) 
	{
		event.preventDefault();
		alert("Het veld 'inhoud' is niet ingevuld. Vul deze alstublieft in.");

		return false;
	}
}