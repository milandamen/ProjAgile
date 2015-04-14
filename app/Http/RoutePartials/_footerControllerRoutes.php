<?php

    Route::get('footer/wijzigen',
    [
        'as' => 'footer.edit',
        'uses' => 'FooterController@edit'
    ]);

    Route::get('footer/autocomplete',
    [
       'as' => 'footer.autocomplete',
        'uses' => 'FooterController@autocomplete'
    ]);

    Route::post('footer/postWijziging',
    [
        'as' => 'footer.postEdit',
        'uses' => 'FooterController@postEdit'
    ]);
