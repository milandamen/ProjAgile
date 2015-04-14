<?php
    namespace App\Http\Controllers;

    use App\Models\Newscomment;
    use App\Repositories\RepositoryInterfaces\IFileRepository;
    use App\Repositories\RepositoryInterfaces\IDistrictSectionRepository;
    use App\Repositories\RepositoryInterfaces\INewsCommentRepository;
    use App\Repositories\RepositoryInterfaces\INewsRepository;
    use App\Repositories\RepositoryInterfaces\IUserRepository;
    use App\Repositories\RepositoryInterfaces\ISidebarRepository;
    use Illuminate\Support\Facades\Redirect;
	use League\Flysystem\File;
	use View;
	use Auth;

    class NewsController extends Controller
    {
        private $fileRepo;
        private $districtSectionRepo;
        private $newsCommentRepo;
        private $newsRepo;
        private $userRepo;

        /**
         * Creates a new NewsController instance.
         *
         * @param IFileRepository        $fileRepo
         * @param INewsCommentRepository $newsCommentRepo
         * @param INewsRepository        $newsRepo
         * @param IUserRepository        $userRepo
         *
         * @return void
         */
        public function __construct(IDistrictSectionRepository $districtSectionRepo, IFileRepository $fileRepo, INewsCommentRepository $newsCommentRepo, INewsRepository $newsRepo, IUserRepository $userRepo, ISidebarRepository $sidebarRepo)
        {
            $this->districtSectionRepo = $districtSectionRepo;
            $this->fileRepo = $fileRepo;
            $this->newsCommentRepo = $newsCommentRepo;
            $this->newsRepo = $newsRepo;
            $this->userRepo = $userRepo;
            $this->sidebarRepo = $sidebarRepo;
        }
		
        /**
         * Show the news overview page.
         *
         * @return Response
         */
        public function index()
        {
            $news = $this->newsRepo->getLastWeek();
            $oldnews = $this->newsRepo->oldNews();
            $sidebar = $this->sidebarRepo->getByPage('2');
            
            return view('news.index', compact('news', 'oldnews', 'sidebar'));
        }

        /**
         * Show the news item.
         *
         * @return Response
         */
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

        /**
         * Show the edit news page.
         *
         * @return Response
         */
		public function edit($id)
		{
			$newsItem = $this->newsRepo->get($id);
			$title = $newsItem->title;
			$content = $newsItem->content;

			// Files
			$files = $this->fileRepo->getAllByNewsId($id);

			// DistrictSection
			$districtSections = $this->districtSectionRepo->getAllToList();

			return View::make('news.edit', compact('newsItem', 'districtSections', 'files'));
		}

        /**
         * Show all news articles including the hidden ones. 
         * This is intented for administrators only.
         *
         * @return Response
         */
        public function showHidden()
        {
        	if (Auth::check() && Auth::user()->usergroup->name === 'Administrator') 
            {
	        	$news = $this->newsRepo->getAllHidden();
	        	$sidebar = $this->sidebarRepo->getByPage('2');

	        	return view('news.hidden', compact('news', 'sidebar'));
	        } 
            else 
            {
	        	abort(403);
	        }
        }	

        /**
         * Store a comment with the provided news article id.
         *
         * @return Response
         */
        public function postComment()
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


        /**
         * Get all the articles by title name.
         *
         * @return JSon
         */
		public function getArticlesByTitle($term) 
        {
			$data = $this->newsRepo->getByTitle($term);
			echo json_encode($data);
		}
    }