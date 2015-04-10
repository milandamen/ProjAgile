<?php
	Route::get('/',                                         		
	[
		'as' => 'home.index',                        	
		'uses' => 'HomeController@index'
	]);

	Route::get('layout/aanpassen',
	[
		'as' => 'home.editLayout',                 
		'uses' => 'HomeController@editLayout'
	]);

	Route::post('layout/aanpassen',
	[
		'as' => 'home.editLayout',                 
		'uses' => 'HomeController@updateLayout'
	]);

	Route::get('introductie/aanpassen',
	[
		'as' => 'home.editIntroduction',
		'uses' => 'HomeController@editIntroduction'
	]);

	Route::post('introductie/aanpassen',
	[
		'as' => 'home.editIntroduction',
		'uses' => 'HomeController@updateIntroduction'
	]);