<?php	
	Route::get('download/{fileName}',
	[
		'as' => 'file.download',
		'uses' => 'FileController@getDownload'
	]);