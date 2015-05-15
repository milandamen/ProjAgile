
/**
 * Is there a fade duration set for the carousel? If not, set it to a default value.
 */
try {
	if (carousel_transition_duration) {}
} catch(e) {
	carousel_transition_duration = 1000;													// The default duration is 1 second, unless otherwise specified.
}

/**
 * Is there an interval set for the carousel? If not, set it to a default value.
 */
try {
	if (carousel_transition_interval) {
		if (carousel_transition_interval <= carousel_transition_duration) {
			carousel_transition_interval = carousel_transition_duration + 4000;				// The default interval is 5 seconds, unless otherwise specified.
		}
	}
} catch(e) {
	carousel_transition_interval = carousel_transition_duration + 4000;						// The default interval is 5 seconds, unless otherwise specified.
}

var carousel = document.getElementById('mod-carousel');
var carousel_imagelist_div = document.getElementById('mod-carousel-images');
var carousel_descriptionlist_div = document.getElementById('mod-carousel-description');
var carousel_linklist_div = document.getElementById('mod-carousel-linklist');
var carousel_imagelist = [];
var carousel_descriptionlist = [];
var carousel_linklist = [];
var carousel_selected_i = 0;
var carousel_selected_i_old = 0;
var carousel_selected_img = null;
var carousel_selected_description = null;
var carousel_selected_link = null;
var carousel_special_transition = false;
var carouselIntervalId = 0;

execActionOnElementsInArray(carousel_imagelist_div.children, 'a', function (item) {
	carousel_imagelist.push(item);
});
makeImagesInvisible(carousel_imagelist);
makeH3Invisible(carousel_imagelist);

// TODO FILL carousel_descriptionlist

execActionOnElementsInArray(carousel_linklist_div.children, 'div', function (item) {
	carousel_linklist.push(item);
	item.classList.remove('table-shade-selected');
});

var carousel_count = carousel_imagelist.length;

if (!carousel_imagelist.length === carousel_linklist.length) {
	console.log('ERROR: the number of elements in imagelist is not equal to that in linklist!');
	
	if (carousel_imagelist.length > carousel_linklist.length) {
		carousel_count = carousel_linklist.length;
	}
}

/** Set-up the carousel for first use. **/
if (carousel_count !== 0) {
	carousel_selected_i = 0;
	carousel_selected_img = carousel_imagelist[0];
	carousel_selected_link = carousel_linklist[0];
	carousel_selected_link.classList.add('table-shade-selected');
	
	if (carousel_count !== 1) {
		carousel_selected_i = 0;
		carouselIntervalId = setInterval('carouselTransition(-1)', carousel_transition_interval);
	}
} else {
	console.log('ERROR: carousel_count = 0; hiding caorusel..')
	carousel.style.display = 'none';				// Hide the whole carousel if there are no items to display.
}

function carouselTransition(new_sel_i) {
	if (new_sel_i === -1) {
		new_sel_i = carousel_selected_i + 1;
		carousel_special_transition = false;
	} else {
		carousel_special_transition = true;
	}
	
	carousel_selected_i_old = carousel_selected_i;
	carousel_selected_i = new_sel_i;
	
	if (carousel_selected_i >= carousel_count) {
		carousel_selected_i = 0;
	}
	
	var carousel_selected_img_old = carousel_selected_img;					// tag a
	var carousel_selected_link_old = carousel_selected_link;				// tag div
	carousel_selected_img = carousel_imagelist[carousel_selected_i];		// tag a
	carousel_selected_link = carousel_linklist[carousel_selected_i];		// tag div
	
	var c_sel_img_img = null;												// tag img
	var c_sel_img_text = null;												// tag h3
	execActionOnElementsInArray(carousel_selected_img.children, 'img', function (item) {
		c_sel_img_img = item;
	});
	execActionOnElementsInArray(carousel_selected_img.children, 'h3', function (item) {
		c_sel_img_text = item;
	});
	
	var c_sel_img_old_img = null;											// tag img
	var c_sel_img_old_text = null;											// tag h3
	execActionOnElementsInArray(carousel_selected_img_old.children, 'img', function (item) {
		c_sel_img_old_img = item;
	});
	execActionOnElementsInArray(carousel_selected_img_old.children, 'h3', function (item) {
		c_sel_img_old_text = item;
	});
	
	// Imagelist side
	$(c_sel_img_img).fadeIn(carousel_transition_duration);
	$(c_sel_img_old_img).fadeOut(carousel_transition_duration);
	$(c_sel_img_text).fadeIn(carousel_transition_duration);
	$(c_sel_img_old_text).fadeOut(carousel_transition_duration);
	
	// Description side
	
	
	// Linklist side
	$(carousel_selected_link_old).delay(carousel_transition_duration/2).removeClass('table-shade-selected');
	$(carousel_selected_link).delay(carousel_transition_duration/2).addClass('table-shade-selected');
	
	if (carousel_special_transition) {
		clearInterval(carouselIntervalId);
		carouselIntervalId = setInterval('carouselTransition(-1)', carousel_transition_interval);
	}
}

function makeImagesInvisible(array) {
	var first = true;
	[].forEach.call(array, function(a) {
		if (first) {
			first = false;
		} else {
			execActionOnElementsInArray(a.children, 'img', function (item) {
				$(item).fadeOut(0);
			});
		}
	});
}

function makeH3Invisible(array) {
	var first = true;
	[].forEach.call(array, function(a) {
		if (first) {
			first = false;
		} else {
			execActionOnElementsInArray(a.children, 'h3', function (item) {
				$(item).fadeOut(0);
			});
		}
	});
}

function goToSlide(tableItem) {
	
	var found = false;
	var i = 0;
	execActionOnElementsInArray(carousel_linklist, 'div', function (item) {
		if (!found) {
			if (tableItem === item) {
				found = true;
			} else {
				i++;
			}
		}
	});
	
	if (found) {
		clearInterval(carouselIntervalId);
		carouselTransition(i);
	}
	
}

function evenlySpaceLinklistDivs() {
	var newHeight = 100 / carousel_linklist.length;			// in percentages
	[].forEach.call(carousel_linklist, function(item) {
		item.style.height = '' + newHeight + '%';
	});
}
evenlySpaceLinklistDivs();
