<?php

Route::get('autocomplete/',
    [
        'as' => 'autocomplete.autocomplete',
        'uses' => 'AutocompleteController@autocomplete'
    ]);