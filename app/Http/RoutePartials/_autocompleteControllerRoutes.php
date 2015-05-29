<?php

    Route::get('autocomplete/',
    [
        'as' => 'autocomplete.autocomplete',
        'uses' => 'AutocompleteController@autocomplete'
    ]);

    Route::get('autocomplete/user',
    [
        'as' => 'autocomplete.userAutocomplete',
        'uses' => 'AutocompleteController@userAutocomplete'
    ]);