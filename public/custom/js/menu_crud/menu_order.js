function submitForm()
{
	var menuForm = document.getElementById('menuForm');
	calculateOrder();

	menuForm.submit();
}

function calculateOrder()
{
	var fullMenuList = document.getElementById('fullMenuList');
	var parentOrder = 0;
	handleListItem(fullMenuList, parentOrder);
}

function handleListItem(liItem, parentOrder)
{
	var order = 1;

	// Get all elements in the li
	[].forEach.call(liItem.children, function (item) 
	{												                                	
		//Let's find the input field
		[].forEach.call(item.children, function (element) 
		{
			if (element.className == "menuGroupItem") 
			{
				element.value = parentOrder + '.' + order;
				order++;
			}

			if(element.tagName == "UL" && element.children.length > 0)
			{
				var temp = parentOrder;
				temp++;
				handleListItem(element, temp);
			}
		});
	});
}

function removeItem($item)
{
	var listItem = $item.parentNode.parentNode.parentNode;
	listItem.parentNode.removeChild(listItem);
}

function switchPublish($item)
{
    var listItem = $item.parentNode.parentNode.parentNode;
    var menuItemID = $(listItem).find('.menuGroupItem').attr('name');
    var iconObject =  $($item).find('i');
    $.get( getSwitchPublishMenuURL + '/' + menuItemID).done(function() {
        if ($(iconObject).hasClass('fa fa-eye')){
            $(iconObject).removeClass('fa fa-eye').addClass('fa fa-eye-slash')
        }else{
            $(iconObject).removeClass('fa fa-eye-slash').addClass('fa fa-eye')
        }
    });
}