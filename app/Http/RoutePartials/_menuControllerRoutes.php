<?php
    Route::get('menubeheer',
    [
        'as' => 'menu.index',
        'uses' => 'MenuController@index',
        'middleware' => 'admin'
    ]);

    Route::patch('menubeheer',
    [
        'as' => 'menu.index',
        'uses' => 'MenuController@updateMenuOrder',
        'middleware' => 'admin'
    ]);

    Route::get('menuitemaanmaken',
    [
        'as' => 'menu.create',
        'uses' => 'MenuController@create',
        'middleware' => 'admin'
    ]);

    Route::put('menuitemaanmaken',
    [
        'as' => 'menu.store',
        'uses' => 'MenuController@store',
        'middleware' => 'admin'
    ]);


    Route::get('menuitemwijzigen/{id}',
    [
        'as' => 'menu.edit',
        'uses' => 'MenuController@edit',
        'middleware' => 'admin'
    ]);

    Route::patch('menuitemwijzigen/{id}',
    [
        'as' => 'menu.update',
        'uses' => 'MenuController@update',
        'middleware' => 'admin'
    ]);