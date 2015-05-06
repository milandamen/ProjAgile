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
        'as' => 'menu.create',
        'uses' => 'MenuController@store',
        'middleware' => 'admin'
    ]);
