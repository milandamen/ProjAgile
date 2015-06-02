<?php
	Route::get('sidebar/{id}/wijzigen',
	[
		'as' => 'sidebar.edit',
		'uses' => 'SidebarController@edit',
		'middleware' => 'admin'
	]);

	Route::post('sidebar/{id}/wijzigen',
	[
		'as' => 'sidebar.update',
		'uses' => 'SidebarController@update',
		'middleware' => 'admin'
	]);