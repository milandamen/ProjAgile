<?php namespace App\Http\Controllers;

use App\Repository\NewsRepository;
use View;

class NewsController extends Controller
{
    public function __construct(NewsRepository $newsRepository)
    {
        $this->newsRepository = $newsRepository;
    }

    public function getIndex()
    {
        $newsItems = $this->newsRepository->getAll();
        return View::make('Resources\views\NewsView\index.php', compact('newsItems'));
    }

    /*public function show($id)
    {
        $newsItem = $this->newsRepository->get($id);
        return View::make('viewnaam', compact('newsItem'));
    }*/

    public function edit($id)
    {
        $newsItem = $this->newsRepository->get($id);
        return View::make('viewnaam', compact('newsItem'));
    }

    public function delete($id)
    {
        $newsItem = $this->newsRepository->get($id);
        return View::make('viewnaam', compact('newsItem'));
    }




















    public function getDetail($newsId)
    {
        $news = $this->newsRepository->get($newsId);

        $fileLinks = array();

        if($news != null)
        {
            foreach($news->files as $file)
            {
                $withoutId = substr($file->path, stripos($file->path, 'd') + 1);
                $fileLinks[] = '<a href="' . action('FileController@getDownload') . '/' . $file->path . '">'. $withoutId . '</a><br/>';
            }
        }
		
		return view('news/detail', $data = array('news' => $news, 'fileLinks' => $fileLinks));
    }
}