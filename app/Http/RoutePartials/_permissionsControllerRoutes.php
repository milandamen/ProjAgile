<?php

	Route::get('gebruikers/{id}/autorisatie',
	[
		'as'			=> 'permissions.edit',
		'uses'			=> 'PermissionsController@editUserPermissions',
	]);

	Route::post('gebruikers/{id}/autorisatie',
	[
		'as' => 'permissions.update',
		'uses' => 'PermissionsController@updateUserPermissions',
	]);

	//usergroup routes

	Route::get('gebruikersgroepen',
	[
		'as' => 'permissions.index',
		'uses' => 'PermissionsController@index',
	]);

	Route::get('gebruikersgroepen/aanmaken',
	[
		'as' => 'permissions.createUserGroup',
		'uses' => 'PermissionsController@createUserGroup',
	]);

	Route::post('gebruikersgroepen/aanmaken',
	[
		'as' => 'permissions.storeUserGroup',
		'uses' => 'PermissionsController@storeUserGroup',
	]);


	Route::get('gebruikersgroepen/{userGroupid}/wijzigen',
	[
		'as' => 'permissions.editUserGroup',
		'uses' => 'PermissionsController@editUserGroup',
	]);

	Route::post('gebruikersgroepen/{userGroupid}/wijzigen',
	[
		'as' => 'permissions.updateUserGroup',
		'uses' => 'PermissionsController@updateUserGroup',
	]);

	Route::get('gebruikersgroepen/{userGroupid}/verwijderen',
	[
		'as' => 'permissions.deleteUserGroup',
		'uses' => 'PermissionsController@deleteUserGroup',
	]);