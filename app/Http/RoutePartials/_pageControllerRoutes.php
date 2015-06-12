<?php
	Route::get('pagina',
	[
		'as'			=> 'page.index',
		'uses'			=> 'PageController@index',
		'middleware'	=> 'admin'
	]);


	Route::get('pagina/contact',
	[
		'as' => 'page.contact',
		'uses' => 'PageController@contact',
	]);

	Route::post('pagina/contact',
	[
		'as' => 'page.sendcontact',
		'uses' => 'PageController@sendContact',
	]);

	Route::get('pagina/contact/wijzig',
	[
		'as' => 'page.contactedit',
		'uses' => 'PageController@editContact',
		'middleware'	=> 'admin'
	]);

	Route::post('pagina/contact/wijzig',
	[
		'as' => 'page.contactedit',
		'uses' => 'PageController@editContactSave',
		'middleware'	=> 'admin'
	]);


	Route::get('pagina/aanmaken',
	[
		'as'			=> 'page.create',
		'uses'			=> 'PageController@create',
		'middleware'	=> 'admin'
	]);

	Route::post('pagina/aanmaken',
	[
		'as'			=> 'page.store',
		'uses'			=> 'PageController@store',
		'middleware'	=> 'admin'
	]);


	Route::get('pagina/{id}',
	[
		'as'			=> 'page.show',
		'uses'			=> 'PageController@show',
	]);

	Route::get('pagina/{id}/wijzigen',
	[
		'as'			=> 'page.edit',
		'uses'			=> 'PageController@edit',
		'middleware'	=> 'admin'
	]);

	Route::post('pagina/{id}/wijzigen',
	[
		'as'			=> 'page.update',
		'uses'			=> 'PageController@update',
		'middleware'	=> 'admin'
	]);

	Route::get('pagina/{id}/verwijderen', 
	[
		'as'			=> 'page.destroy',
		'uses'			=> 'PageController@destroy',
		'middleware'	=> 'admin'
	]);

	Route::get('pagina/{id}/zichtbaarheid', 
	[
		'as'			=> 'page.visible',
		'uses'			=> 'PageController@switchPublish',
		'middleware'	=> 'admin'
	]);

