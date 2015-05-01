function submitForm(){
    var menuForm = document.getElementById('menuForm');
    calculateOrder();

    menuForm.submit();
}


function calculateOrder(){

    var fullMenuList = document.getElementById('fullMenuList');
    var parentOrder = 0;
    handleListItem(fullMenuList, parentOrder);
}

function handleListItem(liItem, parentOrder){

    var order = 1;
    [].forEach.call(liItem.children, function (item) {												                                	// Get all elements in the li
        //Let's find the input field
        [].forEach.call(item.children, function (element) {
            if (element.className == "menuGroupItem") {
                element.value = parentOrder + '.' + order;
                order++;
                console.log(order);
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