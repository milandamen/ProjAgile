<?php
	Route::get('reset',
	[
		'as'			=> 'password.reminder',
		'uses'			=> 'Auth\PasswordController@reminder',
		'middleware'	=> 'guest',
	]);

	Route::post('reset',
	[
		'as'			=> 'password.request',
		'uses'			=> 'Auth\PasswordController@request',
		'middleware'	=> 'guest',
	]);

	Route::get('reset/{token}',
	[
		'as'			=> 'password.reset',
		'uses'			=> 'Auth\PasswordController@reset',
		'middleware'	=> 'guest',
	]);

	Route::post('reset/{token}',
	[
		'as'			=> 'password.update',
		'uses'			=> 'Auth\PasswordController@update',
		'middleware'	=> 'guest',
	]);