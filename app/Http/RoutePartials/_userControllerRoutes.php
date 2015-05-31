<?php

	Route::get('gebruikers',
	[
		'as' => 'user.index',
		'uses' => 'UserController@index'
	]);

	Route::get('gebruikers/{id}/wijzigen',
	[
		'as' => 'user.edit',
		'uses' => 'UserController@edit'
	]);

	Route::patch('gebruikers/{id}/wijzigen',
	[
		'as' => 'user.update',
		'uses' => 'UserController@update'
	]);

	Route::get('gebruikers/aanmaken',
	[
		'as' => 'user.create',
		'uses' => 'UserController@create'
	]);

	Route::post('gebruikers/aanmaken',
	[
		'as' => 'user.store',
		'uses' => 'UserController@store'
	]);

	//user profile routes
	Route::get('profiel',
	[
		'as' => 'user.showProfile',
		'uses' => 'UserController@showProfile'
	]);

	Route::get('profiel/wijzig',
	[
		'as' => 'user.editProfile',
		'uses' => 'UserController@editProfile'
	]);

	Route::patch('profiel/wijzig',
	[
		'as' => 'user.updateProfile',
		'uses' => 'UserController@update'
	]);
	//end user profile routes

	Route::get('gebruikers/{id}/deactiveer',
	[
		'as' => 'user.deactivate',
		'uses' => 'UserController@deactivate'
	]);

	Route::get('gebruikers/{id}/activeer',
	[
		'as' => 'user.activate',
		'uses' => 'UserController@activate'
	]);

	Route::get('gebruikers/{id}',
	[
		'as' => 'user.show',
		'uses' => 'UserController@show'
	]);