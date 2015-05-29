<?php
	Route::get('beheer',
	[
		'as' => 'admin.index',
		'uses' => 'AdminController@index',
		'middleware' => 'admin'
	]);