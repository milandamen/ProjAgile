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
	]);

	Route::post('pagina/contact/wijzig',
	[
		'as' 			=> 'page.contactedit',
		'uses' 			=> 'PageController@editContactSave',
	]);
	
	Route::get('overons',
	[
		'as'			=> 'page.about',
		'uses'			=> 'PageController@showAbout',
	]);

	Route::get('pagina/aanmaken',
	[
		'as'			=> 'page.create',
		'uses'			=> 'PageController@create',
	]);

	Route::post('pagina/aanmaken',
	[
		'as'			=> 'page.store',
		'uses'			=> 'PageController@store',
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
	]);

	Route::post('pagina/{id}/wijzigen',
	[
		'as'			=> 'page.update',
		'uses'			=> 'PageController@update',
	]);

	Route::get('pagina/{id}/verwijderen', 
	[
		'as'			=> 'page.destroy',
		'uses'			=> 'PageController@destroy',
	]);

	Route::get('pagina/{id}/zichtbaarheid', 
	[
		'as' => 'page.visible',
		'uses' => 'PageController@switchPublish',
	]);

	Route::get('pagina/getArticlesByTitle/{term}',
	[
		'as' => 'page.getPagesByTitle',
		'uses' => 'PageController@getPagesByTitle'
	]);

