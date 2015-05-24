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

	$('#get-checked-data-page').on('click', function(event) {
		event.preventDefault();

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

		var checkedOtherItems = {}, counter = 0;
		$("#check-list-box-other li.active").each(function(idx, li) {
			checkedOtherItems[counter] = $(li).text();
			counter++;
		});

		var pageSelectionString = JSON.stringify(checkedPageItems, null, '\t');
		$('#display-json-page').html(pageSelectionString);
		$('#pageSelection').val(pageSelectionString);

		var districtSectionSelectionString = JSON.stringify(checkedDistrictSectionItems, null, '\t');
		$('#display-json-districtSection').html(districtSectionSelectionString);
		$('#districtSectionSelection').val(districtSectionSelectionString);

		var otherSelectionString = JSON.stringify(checkedOtherItems, null, '\t');
		$('#display-json-other').html(otherSelectionString);
		$('#otherSelection').val(otherSelectionString);


		//sessionStorage.setItem('stored_data', JSON.stringify(checkedItems, null, '\t'));
	});
});