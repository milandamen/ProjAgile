<?php	
	Route::get('nieuws{id}', 
	[
		'as' => 'news.show',
		'uses' => 'HomeController@getDetail'
	]);