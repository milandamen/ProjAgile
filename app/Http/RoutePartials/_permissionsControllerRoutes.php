<?php

	Route::get('autorisatie/{id}/wijzigen',
	[
		'as' => 'permissions.edit',
		'uses' => 'PermissionsController@editUserPermissions'
	]);

	Route::patch('autorisatie/{id}/wijzigen',
	[
		'as' => 'permissions.update',
		'uses' => 'PermissionsController@updateUserPermissions'
	]);