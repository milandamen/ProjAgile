<?php
	Route::get('sidebar/{id}/wijzigen',
	[
		'as' => 'sidebar.edit',
		'uses' => 'SidebarController@edit'
	]);

	Route::post('sidebar/{id}/wijzigen',
	[
		'as' => 'sidebar.update',
		'uses' => 'SidebarController@update'
	]);