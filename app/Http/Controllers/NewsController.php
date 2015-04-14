<?php
    namespace App\Http\Controllers;

    use App\Models\Newscomment;
    use App\Repositories\RepositoryInterfaces\INewsCommentRepository;
    use App\Repositories\RepositoryInterfaces\INewsRepository;
    use App\Repositories\RepositoryInterfaces\IUserRepository;
    use App\Repositories\RepositoryInterfaces\ISidebarRepository;
    use Illuminate\Support\Facades\Redirect;
	use Auth;

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
        public function __construct(INewsCommentRepository $newsCommentRepo, INewsRepository $newsRepo, IUserRepository $userRepo, ISidebarRepository $sidebarRepo)
        {
            $this->newsCommentRepo = $newsCommentRepo;
            $this->newsRepo = $newsRepo;
            $this->userRepo = $userRepo;
            $this->sidebarRepo = $sidebarRepo;
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
                return view('news.show', compact('news', 'fileLinks'));
            }
            else
            {
                return view('errors.404');
            }
        }

        public function postComment()
        {
            if(Auth::check())
            {
                $comment = filter_var($_POST['comment'], FILTER_SANITIZE_STRING);
                $newsId = filter_var($_POST['newsId'], FILTER_VALIDATE_INT);

                $attributes['newsId'] = $newsId;
                // Needs to be changed later on
                $attributes['userId'] = Auth::user()->userId;
                $attributes['message'] = $comment;

                $this->newsCommentRepo->create($attributes);

                return Redirect::route('news.show', [$newsId]);
            }
            else
            {
                return view('errors.401');
            }
        }
		
		public function getArticlesByTitle($term) {
			$data = $this->newsRepo->getByTitle($term);
			echo json_encode($data);
		}

		public function hide($id){

			if (Auth::check() && Auth::user()->usergroup->name === 'Administrator') {
				$news = $this->newsRepo->get($id);
				if(count($news) > 0){
					$news->hidden = true;
					$news->save();
				} else {
					return view('errors/404');
				}
				return Redirect::route('news.manage');
			} else {
				return view('errors/403');
			}
		}

		public function unhide($id){
			if (Auth::check() && Auth::user()->usergroup->name === 'Administrator') {
				
				$news = $this->newsRepo->get($id);
				if(count($news) > 0){
					$news->hidden = false;
					$news->save();
				} else {
					return view('errors/404');
				}
				return Redirect::route('news.manage');
			} else {
				return view('errors/403');
			}
		}

    }