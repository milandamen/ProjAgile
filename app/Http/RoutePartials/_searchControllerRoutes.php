<?php
	Route::post('zoeken/{query}',
	[
		'as'			=> 'search.index',
		'uses'			=> 'SearchController@index'
	]);