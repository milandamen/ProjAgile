<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'HomeController@getIndex');

//Routes for downloading a file
Route::get('download/{filename}', function($filename)
{
    // Check if file exists in app/public/uploads folder
    $file_path = public_path() .'/uploads/'. $filename;
    if (file_exists($file_path))
    {
        // Send Download
        return Response::download($file_path, $filename, [
            'Content-Length: '. filesize($file_path)
        ]);
    }
    else
    {
        //If file does not exist, throw error
        exit('Bestand niet gevonden');
    }
});

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
	'home'=> 'HomeController',
    'news'=> 'NewsController',
]);
