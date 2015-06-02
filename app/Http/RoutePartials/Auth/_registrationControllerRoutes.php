<?php
	Route::get('registreren',
	[
		'as' => 'auth.register',
		'uses' => 'Auth\RegistrationController@getRegister',
		'middleware' => 'guest',
	]);

	Route::post('registreren',
	[
		'as' => 'auth.register',
		'uses' => 'Auth\RegistrationController@postRegister',
		'middleware' => 'guest',
	]);

	Route::post('verifieren/{confirmation_Token}',
	[
		'as' => 'auth.confirm',
		'uses' => 'Auth\RegistrationController@confirm',
		'middleware' => 'guest',
	]);