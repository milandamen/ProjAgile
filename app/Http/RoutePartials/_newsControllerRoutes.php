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

    Route::post('nieuws/comment',
    [
        'as' => 'news.postComment',
        'uses' => 'NewsController@postComment'
    ]);

	Route::get('nieuws/{id}',
    [
        'as' => 'news.show',
        'uses' => 'NewsController@show'
    ]);

    Route::get('nieuws/{id}/wijzigen',
    [
        'as' => 'news.edit',
        'uses' => 'NewsController@edit'
    ]);

   	Route::patch('nieuws/{id}/wijzigen',
    [
    	'as' => 'news.update',
    	'uses' => 'NewsController@update'
    ]);
	
	Route::get('nieuws/{id}/getArticlesByTitle',
	[
		'as' => 'news.getArticlesByTitle',
		'uses' => 'NewsController@getArticlesByTitle'
	]);

	Route::get('nieuws/{id}/hide',
	[
		'as'=>'news.hide',
		'uses'=>'NewsController@hide'
	]);

	Route::get('nieuws/{id}/unhide',
	[
		'as'=>'news.unhide',
		'uses'=>'NewsController@unhide'
	]);