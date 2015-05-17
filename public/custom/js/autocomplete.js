$(function() 
{
	$(".autocomplete").autocomplete(
	{
		source: autocompleteURL,
		minLength: 2
	});
});