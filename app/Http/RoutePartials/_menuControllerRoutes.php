<?php
	Route::get('menubeheer',
	[
		'as'			=> 'menu.index',
		'uses'			=> 'MenuController@index',
	]);

	Route::patch('menubeheer',
	[
		'as'			=> 'menu.index',
		'uses'			=> 'MenuController@updateMenuOrder',
	]);

	Route::get('menuItemAanmaken',
	[
		'as'			=> 'menu.create',
		'uses'			=> 'MenuController@create',
	]);

	Route::put('menuItemAanmaken',
	[
		'as'			=> 'menu.store',
		'uses'			=> 'MenuController@store',
	]);

	Route::get('menuItemWijzigen/{id}',
	[
		'as'			=> 'menu.edit',
		'uses'			=> 'MenuController@edit',
	]);

	Route::patch('menuItemWijzigen/{id}',
	[
		'as'			=> 'menu.update',
		'uses'			=> 'MenuController@update',
	]);

	Route::get('switchPublishMenuItem/{id}',
	[
		'as'			=> 'menu.switchPublish',
		'uses'			=> 'MenuController@switchPublish',
	]);