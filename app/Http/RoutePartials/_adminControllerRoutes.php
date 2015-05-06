<?php
	Route::get('controlPanel',
	[
		'as' => 'admin.index',
		'uses' => 'AdminController@index',
		'middleware' => 'admin'
	]);