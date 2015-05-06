$(function()
{
	$('#newDistrictSection').click(function()
	{
		addDistrictSection();
	});
});

function addDistrictSection()
{
	var districtSections = document.querySelectorAll('#districtSection');
	var adjacentElement = districtSections[districtSections.length - 1];
	var newDiv = adjacentElement.parentNode.cloneNode(false);

	$.getJSON(getDistrictSectionsURL).done(function(data)
	{
		[].forEach.call(data, function(item)
		{

		});

		var dropdownElement = document.createElement('select');
		dropdownElement.setAttribute('id', 'districtSection');
		dropdownElement.setAttribute('class', 'form-control');
		dropdownElement.setAttribute('name', 'districtSection[' + districtSections.length + ']');

		var count = 0;

		[].forEach.call(data, function(item)
		{
			var option = document.createElement('option');
			option.setAttribute('value', item.districtSectionId);
			option.text = item.name;
			dropdownElement.appendChild(option);

			count++;
		});

		if (districtSections.length < count)
		{
			newDiv.appendChild(dropdownElement);

			var spacer = document.createElement('div');
			spacer.setAttribute('class', 'col-md-1');
			
			adjacentElement.parentNode.parentNode.appendChild(spacer);
			adjacentElement.parentNode.parentNode.appendChild(newDiv);
		}
	}).fail(function(jqxhr, textStatus, error) 
	{
		var err = textStatus + ', ' + error;
		console.log('Request failed: ' + err);
	});
}