<?php
    Route::get('postcodebeheer',
        [
            'as' => 'postal.index',
            'uses' => 'PostalController@index',
            'middleware' => 'admin'
        ]);

    Route::get('postcodebeheer/upload',
        [
            'as' => 'postal.upload',
            'uses' => 'PostalController@upload',
            'middleware' => 'admin'
        ]);