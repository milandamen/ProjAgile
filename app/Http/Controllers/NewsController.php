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
        public function __construct(IFileRepository $fileRepo, IDistrictSectionRepository $districtSectionRepo, INewsCommentRepository $newsCommentRepo, INewsRepository $newsRepo, IUserRepository $userRepo, ISidebarRepository $sidebarRepo)
        {
            $this->fileRepo = $fileRepo;
            $this->districtSectionRepo = $districtSectionRepo;
            $this->newsCommentRepo = $newsCommentRepo;
            $this->newsRepo = $newsRepo;
            $this->userRepo = $userRepo;
            $this->sidebarRepo = $sidebarRepo;
        }
		
		public function getIndex()
		{
			$newsItems = $this->newsRepo->getAll();
			return View::make('news/index', compact('newsItems'));
		}

		public function edit($id)
		{
			$newsItem = $this->newsRepo->get($id);
			$title = $newsItem->title;
			$content = $newsItem->content;

			//Files
			$files = $this->fileRepo->getAllByNewsId($id);

			//DistrictSection
			$districtSections = $this->districtSectionRepo->getAllToList();

			return View::make('news.edit', compact('newsItem', 'districtSections', 'files'));
		}

		public function getDetail($newsId)
		{
			$news = $this->$newsRepo->get($newsId);
		}

        public function index(){
        	$news = $this->newsRepo->getLastWeek();
        	$oldnews = $this->newsRepo->oldNews();
        	$sidebar = $this->sidebarRepo->getByPage('2');
        	return view('news.index', compact('news', 'oldnews', 'sidebar'));
        }

        public function showHidden(){
        	if (Auth::check() && Auth::user()->usergroup->name === 'Administrator') {
	        	$news = $this->newsRepo->getAllHidden();
	        	$sidebar = $this->sidebarRepo->getByPage('2');
	        	return view('news.hidden', compact('news', 'sidebar'));
	        } else {
	        	echo 'U heeft geen rechten om op deze pagina te komen.';
	        }
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
		
		public function getArticlesByTitle($term) {
			$data = $this->newsRepo->getByTitle($term);
			echo json_encode($data);
		}
    }
