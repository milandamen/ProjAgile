<?php	
	Route::get('bestand{fileName}',                             	
	[
		'as' => 'file.download',                 	
		'uses' => 'FileController@getDownload'
	]);