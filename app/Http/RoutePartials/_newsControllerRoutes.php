<?php	

	Route::get('nieuws', 
	[
		'as' => 'news.index',
		'uses' => 'NewsController@index'
	]);

	Route::get('nieuws/{id}',
    [
        'as' => 'news.show',
        'uses' => 'NewsController@show'
    ]);

    Route::post('nieuws/comment',
    [
        'as' => 'news.postComment',
        'uses' => 'NewsController@postComment'
    ]);