<?php
	Route::get('/',                                         		
	[
		'as' => 'home',                        	
		'uses' => 'HomeController@index'
	]);

	Route::get('home/layout/aanpassen',                             
	[
		'as' => 'home.editLayout',                 
		'uses' => 'HomeController@getEditLayout'
	]);

	Route::post('home/layout/aanpassen',                            
	[
		'as' => 'home.editLayout',                 
		'uses' => 'HomeController@postEditLayout'
	]);

	Route::get('home/introductie/aanpassen',                       	
	[
		'as' => 'home.editIntro',                 	
		'uses' => 'HomeController@getEditIntro'
	]);

	Route::post('home/introductie/aanpassen',                       
	[
		'as' => 'home.editIntro',                 	
		'uses' => 'HomeController@postEditIntro'
	]);