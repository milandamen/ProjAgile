<?php	
	Route::get('registreren',                                      	
	[
		'as' => 'register',                        
		'uses' => 'Auth\AuthController@getRegister'
	]);

	Route::post('registreren',                                     	
	[
		'as' => 'register',                        
		'uses' => 'Auth\AuthController@postRegister'
	]);

	Route::get('inloggen',											
	[
		'as' => 'login',							
		'uses' => 'Auth\AuthController@getLogin'
	]);

	Route::post('inloggen',                                        	
	[
		'as' => 'login',                        	
		'uses' => 'Auth\AuthController@postLogin'
	]);

	Route::get('uitloggen',                                      	
	[
		'as' => 'logout',                        	
		'uses' => 'Auth\AuthController@getLogout'
	]);