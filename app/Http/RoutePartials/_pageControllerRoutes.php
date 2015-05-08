<?php

Route::get('pagina',[
	'as' => 'page.index',
	'uses' => 'PageController@index',
	'middleware' => 'admin'
]);


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

Route::get('pagina/{id}/wijzigen',
[
	'as' => 'page.edit',
	'uses' => 'PageController@edit',
	'middleware' => 'admin'
]);

Route::post('pagina/{id}/wijzigen',
[
	'as' => 'page.update',
	'uses' => 'PageController@update',
	'middleware' => 'admin'
]);

Route::get('pagina/del/{id}', [
	'as' => 'page.del',
	'uses' => 'PageController@destroy',
	'middelware' => 'admin'
]);

Route::get('pagina/{id}',
[
	'as' => 'page.show',
	'uses' => 'PageController@show',
]);
