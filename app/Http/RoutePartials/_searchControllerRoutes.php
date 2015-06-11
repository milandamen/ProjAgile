<?php
	Route::get('zoeken/{query?}',
	[
		'as'			=> 'search.index',
		'uses'			=> 'SearchController@index'
	]);