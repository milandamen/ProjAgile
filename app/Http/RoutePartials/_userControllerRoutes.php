<?php

    Route::get('gebruikers',
    [
        'as' => 'user.index',
        'uses' => 'UserController@index'
    ]);

    Route::get('gebruikers/{id}/wijzigen',
    [
        'as' => 'user.edit',
        'uses' => 'UserController@edit'
    ]);

    Route::patch('gebruikers/{id}/wijzigen',
    [
        'as' => 'user.update',
        'uses' => 'UserController@update'
    ]);

    Route::get('gebruikers/aanmaken',
    [
        'as' => 'user.create',
        'uses' => 'UserController@create'
    ]);

    Route::put('gebruikers/aanmaken',
    [
        'as' => 'user.store',
        'uses' => 'UserController@store'
    ]);