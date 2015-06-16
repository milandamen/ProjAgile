<?php
	Route::get('postcodebeheer',
	[
		'as'			=> 'postal.index',
		'uses'			=> 'PostalController@index',
		'middleware'	=> 'admin'
	]);

	Route::post('postcodebeheer',
	[
		'as'			=> 'postal.upload',
		'uses'			=> 'PostalController@upload',
		'middleware'	=> 'admin'
	]);

	Route::get('postcodebeheer/download',
	[
		'as'			=> 'postal.download',
		'uses'			=> 'PostalController@download',
		'middleware'	=> 'admin'
	]);