/*
	This script enables dragging elements on pages and then sending the order configuration to the server.
	Examples of the use of this script available at: /Home/editlayout
	
	Tutorial: 	http://www.html5rocks.com/en/tutorials/dnd/basics/
	Edited by: 	Milan Damen
	Copyright:	Avans Hogeschool
	Date: 		08-March-2015
*/

/****************************/
/****  Element dragging  ****/
/****************************/

var dragSrcEl = null;

function handleDragStart(e) {
	// this / e.target is the source node.
	this.style.opacity = '0.4';
	
	dragSrcEl = this;
	
	e.dataTransfer.effectAllowed = 'move';
	e.dataTransfer.setData('text/html', this.innerHTML);
}

function handleDragOver(e) {
	if (e.preventDefault) {
		e.preventDefault(); // Necessary. Allows us to drop.
	}
	
	e.dataTransfer.dropEffect = 'move';  // See the section on the DataTransfer object.
	
	return false;
}

function handleDragEnter(e) {
	// this / e.target is the current hover target.
	this.classList.add('dragborder');
}

function handleDragLeave(e) {
	// this / e.target is previous target element.
	this.classList.remove('dragborder');
}

function handleDrop(e) {
	// this / e.target is current target element.
	
	if (e.stopPropagation) {
		e.stopPropagation(); // stops the browser from redirecting.
	}
	
	// Don't do anything if dropping the same dragdiv we're dragging.
	dragSrcEl.style.opacity = '1';
	if (dragSrcEl != this) {
		// Swap the HTML of the elements
		dragSrcEl.innerHTML = this.innerHTML;
		this.innerHTML = e.dataTransfer.getData('text/html');
		
		// Swap the classlists of the elements
		swapClassList(dragSrcEl, this);
		
		// Swap the names of the elements
		
	}
	
	return false;
}

function handleDragEnd(e) {
	// this / e.target is the source node.
	dragSrcEl.style.opacity = '1';
	
	[].forEach.call(dragdivs, function (dragdiv) {
		dragdiv.classList.remove('dragborder');
	});
}

/**
	Apply event listeners to the draggable divs
	Apply 'draggable' property to the draggable divs
*/
var dragdivs = document.querySelectorAll('#draggabledivs .dragdiv');
[].forEach.call(dragdivs, function(dragdiv) {
	dragdiv.addEventListener('dragstart', handleDragStart, false);
	dragdiv.addEventListener('dragenter', handleDragEnter, false)
	dragdiv.addEventListener('dragover', handleDragOver, false);
	dragdiv.addEventListener('dragleave', handleDragLeave, false);
	dragdiv.addEventListener('drop', handleDrop, false);
	dragdiv.addEventListener('dragend', handleDragEnd, false);
	
	dragdiv.draggable = 'true';
});

/************************************/
/****  Swapping of element data  ****/
/************************************/

/**
	Swaps the class lists of two elements.
*/
function swapClassList(el1, el2) {
	var el1ClassListArray = classListToArray(el1.classList);
	var el2ClassListArray = classListToArray(el2.classList);
	
	clearClassList(el1, el1ClassListArray);
	clearClassList(el2, el2ClassListArray);
	
	fillClassList(el1, el2ClassListArray);
	fillClassList(el2, el1ClassListArray);
}

/**
	Creates a copy of type Array of the specified list.
*/
function classListToArray(list) {
	var ar = [];
	[].forEach.call(list, function (item) {
		ar.push(item);
	});
	
	return ar;
}

/**
	Removes the in 'listArray' specified classes from the element.
*/
function clearClassList(el, listArray) {
	[].forEach.call(listArray, function (item) {
		el.classList.remove(item);
	});
}

/**
	Adds the in 'listArray' specified classes to the element.
*/
function fillClassList(el, listArray) {
	[].forEach.call(listArray, function (item) {
		el.classList.add(item);
	});
}

/***************************/
/****  Form submitting  ****/
/***************************/

/**
	Submits the data form.
*/
function submitLayoutForm() {
	console.log('Submitting form..');
	
	var form = document.forms['dataform'];
	calculateElementOrderValues(form);
	form.submit();
	
	console.log('Done submitting form.');
}

/**
	Calculates and applies to the elements the order in which they are placed.
*/
function calculateElementOrderValues(form) {
	var i = 0;
	
	[].forEach.call(form.elements, function (item) {													// Get all elements in the form
		if (item.nodeType == 1) {																		// Is element of type html-object/tag
			if (item.tagName.toLowerCase() == 'input' && item.classList.contains('hiddenInput')) {		// Is element of tag input and is hidden
				item.value = i;
				i++;
				alert(i);
			}
		}
	});
}