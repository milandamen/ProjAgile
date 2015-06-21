<?php
	Route::get('gebruikers',
	[
		'as'			=> 'user.index',
		'uses'			=> 'UserController@index',
	]);

	Route::get('gebruikers/aanmaken',
	[
		'as'			=> 'user.create',
		'uses'			=> 'UserController@create',
	]);

	Route::post('gebruikers/aanmaken',
	[
		'as'			=> 'user.store',
		'uses'			=> 'UserController@store',
	]);

	Route::get('gebruikers/{id}',
	[
		'as'			=> 'user.show',
		'uses'			=> 'UserController@show',
	]);

	Route::get('gebruikers/{id}/wijzigen',
	[
		'as'			=> 'user.edit',
		'uses'			=> 'UserController@edit',
	]);

	Route::patch('gebruikers/{id}/wijzigen',
	[
		'as'			=> 'user.update',
		'uses'			=> 'UserController@update',
	]);

	Route::get('profiel',
	[
		'as'			=> 'user.showProfile',
		'uses'			=> 'UserController@showProfile'
	]);

	Route::get('profiel/wijzig',
	[
		'as'			=> 'user.editProfile',
		'uses'			=> 'UserController@editProfile'
	]);

	Route::patch('profiel/wijzig',
	[
		'as'			=> 'user.updateProfile',
		'uses'			=> 'UserController@update'
	]);

	Route::get('gebruikers/{id}/toggleActivatie',
	[
		'as'			=> 'user.toggleActivation',
		'uses'			=> 'UserController@toggleActivation',
	]);