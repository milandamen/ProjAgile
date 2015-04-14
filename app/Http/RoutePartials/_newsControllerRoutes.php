<?php	

	Route::get('nieuws', 
	[
		'as' => 'news.index',
		'uses' => 'NewsController@index'
	]);

	Route::get('nieuws/manage', 
	[
		'as' => 'news.manage',
		'uses' => 'NewsController@showHidden'
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
	
	Route::get('nieuws/getArticlesByTitle/{id}',
	[
		'as' => 'news.getArticlesByTitle',
		'uses' => 'NewsController@getArticlesByTitle'
	]);

	Route::get('nieuws/hide/{id}',
		[
			'as'=>'news.hide',
			'uses'=>'NewsController@hide'
		]);

	Route::get('nieuws/unhide/{id}',
		[
			'as'=>'news.unhide',
			'uses'=>'NewsController@unhide'
		]);