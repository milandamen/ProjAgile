<?php
	Route::get('deelwijk/haalDeelwijken',
	[
		'as' => 'districtSection.getDistrictSections',
		'uses' => 'DistrictSectionController@getDistrictSections'
	]);