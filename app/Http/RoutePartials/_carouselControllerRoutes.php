<?php
	Route::get('carousel/wijzigen',
	[
		'as'			=> 'carousel.edit',
		'uses'			=> 'CarouselController@edit',
		'middleware'	=> 'admin'
	]);

	Route::post('carousel/wijzigen',
	[
		'as'			=> 'carousel.update',
		'uses'			=> 'CarouselController@update',
		'middleware'	=> 'admin'
	]);