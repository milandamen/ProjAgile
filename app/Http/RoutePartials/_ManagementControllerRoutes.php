<?php
	Route::get('beheer',
	[
		'as' => 'management.index',
		'uses' => 'ManagementController@index',
		'middleware' => 'admin'
	]);