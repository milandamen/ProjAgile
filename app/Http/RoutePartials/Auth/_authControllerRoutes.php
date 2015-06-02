<?php	
	Route::get('inloggen',
	[
		'as'			=> 'auth.login',
		'uses'			=> 'Auth\AuthController@getLogin',
		'middleware'	=> 'guest',
	]);

	Route::post('inloggen',
	[
		'as'			=>	'auth.login',
		'uses'			=> 'Auth\AuthController@postLogin',
		'middleware'	=> 'guest',
	]);

	Route::get('uitloggen',
	[
		'as'			=> 'auth.logout',
		'uses'			=> 'Auth\AuthController@getLogout'
	]);