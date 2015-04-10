<?php
    namespace App\Http\Controllers;

    use App\Models\Newscomment;
    use App\Repositories\RepositoryInterfaces\INewsCommentRepository;
    use App\Repositories\RepositoryInterfaces\INewsRepository;
    use App\Repositories\RepositoryInterfaces\IUserRepository;
    use Illuminate\Support\Facades\Redirect;

    class NewsController extends Controller
    {
        private $newsCommentRepo;
        private $newsRepo;
        private $userRepo;

        /**
         * Creates a new NewsController instance.
         *
         * @param INewsCommentRepository $newsCommentRepo
         * @param INewsRepository        $newsRepo
         * @param IUserRepository        $userRepo
         *
         * @return void
         */
        public function __construct(INewsCommentRepository  $newsCommentRepo, INewsRepository $newsRepo, IUserRepository $userRepo)
        {
            $this->newsCommentRepo = $newsCommentRepo;
            $this->newsRepo = $newsRepo;
            $this->userRepo = $userRepo;
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

        public function postComment()
        {
            $comment = filter_var($_POST['comment'], FILTER_SANITIZE_STRING);
            $newsId = filter_var($_POST['newsId'], FILTER_VALIDATE_INT);

            $newscomment = new Newscomment();
            $newscomment->message = $comment;
            $newscomment->newsId = $newsId;
            //Needs to be changed later on
            $newscomment->userId = 1;

            $this->newscommentRepository->save($newscomment);
            return Redirect::action('NewsController@getDetail', $newsId);
        }
    }