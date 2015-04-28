
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
			carousel_transition_interval = carousel_transition_duration + 9000;				// The default interval is 5 seconds, unless otherwise specified.
		}
	}
} catch(e) {
	carousel_transition_interval = carousel_transition_duration + 9000;						// The default interval is 5 seconds, unless otherwise specified.
}

var carousel = document.getElementById('mod-carousel');
var carousel_imagelist_div = document.getElementById('mod-carousel-images');
var carousel_linklist_div = document.getElementById('mod-carousel-linklist');
var carousel_imagelist = [];
var carousel_linklist = [];
var carousel_selected_i = 0;
var carousel_selected_i_old = 0;
var carousel_selected_img = null;
var carousel_selected_link = null;

execActionOnElementsInArray(carousel_imagelist_div.children, 'a', function (item) {
	carousel_imagelist.push(item);
	item.style.display = 'none';
});

execActionOnElementsInArray(carousel_linklist_div.children, 'table', function (item) {
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
	carousel_selected_img.style.display = 'inline-block';
	carousel_selected_link.classList.add('table-shade-selected');
	
	if (carousel_count !== 1) {
		carousel_selected_i_old = carousel_count - 1;
		setInterval('carouselTransition()', carousel_transition_interval);
	}
} else {
	carousel.style.display = 'none';				// Hide the whole carousel if there are no items to display.
}

function carouselTransition() {
	carousel_selected_i_old = carousel_selected_i;
	carousel_selected_i++;
	if (carousel_selected_i >= carousel_count) {
		carousel_selected_i = 0;
	}
	
	var carousel_selected_img_old = carousel_selected_img;
	var carousel_selected_link_old = carousel_selected_link;
	carousel_selected_img = carousel_imagelist[carousel_selected_i];
	carousel_selected_link = carousel_linklist[carousel_selected_i];
	
	carousel_selected_img.style.display = 'inline-block';
	
	var c_sel_img_img = null;
	var c_sel_img_text = null;
	execActionOnElementsInArray(carousel_selected_img.children, 'img', function (item) {
		c_sel_img_img = item;
	});
	execActionOnElementsInArray(carousel_selected_img.children, 'h3', function (item) {
		c_sel_img_text = item;
	});
	
	var c_sel_img_old_img = null;
	var c_sel_img_old_text = null;
	execActionOnElementsInArray(carousel_selected_img_old.children, 'img', function (item) {
		c_sel_img_old_img = item;
	});
	execActionOnElementsInArray(carousel_selected_link_old.children, 'h3', function (item) {
		c_sel_img_old_text = item;
	});
	
	var c_trans_dur_half = carousel_transition_duration / 2;
	var transitionStart = new Date().valueOf();
	while (new Date().valueOf() - transitionStart < c_trans_dur_half) {
		var now = new Date().valueOf();			// TODO potentially put in while statement
		var diff = now - transitionStart;
		var perc = diff / carousel_transition_duration;
		perc = Math.max(0, Math.min(1, perc));				// Clamp perc between 0 and 1. (0% and 100%)
		
		c_sel_img_img.style.opacity = perc;
		c_sel_img_old_img.style.opacity = 1 - perc;
	}
	
	
	
	carousel_selected_img_old.style.display = 'none';
	carousel_selected_link_old.classList.remove('table-shade-selected');
	
	carousel_selected_link.classList.add('table-shade-selected');
}
