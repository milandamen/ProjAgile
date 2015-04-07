<?php namespace App\Http\Controllers;

use App\Repository\NewscommentRepository;
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
                $fileLinks[] = '<a href="' . action('FileController@getDownload') . '/' . $file->path . '">'. $withoutId . '</a><br/>';
            }
        }

        $newscr = new NewscommentRepository();
        $comment = $newscr->get(1);

        var_dump($comment);
        echo $comment->message;

        echo count($news->newscomments);
		
		return view('news/detail', $data = array('news' => $news, 'fileLinks' => $fileLinks));
    }
}