<?php
	Route::get('gebruikers/{id}/autorisatie',
	[
		'as'			=> 'permissions.edit',
		'uses'			=> 'PermissionsController@editUserPermissions',
		'middleware'	=> 'admin'
	]);

	Route::post('gebruikers/{id}/autorisatie',
	[
		'as'			=> 'permissions.update',
		'uses'			=> 'PermissionsController@updateUserPermissions',
		'middleware'	=> 'admin'
	]);