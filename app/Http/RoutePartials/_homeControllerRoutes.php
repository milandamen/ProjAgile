<?php
	Route::get('/',
	[
		'as' => 'home.index',
		'uses' => 'HomeController@index'
	]);

	Route::get('home/layout/wijzigen',
	[
		'as' => 'home.editLayout',
		'uses' => 'HomeController@editLayout'
	]);

	Route::post('home/layout/wijzigen',
	[
		'as' => 'home.editLayout',
		'uses' => 'HomeController@updateLayout'
	]);

	Route::get('home/introductie/wijzigen',
	[
		'as' => 'home.editIntroduction',
		'uses' => 'HomeController@editIntroduction'
	]);

	Route::post('home/introductie/wijzigen',
	[
		'as' => 'home.updateIntroduction',
		'uses' => 'HomeController@updateIntroduction'
	]);
	
	Route::post('home/zoeken',
	[
		'as' => 'home.search',
		'uses' => 'HomeController@search'
	]);