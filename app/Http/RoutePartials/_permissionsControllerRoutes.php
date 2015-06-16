<?php

	Route::get('gebruikers/{id}/autorisatie',
	[
		'as'			=> 'permissions.edit',
		'uses'			=> 'PermissionsController@editUserPermissions',
		'middleware'	=> 'admin'
	]);

	Route::post('gebruikers/{id}/autorisatie',
	[
		'as' => 'permissions.update',
		'uses' => 'PermissionsController@updateUserPermissions',
		'middleware' => 'admin'
	]);

	//usergroup routes

	Route::get('gebruikersgroepen',
	[
		'as' => 'permissions.index',
		'uses' => 'PermissionsController@index',
		'middleware' => 'admin'
	]);

	Route::get('gebruikersgroepen/aanmaken',
	[
		'as' => 'permissions.createUserGroup',
		'uses' => 'PermissionsController@createUserGroup',
		'middleware' => 'admin'
	]);

	Route::post('gebruikersgroepen/aanmaken',
	[
		'as' => 'permissions.storeUserGroup',
		'uses' => 'PermissionsController@storeUserGroup',
		'middleware' => 'admin'
	]);

	Route::get('gebruikersgroepen/{userGroupid}/wijzigen',
	[
		'as' => 'permissions.editUserGroup',
		'uses' => 'PermissionsController@editUserGroup',
		'middleware' => 'admin'
	]);

	Route::post('gebruikersgroepen/{userGroupid}/wijzigen',
	[
		'as' => 'permissions.updateUserGroup',
		'uses' => 'PermissionsController@updateUserGroup',
		'middleware' => 'admin'
	]);