<?php
	Route::get('zoeken',
	[
		'as'			=> 'search.index',
		'uses'			=> 'SearchController@index'
	]);