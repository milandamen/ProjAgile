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
        public function __construct(INewsCommentRepository $newsCommentRepo, INewsRepository $newsRepo, IUserRepository $userRepo)
        {
            $this->newsCommentRepo = $newsCommentRepo;
            $this->newsRepo = $newsRepo;
            $this->userRepo = $userRepo;
        }

        public function show($newsId)
        {
            $news = $this->newsRepo->get($newsId);
            $fileLinks = [];

            if($news != null)
            {
                foreach($news->files as $file)
                {
                    $withoutId = substr($file->path, stripos($file->path, 'd') + 1);
                    $fileLinks[] = '<a href="' . route('file.download') . '/' . $file->path . '">'. $withoutId . '</a><br/>';
                }
            }
            return view('news.show', compact('news', 'fileLinks'));
        }

        public function comment()
        {
            $comment = filter_var($_POST['comment'], FILTER_SANITIZE_STRING);
            $newsId = filter_var($_POST['newsId'], FILTER_VALIDATE_INT);

            $attributes['newsId'] = $newsId;
            // Needs to be changed later on
            $attributes['userId'] = 1;
            $attributes['message'] = $comment;

            $this->newsCommentRepo->create($attributes);

            return Redirect::route('news.show', [$newsId]);
        }
    }