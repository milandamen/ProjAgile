function getPreview(){
	var previewDiv = $('.preview');
	previewDiv.css("display", "block");


	var previewFooter = $('.previewFooter');
	previewFooter.html("");
	// all needed information 
	var footerPanels = $('.summernote');
	var color = $('.footerColor').val();

	// make elements
	var previewElement = $('<div>');
	previewElement.addClass('col-md-12');
		
	previewElement.css( "background-color", color); 
	previewElement.css("padding", "10px 20px 20px 150px");
	previewElement.css("border-radius", "20px");
	previewElement.addClass("addmargin");

	footerPanels.each(function()
	{
		var panel = $(this).code();
		var panelDiv = $('<div>');
		panelDiv.addClass('col-md-4');
		panelDiv.html(panel);
		previewElement.append(panelDiv);
	});

	// add element to view
	previewFooter.append(previewElement);
}



// Event listeners for live preview!
$( "input" ).on(
    "keypress",
    function( eventObject ) {
		var previewDiv = $('.preview');
    	if(previewDiv.css("display") === "block"){
 		   getPreview();
   		}
    }
);

$('.summernote').summernote({
      		onChange: function() {
        	
        	var previewDiv = $('.preview');
        	if(previewDiv.css("display") === "block"){
        		getPreview();
        	}
}});


// If one can show a preview, they are also able to hide it. 

function hidePreview(){

	// hide element
	var previewDiv = $('.preview');
	previewDiv.css("display", "none");

	// clear element
	var previewFooter = $('.previewFooter');
	previewFooter.html("");

}