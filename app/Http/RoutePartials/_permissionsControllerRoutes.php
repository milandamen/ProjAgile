<?php

	Route::get('autorisatie/{id}/wijzigen',
	[
		'as' => 'permissions.edit',
		'uses' => 'PermissionsController@editUserPermissions'
	]);

	Route::post('autorisatie/{id}/wijzigen',
	[
		'as' => 'permissions.update',
		'uses' => 'PermissionsController@updateUserPermissions'
	]);