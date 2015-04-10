<?php
	Route::get('/',                                         		
	[
		'as' => 'home.index',                        	
		'uses' => 'HomeController@getIndex'
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