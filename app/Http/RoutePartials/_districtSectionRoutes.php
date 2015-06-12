<?php
	Route::get('deelwijk',
	[
		'as'			=> 'district.index',
		'uses'			=> 'DistrictSectionController@index'
	]);

	Route::get('deelwijk/{name}',
	[
		'as'			=> 'district.show',
		'uses'			=> 'DistrictSectionController@show'
	]);

	