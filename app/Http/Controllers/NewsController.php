<?php namespace App\Http\Controllers;

use App\Repository\NewsRepository;

class NewsController extends Controller
{

    public function __construct(NewsRepository $newsRepository)
    {
        $this->newsRepository = $newsRepository;
    }

    public function getdetail($newsId)
    {
        $news = $this->newsRepository->get($newsId);
        return view('news/detail', $data = array('news' => $news));
    }
}