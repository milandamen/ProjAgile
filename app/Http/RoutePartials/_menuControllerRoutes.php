<?php
	Route::get('menubeheer',
	[
		'as'			=> 'menu.index',
		'uses'			=> 'MenuController@index',
		'middleware'	=> 'admin'
	]);

	Route::patch('menubeheer',
	[
		'as'			=> 'menu.index',
		'uses'			=> 'MenuController@updateMenuOrder',
		'middleware'	=> 'admin'
	]);

	Route::get('menuItemAanmaken',
	[
		'as'			=> 'menu.create',
		'uses'			=> 'MenuController@create',
		'middleware'	=> 'admin'
	]);

	Route::put('menuItemAanmaken',
	[
		'as'			=> 'menu.store',
		'uses'			=> 'MenuController@store',
		'middleware'	=> 'admin'
	]);

	Route::get('menuItemWijzigen/{id}',
	[
		'as'			=> 'menu.edit',
		'uses'			=> 'MenuController@edit',
		'middleware'	=> 'admin'
	]);

	Route::patch('menuItemWijzigen/{id}',
	[
		'as'			=> 'menu.update',
		'uses'			=> 'MenuController@update',
		'middleware'	=> 'admin'
	]);

	Route::get('switchPublishMenuItem/{id}',
	[
		'as'			=> 'menu.switchPublish',
		'uses'			=> 'MenuController@switchPublish',
		'middleware'	=> 'admin'
	]);