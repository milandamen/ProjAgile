<?php
	Route::get('footer/wijzigen',
	[
		'as' => 'footer.edit',
		'uses' => 'FooterController@edit'
	]);

	Route::post('footer/wijzigen',
	[
		'as' => 'footer.update',
		'uses' => 'FooterController@update'
	]);