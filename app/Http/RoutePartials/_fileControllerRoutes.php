<?php	
	Route::get('bestand{fileName}',                             	
	[
		'as' => 'file.download',                 	
		'uses' => 'HomeController@getDownload'
	]);