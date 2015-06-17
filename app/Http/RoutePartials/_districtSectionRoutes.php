<?php
	Route::get('deelwijk',
	[
		'as'			=> 'district.index',
		'uses'			=> 'DistrictSectionController@index'
	]);

	Route::get('deelwijk/beheer',
	[
		'as'			=> 'district.manage',
		'uses'			=> 'DistrictSectionController@manage',
		'middleware'	=> 'admin'
	]);


	Route::get('deelwijk/nieuw',
	[
		'as'			=> 'district.create',
		'uses'			=> 'DistrictSectionController@create',
		'middleware'	=> 'admin'
	]);

	Route::post('deelwijk/nieuw',
	[
		'as'			=> 'district.store',
		'uses'			=> 'DistrictSectionController@store',
		'middleware'	=> 'admin'
	]);

	Route::get('deelwijk/{id}/wijzig',
	[
		'as'			=> 'district.edit',
		'uses'			=> 'DistrictSectionController@edit',
		'middleware'	=> 'admin'
	]);	

	Route::post('deelwijk/{id}/wijzig',
	[
		'as'			=> 'district.update',
		'uses'			=> 'DistrictSectionController@update',
		'middleware'	=> 'admin'
	]);

	Route::get('deelwijk/{id}/verwijder',
	[
		'as'			=> 'district.destroy',
		'uses'			=> 'DistrictSectionController@destroy',
		'middleware'	=> 'admin'
	]);

	Route::get('deelwijk/{name}',
	[
		'as'			=> 'district.show',
		'uses'			=> 'DistrictSectionController@show'
	]);