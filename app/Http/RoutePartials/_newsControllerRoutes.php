<?php	
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