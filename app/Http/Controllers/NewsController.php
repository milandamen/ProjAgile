<?php 
    namespace App\Http\Controllers;

    use App\Repositories\RepositoryInterfaces\INewsRepository;

    class NewsController extends Controller
    {
        /**
         * Create a new controller instance.
         *
         * @return void
         */
        public function __construct(INewsRepository $newsRepository)
        {
            $this->newsRepository = $newsRepository;
        }

        /**
         * Returns the news detail page
         * 
         * @param  int $newsId
         * 
         * @return Response
         */
        public function getDetail($newsId)
        {
            $news = $this->newsRepository->get($newsId);
            $fileLinks = [];

            if($news != null)
            {
                foreach($news->files as $file)
                {
                    $withoutId = substr($file->path, stripos($file->path, 'd') + 1);
                    $fileLinks[] = '<a href="' . action('FileController@getDownload') . '/' . $file->path . '">' . $withoutId . '</a><br/>';
                }
            }
            $data = 
            [
                'news' => $news, 
                'fileLinks' => $fileLinks
            ];

    		return view('news.detail', $data);
        }
    }