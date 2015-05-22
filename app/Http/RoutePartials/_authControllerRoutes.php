<?php	
	Route::get('registreren',
	[
		'as' => 'auth.register',
		'uses' => 'Auth\AuthController@getRegister'
	]);

	Route::post('registreren',
	[
		'as' => 'auth.register',
		'uses' => 'Auth\AuthController@postRegister'
	]);

	Route::get('inloggen',
	[
		'as' => 'auth.login',
		'uses' => 'Auth\AuthController@getLogin'
	]);

	Route::post('inloggen',
	[
		'as' => 'auth.login',
		'uses' => 'Auth\AuthController@postLogin'
	]);

	Route::get('uitloggen',
	[
		'as' => 'auth.logout',
		'uses' => 'Auth\AuthController@getLogout'
	]);