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

    Route::post('gebruikers',
    [
        'as' => 'user.filter',
        'uses' => 'UserController@index'
    ]);

    Route::get('gebruikers/{id}/deactiveer',
    [
        'as' => 'user.deactivate',
        'uses' => 'UserController@deactivate'
    ]);

    Route::get('gebruikers/{id}/activeer',
    [
        'as' => 'user.activate',
        'uses' => 'UserController@activate'
    ]);