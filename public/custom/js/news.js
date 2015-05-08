$(function()
{
	$('#newDistrictSection').click(function()
	{
		addDistrictSection();
	});

	$('#newFile').click(function()
	{
		addFile();
	});

	$('[name="districtSections"]').on('click', '[name="deleteDistrictSection"]', function()
	{
		deleteDistrictSection(this);
	});

	$('[name="fileUpload"]').on('click', '[name="deleteFile"]', function()
	{
		deleteFile(this);
	});
});

function addDistrictSection()
{
	var districtSections = document.querySelectorAll('#districtSection');
	var adjacentElement = districtSections[districtSections.length - 1];
	var deleteButton = document.querySelector('button[name="deleteDistrictSection"]');

	if (districtSections.length < adjacentElement.length)
	{
		var dropdownElement = adjacentElement.cloneNode(true);
		dropdownElement.setAttribute('name', 'districtSection[' + districtSections.length + ']');

		var newDeleteButton = deleteButton.cloneNode(true);

		var tr = adjacentElement.parentNode.parentNode.cloneNode(false);
		var tdDistrictSection = adjacentElement.parentNode.cloneNode(false);
		var tdDeleteButton = deleteButton.parentNode.cloneNode(false);

		tr.appendChild(tdDistrictSection);
		tr.appendChild(tdDeleteButton);
		tdDistrictSection.appendChild(dropdownElement);
		tdDeleteButton.appendChild(newDeleteButton);

		adjacentElement.parentNode.parentNode.parentNode.appendChild(tr);
	}
}

function addFile()
{
	var files = document.querySelectorAll('#file');
	var adjacentElement = files[files.length - 1];
	var deleteButton = document.querySelector('button[name="deleteFile"]');

	var fileElement = adjacentElement.cloneNode(false);
	fileElement.setAttribute('name', 'file[' + files.length + ']');

	var newDeleteButton = deleteButton.cloneNode(true);

	var tr = adjacentElement.parentNode.parentNode.cloneNode(false);
	var tdFile = adjacentElement.parentNode.cloneNode(false);
	var tdDeleteButton = deleteButton.parentNode.cloneNode(false);

	tr.appendChild(tdFile);
	tr.appendChild(tdDeleteButton);
	tdFile.appendChild(fileElement);
	tdDeleteButton.appendChild(newDeleteButton);

	adjacentElement.parentNode.parentNode.parentNode.appendChild(tr);
}

function deleteDistrictSection(button) 
{
	var row = button.parentNode.parentNode;
	var districtSections = document.querySelectorAll('#districtSection');

	if (districtSections.length > 1)
	{
		row.parentNode.removeChild(row);
		calculateDistrictSectionsIndexes();
	}
	else
	{
		row.innerHTML = row.innerHTML;
	}
}

function deleteFile(button) 
{
	var row = button.parentNode.parentNode;
	var files = document.querySelectorAll('#file');

	if (files.length > 1)
	{
		row.parentNode.removeChild(row);
		calculateFileIndexes();
	}
	else
	{
		row.innerHTML = row.innerHTML;
	}
}

function calculateDistrictSectionsIndexes() 
{
	var i = 0;
	var districtSectionList = document.querySelector('table[name="districtSections"]');
	
	[].forEach.call(districtSectionList.children, function(row) 
	{
		var districtSections = districtSectionList.querySelectorAll('#districtSection');
		[].forEach.call(districtSections, function(districtSection)
		{
			districtSection.setAttribute('name', 'districtSection[' + i + ']');
			i++;
		});
	});
}

function calculateFileIndexes() 
{
	var i = 0;
	var fileList = document.querySelector('table[name="fileUpload"]');
	
	[].forEach.call(fileList.children, function(row) 
	{
		var files = fileList.querySelectorAll('#file');
		[].forEach.call(files, function(file)
		{
			file.setAttribute('name', 'file[' + i + ']');
			i++;
		});
	});
}

function validate()
{
	if (document.querySelector('input[name="title"]').value === "")
	{
		event.preventDefault();
		alert('Vul alstublieft een titel in.');

		return false;
	}

	if (!validateSummer())
	{
		event.preventDefault();

		return false;
	}

	var districtSections = document.querySelectorAll('#districtSection');

	[].forEach.call(districtSections, function(districtSection)
	{
		if (districtSection.length <= 0)
		{
			event.preventDefault();
			alert('Selecteer alstublieft een deelwijk.');

			return false;
		}
	});

	if (document.querySelector('#publishStartDate').value === "")
	{
		event.preventDefault();
		alert('Selecteer alstublieft een datum en een tijdstip voor de PublicatieDatum.');

		return false;
	}

	if (document.querySelector('#publishEndDate').value === "")
	{
		event.preventDefault();
		alert('Selecteer alstublieft een datum en een tijdstip voor de Einde PublicatieDatum.');

		return false;
	}

	var files = document.querySelectorAll('#file');
	var allowedMimeTypes = 
	[
		'image/jpeg',
		'image/png',
		'application/pdf'
	];

	[].forEach.call(files, function(file)
	{
		if (allowedMimeTypes.indexOf(file.type) < 0)
		{
			event.preventDefault();
			alert('Eén van de bestanden is niet van het juiste bestandstype. ' + 
				  '\nU mag alleen bestanden uploaden van het bestandstype jpeg, png en pdf.');

			return false;
		}
	});

	if (document.querySelector('input[name="hidden"]').value === "")
	{
		event.preventDefault();
		alert('Selecteer alstublieft een optie om te verbergen of niet.');

		return false;
	}

	if (document.querySelector('input[name="commentable"]').value === "")
	{
		event.preventDefault();
		alert('Selecteer alstublieft een optie om commentaar toe te staan of niet.');

		return false;
	}

	if (document.querySelector('input[name="top"]').value === "")
	{
		event.preventDefault();
		alert('Selecteer alstublieft een optie om dit artikel bovenaan de pagina te vertonen of niet.');

		return false;
	}
}