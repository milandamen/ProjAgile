<?php
	Route::get('nieuwopdesite',
	[
		'as' => 'newOnSite.index',
		'uses' => 'NewOnSiteController@index'
	]);