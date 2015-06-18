$(function () {
	$('.list-group.checked-list-box .list-group-item').each(function () {

		// Settings
		var $widget = $(this),
			$checkbox = $('<input type="checkbox" class="hidden" />'),
			color = ($widget.data('color') ? $widget.data('color') : "primary"),
			style = ($widget.data('style') == "button" ? "btn-" : "list-group-item-"),
			settings = {
				on: {
					icon: 'glyphicon glyphicon-check'
				},
				off: {
					icon: 'glyphicon glyphicon-unchecked'
				}
			};

		$widget.css('cursor', 'pointer')
		$widget.append($checkbox);
		$widget.data('checkbox', $checkbox);

		// Event Handlers
		$widget.on('click', function () {
			$checkbox.prop('checked', !$checkbox.is(':checked'));
			$checkbox.triggerHandler('change');
			updateDisplay();
		});
		$checkbox.on('change', function () {
			updateDisplay();
		});

		function checkState()
		{
			if ($widget.hasClass('checked'))
			{
				$checkbox.prop('checked', !$checkbox.is(':checked'));
			}
			$widget.removeClass('checked');
			updateDisplay();
		}

		checkState();

		// Actions
		function updateDisplay() {
			var isChecked = $checkbox.is(':checked');

			// Set the button's state
			$widget.data('state', (isChecked) ? "on" : "off");

			// Set the button's icon
			$widget.find('.state-icon')
				.removeClass()
				.addClass('state-icon ' + settings[$widget.data('state')].icon);

			// Update the button's color
			if (isChecked) {
				$widget.addClass(style + color + ' active');
			} else {
				$widget.removeClass(style + color + ' active');
			}
		}

		// Initialization
		function init() {

			if ($widget.data('checked') == true) {
				$checkbox.prop('checked', !$checkbox.is(':checked'));
			}

			updateDisplay();

			// Inject the icon if applicable
			if ($widget.find('.state-icon').length == 0) {
				$widget.prepend('<span class="state-icon ' + settings[$widget.data('state')].icon + '"></span>');
			}
		}
		init();
	});


	var checkData = function(event) {
		//check selected items and store them in JSON objects.
		var checkedPageItems = {}, counter = 0;
		$("#check-list-box-page li.active").each(function(idx, li) {
			checkedPageItems[counter] = $(li).attr('id');
			counter++;
		});

		var checkedDistrictSectionItems = {}, counter = 0;
		$("#check-list-box-districtSection li.active").each(function(idx, li) {
			checkedDistrictSectionItems[counter] = $(li).attr('id');
			counter++;
		});

		var checkedPermissionItems = {}, counter = 0;
		$("#check-list-box-permission li.active").each(function(idx, li) {
			checkedPermissionItems[counter] = $(li).attr('id');
			counter++;
		});

		var checkedDistrictSectionUserItems = {}, counter = 0;
		$("#check-list-box-districtSectionUsers li.active").each(function(idx, li) {
			checkedDistrictSectionUserItems[counter] = $(li).attr('id');
			counter++;
		});

		//view permissions
		var checkedPageViewItems = {}, counter = 0;
		$("#check-list-box-pageView li.active").each(function(idx, li) {
			checkedPageViewItems[counter] = $(li).attr('id');
			counter++;
		});

		var checkedDistrictSectionViewItems = {}, counter = 0;
		$("#check-list-box-districtSectionView li.active").each(function(idx, li) {
			checkedDistrictSectionViewItems[counter] = $(li).attr('id');
			counter++;
		});

		//convert JSON objects to strings and pass to view.
		var pageSelectionString = JSON.stringify(checkedPageItems, null, '\t');
		$('#pageSelection').val(pageSelectionString);

		var districtSectionSelectionString = JSON.stringify(checkedDistrictSectionItems, null, '\t');
		$('#districtSectionSelection').val(districtSectionSelectionString);

		var permissionSelectionString = JSON.stringify(checkedPermissionItems, null, '\t');
		$('#permissionSelection').val(permissionSelectionString);

		var districtSectionUserSelectionString = JSON.stringify(checkedDistrictSectionUserItems, null, '\t');
		$('#districtSectionUserSelection').val(districtSectionUserSelectionString);

		//view permissions
		var pageViewSelectionString = JSON.stringify(checkedPageViewItems, null, '\t');
		$('#pageViewSelection').val(pageViewSelectionString);

		var districtSectionViewSelectionString = JSON.stringify(checkedDistrictSectionViewItems, null, '\t');
		$('#districtSectionViewSelection').val(districtSectionViewSelectionString);
	};

	//get data when submitting form
	$('.userPermissionsForm').on('submit', function (event) {
		checkData();
	});


	//check all buttons
	var pagesChecked = false;
	var permissionsChecked = false;
	var districtSectionsChecked = false;
	var districtSectionUsersChecked = false;

	//(de)select all pages
	$('.all-pages').on('click', function(event){
		event.preventDefault();
		$('.page-item').each(function(){
			var $widget = $(this);
			$checkbox = $widget.data('checkbox');
			$checkbox.prop('checked', !pagesChecked);
			$checkbox.triggerHandler('change');
		})
		pagesChecked = !pagesChecked;
	});

	//(de)select all permissions
	$('.all-permissions').on('click', function(event){
		event.preventDefault();
		$('.permission-item').each(function(){
			var $widget = $(this);
			$checkbox = $widget.data('checkbox');
			$checkbox.prop('checked', !permissionsChecked);
			$checkbox.triggerHandler('change');
		})
		permissionsChecked = !permissionsChecked;
	});

	//(de)select all district sections
	$('.all-districtSections').on('click', function(event){
		event.preventDefault();
		$('.districtSection-item').each(function(){
			var $widget = $(this);
			$checkbox = $widget.data('checkbox');
			$checkbox.prop('checked', !districtSectionsChecked);
			$checkbox.triggerHandler('change');
		})
		districtSectionsChecked = !districtSectionsChecked;
	});

	//(de)select all users per district section
	$('.all-districtSectionUsers').on('click', function(event){
		event.preventDefault();
		$('.districtSectionUser-item').each(function(){
			var $widget = $(this);
			$checkbox = $widget.data('checkbox');
			$checkbox.prop('checked', !districtSectionUsersChecked);
			$checkbox.triggerHandler('change');
		})
		districtSectionUsersChecked = !districtSectionUsersChecked;
	});

	//check all buttons - view
	var pagesViewChecked = false;
	var districtSectionsViewChecked = false;

	//(de)select all pages' view permissions
	$('.all-pages-view').on('click', function(event){
		event.preventDefault();
		$('.pageView-item').each(function(){
			var $widget = $(this);
			$checkbox = $widget.data('checkbox');
			$checkbox.prop('checked', !pagesViewChecked);
			$checkbox.triggerHandler('change');
		})
		pagesViewChecked = !pagesViewChecked;
	});

	//(de)select all district sections' view permissions
	$('.all-districtSections-view').on('click', function(event){
		event.preventDefault();
		$('.districtSectionView-item').each(function(){
			var $widget = $(this);
			$checkbox = $widget.data('checkbox');
			$checkbox.prop('checked', !districtSectionsChecked);
			$checkbox.triggerHandler('change');
		})
		districtSectionsChecked = !districtSectionsChecked;
	});

});