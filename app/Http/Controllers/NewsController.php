<?php namespace App\Http\Controllers;

class NewsController extends Controller
{
    public function show($newsId)
    {
        echo '<h1>' . $newsId . '</h1>';
        return view('news/detail');
    }
}