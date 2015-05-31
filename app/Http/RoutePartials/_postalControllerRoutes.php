<?php
    Route::get('postcode/beheren',
    [
        'as' => 'postal.index',
        'uses' => 'PostalController@index'
    ]);