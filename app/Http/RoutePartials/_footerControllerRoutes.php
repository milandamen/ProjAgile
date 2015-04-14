<?php

    Route::get('footer/wijzigen',
    [
        'as' => 'footer.edit',
        'uses' => 'FooterController@edit'
    ]);

    Route::post('footer/postWijziging',
    [
        'as' => 'footer.postEdit',
        'uses' => 'FooterController@postEdit'
    ]);
