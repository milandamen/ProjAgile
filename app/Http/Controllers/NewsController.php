<?php namespace App\Http\Controllers;

use App\Repository\NewsRepository;

class NewsController extends Controller
{
    public function __construct(NewsRepository $newsRepository)
    {
        $this->newsRepository = $newsRepository;
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
                $fileLinks[] = '<a href="../../download/' . $file->path . '">'. $withoutId . '</a><br/>';
            }
        }

        return view('news/detail', $data = array('news' => $news, 'fileLinks' => $fileLinks));
    }
}