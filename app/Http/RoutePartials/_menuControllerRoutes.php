<?php
Route::get('menubeheer',
    [
        'as' => 'menu.index',
        'uses' => 'MenuController@index',
        'middleware' => 'admin'
    ]);