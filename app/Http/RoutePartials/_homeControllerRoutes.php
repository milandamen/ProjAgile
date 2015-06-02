<?php
	Route::get('/',
	[
		'as' => 'home.index',
		'uses' => 'HomeController@index'
	]);

	Route::get('home/layout/wijzigen',
	[
		'as' => 'home.editLayout',
		'uses' => 'HomeController@editLayout',
		'middleware' => 'admin'
	]);

	Route::post('home/layout/wijzigen',
	[
		'as' => 'home.updateLayout',
		'uses' => 'HomeController@updateLayout',
		'middleware' => 'admin'
	]);

	Route::get('home/introductie/wijzigen',
	[
		'as' => 'home.editIntroduction',
		'uses' => 'HomeController@editIntroduction',
		'middleware' => 'admin'
	]);

	Route::post('home/introductie/wijzigen',
	[
		'as' => 'home.updateIntroduction',
		'uses' => 'HomeController@updateIntroduction',
		'middleware' => 'admin'
	]);
	
	Route::post('home/zoeken',
	[
		'as' => 'home.search',
		'uses' => 'HomeController@search'
	]);