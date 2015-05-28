$(function()
{
	$('#newFile').click(function()
	{
		addFile();
	});

	$('[name="fileUpload"]').on('click', '[name="deleteFile"]', function()
	{
		deleteFile(this);
	});
});


$('#newDistrictSection').click(function()
{
	$('.districtBox').last().clone().addClass('col-md-6').appendTo('#districts');

	addRemoveDistrictListener();
});

function addRemoveDistrictListener()
{
	$('.deleteDistrictSection').click(function()
	{
		if($('.districtSelect').length > 1)
		{
			$(this).parent().remove();
		}
		else
		{
			alert('U moet minstens één deelwijk selecteren!');
		}
	});

	$('.deleteDistrictSectionSpan').click(function()
	{
		if($('.districtSelect').length > 1)
		{
			$(this).parent().parent().remove();
		}
		else
		{
			alert('U moet minstens één deelwijk selecteren!');
		}
	});
}

addRemoveDistrictListener();


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

function validateNews()
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

	var districtSections = document.querySelectorAll('.districtSelect');

	console.log(districtSections);

	for(var i = 0; i < districtSections.length; i++)
	{
		console.log('test');
		var district = districtSections[i];

		for(var j = i + 1; j < districtSections.length; j++)
		{
			if(district.value == districtSections[j].value)
			{
				event.preventDefault();
				alert('U heeft meerdere malen dezelfde deelwijk geselecteerd. U kunt maar één keer dezelfde deelwijk kiezen.');
				return false;
			}
		}
	}

	[].forEach.call(districtSections, function(districtSection)
	{
		if (districtSection.value === "")
		{
			event.preventDefault();
			alert('Selecteer alstublieft een deelwijk.');
			return false;
		}
	});

	if (!moment([document.querySelector('#publishStartDate').value, 'nl', true]).isValid())
	{
		event.preventDefault();
		alert('Selecteer alstublieft een datum en een tijdstip voor de Publicatiedatum.');

		return false;
	}
	var publishStartDate = moment([document.querySelector('#publishStartDate').value]);

	if (!moment([document.querySelector('#publishEndDate').value, 'nl', true]).isValid())
	{
		event.preventDefault();
		alert('Selecteer alstublieft een datum en een tijdstip voor de Einde Publicatiedatum.');

		return false;
	}
	var publishEndDate = moment([document.querySelector('#publishEndDate').value]);

	if (publishStartDate.isAfter(publishEndDate) || 
		publishStartDate.isSame(publishEndDate))
	{
		event.preventDefault();
		alert('Selecteer alstublieft een startdatum en een tijdstip vóór de Einde Publicatiedatum.');

		console.log(publishStartDate);
		console.log(publishEndDate);

		return false;
	}

	var fileFields = document.querySelectorAll('#file');
	var allowedMimeTypes = 
	[
		'application/msword', //doc
		'application/pdf', //pdf
		'application/vnd.ms-excel', //xls
		'application/vnd.ms-powerpoint', //ppt
		'application/vnd.ms-xpsdocument', //xps
		'application/vnd.oasis.opendocument.image', //odi
		'application/vnd.oasis.opendocument.presentation', //odp
		'application/vnd.oasis.opendocument.spreadsheet', //ods
		'application/vnd.oasis.opendocument.text', //odt
		'application/vnd.openxmlformats-officedocument.presentationml.presentation', //pptx
		'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', //xslx
		'application/vnd.openxmlformats-oficedocument.wordprocessingml.document', //docx
		'application/vnd.openxmlformats-officedocument.wordprocessingml.template', //dotx
		'application/xml', //xml
		'image/gif', //gif
		'image/jpeg', //jpeg
		'image/png', //png
		'text/plain', //txt
		'text/rtf', //rtf
	];
	var allowedMimeTypesAliases =
	[
		'docx',
		'pdf',
		'xls',
		'ppt',
		'xps',
		'odi',
		'odp',
		'ods',
		'odt',
		'pptx',
		'xlsx',
		'docx',
		'dotx',
		'xml',
		'gif',
		'jpeg',
		'png',
		'plain',
		'rtf'
	];

	[].forEach.call(fileFields, function(fileField)
	{
		if (fileField.value !== "")
		{
			[].forEach.call(fileField.files, function(file)
			{
				if (allowedMimeTypes.indexOf(file.type) < 0)
				{
					event.preventDefault();

					var feedback = "Eén van de bestanden is niet van het juiste bestandstype. " + 
								   "\nU mag alleen bestanden uploaden van het bestandstype ";

					[].forEach.call(allowedMimeTypesAliases, function(allowedMimeTypeAlias)
					{
						feedback += allowedMimeTypeAlias + ", ";
					});
					feedback += ".";

					alert(feedback);

					return false;
				}
			});
		}
	});

	if ($('input[name="hidden"]:checked').val() === "")
	{
		event.preventDefault();
		alert('Selecteer alstublieft een optie om te verbergen of niet.');

		return false;
	}

	if ($('input[name="commentable"]:checked').val() === "")
	{
		event.preventDefault();
		alert('Selecteer alstublieft een optie om commentaar toe te staan of niet.');
		
		return false;
	}

	if ($('input[name="top"]:checked').val() === "")
	{
		event.preventDefault();
		alert('Selecteer alstublieft een optie om dit artikel bovenaan de pagina te vertonen of niet.');

		return false;
	}
}