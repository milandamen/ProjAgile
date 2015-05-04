/* 
 * Start summernote editor if page is loaded.
 */

$(document).ready(function() {
  $('#summernote').summernote();
  summer();
});

/* 
 *  Will start summernote editor on later added editor fields with class summernote.
 */
function summer(){
	$('.summernote').summernote();
}

/* 
 *  Function validateSummer will validate a summernote text field width id summernote, 
 * 	if called by the right validator function. 
 */

function validateSummer(){
	var success = true;

	// For a single field
	var code = $('#summernote').code(),
    filteredContent = $(code).text().replace(/\s+/g, '');

	if(filteredContent.length > 0) {
	    // content is not empty
	} else {
	   	alert("Het veld 'inhoud' is niet ingevuld, vul deze alstublieft in.");
        success = false;
	}

 	// For multiple field.

	var code = $('.summernote').each(function(){
     	var panel = $(this).code();

     	var paneltext = $(panel).text();
     	console.log(paneltext);
		filteredContent = $(panel).text().replace(/\s+/g, '');

		if(filteredContent.length > 0) {
		    // content is not empty
		} else {
		   	alert("Het panelveld 'inhoud' is bij een van de panels niet ingevuld, vul deze alstublieft in.");
	        success = false;
		}

	});

	event.preventDefault();
	return false;

}