<?php
Route::get('/postcode/beheren',
    [
        'as' => 'postal.index',
        'uses' => 'PostalController@index'
    ]);
//
//Route::get('home/layout/wijzigen',
//    [
//        'as' => 'home.editLayout',
//        'uses' => 'HomeController@editLayout'
//    ]);
//
//Route::post('home/layout/wijzigen',
//    [
//        'as' => 'home.editLayout',
//        'uses' => 'HomeController@updateLayout'
//    ]);
//
//Route::get('home/introductie/wijzigen',
//    [
//        'as' => 'home.editIntroduction',
//        'uses' => 'HomeController@editIntroduction'
//    ]);
//
//Route::post('home/introductie/wijzigen',
//    [
//        'as' => 'home.updateIntroduction',
//        'uses' => 'HomeController@updateIntroduction'
//    ]);
//
//Route::post('home/zoek',
//    [
//        'as' => 'home.search',
//        'uses' => 'HomeController@search'
//    ]);
	