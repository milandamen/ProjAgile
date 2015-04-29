<?php
Route::get('pagina/nieuw',
[
	'as' => 'page.create',
	'uses' => 'PageController@create',
	'middleware' => 'admin'
	]);

Route::post('pagina/nieuw',
[
	'as' => 'page.store',
	'uses' => 'PageController@store',
	'middleware' => 'admin'
	]);

Route::get('pagina/wijzigen',
[
	'as' => 'page.edit',
	'uses' => 'PageController@edit',
	'middleware' => 'admin'
]);

