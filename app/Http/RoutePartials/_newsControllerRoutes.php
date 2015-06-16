<?php
	Route::get('nieuws', 
	[
		'as'			=> 'news.index',
		'uses'			=> 'NewsController@index'
	]);

	Route::get('nieuws/aanmaken', 
	[
		'as'			=> 'news.create',
		'uses'			=> 'NewsController@create',
		'middleware'	=> 'admin'
	]);

	Route::put('nieuws/aanmaken', 
	[
		'as'			=> 'news.store',
		'uses'			=> 'NewsController@store',
		'middleware'	=> 'admin'
	]);

	Route::get('nieuws/beheer', 
	[
		'as'			=> 'news.manage',
		'uses'			=> 'NewsController@manage',
		'middleware'	=> 'admin'
	]);

	Route::post('nieuws/comment',
	[
		'as'			=> 'news.postComment',
		'uses'			=> 'NewsController@postComment'
	]);
	
	Route::get('nieuws/getArticlesByTitle/{term}',
	[
		'as'			=> 'news.getArticlesByTitle',
		'uses'			=> 'NewsController@getArticlesByTitle'
	]);

	Route::get('nieuws/{id}',
	[
		'as'			=> 'news.show',
		'uses'			=> 'NewsController@show'
	]);

	Route::get('nieuws/{id}/wijzigen',
	[
		'as'			=> 'news.edit',
		'uses'			=> 'NewsController@edit',
		'middleware'	=> 'admin'
	]);

	Route::patch('nieuws/{id}/wijzigen',
	[
		'as'			=> 'news.update',
		'uses'			=> 'NewsController@update',
		'middleware'	=> 'admin'
	]);

	Route::get('nieuws/{id}/toggleZichtbaarheid',
	[
		'as'			=> 'news.toggleHide',
		'uses'			=> 'NewsController@toggleHide',
		'middleware'	=> 'admin'
	]);