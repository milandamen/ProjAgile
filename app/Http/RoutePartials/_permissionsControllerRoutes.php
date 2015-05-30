<?php

	Route::get('gebruikers/{id}/autorisatie',
	[
		'as' => 'permissions.edit',
		'uses' => 'PermissionsController@editUserPermissions'
	]);

	Route::post('gebruikers/{id}/autorisatie',
	[
		'as' => 'permissions.update',
		'uses' => 'PermissionsController@updateUserPermissions'
	]);