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