<?php namespace App\Http\Controllers;

use App\Repository\DistrictsectionRepository;
use App\Repository\NewsRepository;
use App\Repository\FileRepository;
use League\Flysystem\File;
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
        return View::make('news/index', compact('newsItems'));
    }

    /*public function show($id)
    {
        $newsItem = $this->newsRepository->get($id);
        return View::make('viewnaam',news/detail compact('newsItem'));
    }*/

    public function getEdit($id)
    {
        $newsItem = $this->newsRepository->get($id);
        //dd($newsItem->content);
        $title = $newsItem->title;
        $content = $newsItem->content;

        //Files
        $fileRepo = new FileRepository();
        $files = $fileRepo->getAllByNewsId($id);

        //DistrictSection
        $districtRepo = new DistrictsectionRepository();
        $districtSections = $districtRepo->getAllToList();

        return View::make('news.edit', compact('newsItem', 'districtSections', 'files'));
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