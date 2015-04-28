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