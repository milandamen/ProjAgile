<?php
	Route::get('registreren',
	[
		'as'			=> 'registration.register',
		'uses'			=> 'Auth\RegistrationController@getRegister',
		'middleware'	=> 'guest',
	]);

	Route::post('registreren',
	[
		'as' 			=> 'registration.register',
		'uses'			=> 'Auth\RegistrationController@postRegister',
		'middleware'	=> 'guest',
	]);

	Route::get('verifieren/{confirmation_Token}',
	[
		'as'			=> 'registration.confirm',
		'uses'			=> 'Auth\RegistrationController@confirm',
		'middleware'	=> 'guest',
	]);