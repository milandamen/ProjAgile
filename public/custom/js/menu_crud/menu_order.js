
function submitForm(){
    var menuForm = document.getElementById('menuForm');
    calculateOrder();

    //menuForm.submit();
}


function calculateOrder(){

    var fullMenuList = document.getElementById('fullMenuList');

    [].forEach.call(fullMenuList.children, function(liItem)
    {


        handleListItem(liItem);
    });

}

function handleListItem(liItem){
    console.log(liItem);

    [].forEach.call(liItem.children, function (item) {													// Get all elements in the li
        if (item.nodeType == 1) {																		// Is element of type html-object/tag
            if (item.tagName.toLowerCase() == 'ul' && item.classList.contains('space') && item.classList.contains('ui-sortable')) {		// Is element of tag ul and is the correct one
                if (item.children.length > 0){
                    [].forEach.call(item.children, function (liItemItem) {
                        handleListItem(liItemItem);
                    });
                }
            }
        }
    });
}