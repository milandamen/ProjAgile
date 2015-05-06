
/**
 * Author: Milan Damen (D'Arvit!)
 *
 * Execute an action for every element in the array that has a certain tag.
 * Useful for getting all elements with a certain tag.
 * For example: I want all 'input' elements in a div. (toplevel only)
 */
function execActionOnElementsInArray(array, tagname, func_action) {
	[].forEach.call(array, function (item) {										// Get all elements in the array
		if (item.nodeType == 1) {													// Is element of type html-object/tag
			if (item.tagName.toLowerCase() === tagname) {							// Is element of tag `tagname` and is hidden
				func_action(item);
			}
		}
	});
}


function verify(){
	return confirm('Weet u zeker dat u wilt verwijderen?');
}
