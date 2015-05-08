<?php namespace App\Http\Controllers;

    use App\Models\File;
    use App\Models\News;
    use App\Http\Requests\News\NewsRequest;
    use App\Repositories\RepositoryInterfaces\IFileRepository;
    use App\Repositories\RepositoryInterfaces\IDistrictSectionRepository;
    use App\Repositories\RepositoryInterfaces\INewsCommentRepository;
    use App\Repositories\RepositoryInterfaces\INewsRepository;
    use App\Repositories\RepositoryInterfaces\IUserRepository;
    use App\Repositories\RepositoryInterfaces\ISidebarRepository;
    use Auth;
    use Redirect;
    use Request;
	use View;

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
        public function __construct(IDistrictSectionRepository $districtSectionRepo, IFileRepository $fileRepo, 
                                    INewsCommentRepository $newsCommentRepo, INewsRepository $newsRepo, 
                                    IUserRepository $userRepo, ISidebarRepository $sidebarRepo)
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

            if($news != null)
            {
                htmlspecialchars($news->content);
                return view('news.show', compact('news'));
            }

            return view('errors.404');
        }

        /**
         * Show the create news page.
         *
         * @return Response
         */
        public function create()
        {
            if (Auth::check())
            {
                if (Auth::user()->usergroup->name === 'Administrator')
                {
                    $newsItem = new News();
                    $districtSections = $this->districtSectionRepo->getAllToList();

                    return view('news.create', compact('newsItem', 'districtSections'));
                }

                return view('errors.403');
            } 

            return view('errors.401');
        }

        /**
         * Stores the created article in the database.
         * 
         * @param  NewsRequest $request
         * 
         * @return Response
         */
        public function store(NewsRequest $request)
        {
            if (Auth::check())
            {
                if (Auth::user()->usergroup->name === 'Administrator')
                {
                    $news = $this->newsRepo->create($request->all());
                    $oldFiles = $this->fileRepo->getAllByNewsId($news->newsId);

                    for($i = 0; $i < count($request->file); $i++)
                    {
                        $this->saveFile($news, $i, $oldFiles);
                    }

                    foreach ($oldFiles as $oldItem)
                    {
                        $this->fileRepo->destroy($oldItem);
                    }

                    return Redirect::route('news.show', [$news->newsId]);
                }

                return view('errors.403');
            } 

            return view('errors.401');
        }

        /**
         * Show the edit news page.
         *
         * @return Response
         */
		public function edit($id)
		{
            if (Auth::check())
            {
                if (Auth::user()->usergroup->name === 'Administrator')
                {
                    $newsItem = $this->newsRepo->get($id);
                    $files = $this->fileRepo->getAllByNewsId($id);
                    $districtSections = $this->districtSectionRepo->getAllToList();

                    return view('news.edit', compact('newsItem', 'districtSections', 'files'));
                }

                return view('errors.403');
            } 

            return view('errors.401');
		}

        /**
         * Updates the existing article in the database.
         * 
         * @param  NewsRequest $request
         * 
         * @return Response
         */
        public function update($id, NewsRequest $request)
        {
            if (Auth::check())
            {
                if (Auth::user()->usergroup->name === 'Administrator')
                {
					$newsItem = $this->newsRepo->get($id);

                    $newsItem->districtSectionId = $request->districtSectionId;
                    $newsItem->title = $request->title;
                    $newsItem->content = $request->content;
                    $newsItem->hidden = $request->hidden;
                    $newsItem->commentable = $request->commentable;
                    $newsItem->publishStartDate = $request->publishStartDate;
                    $newsItem->publishEndDate = $request->publishEndDate;
                    $newsItem->top = $request->top;

                    $news = $this->newsRepo->update($newsItem);
                    
                    $this->saveFiles($request->file, $id);

                    return Redirect::route('news.show', [$id]);
                }

                return view('errors.403');
            } 

            return view('errors.401');
        }

        /**
         * Show all news articles including the hidden ones. 
         * This is intented for administrators only.
         *
         * @return Response
         */
        public function showHidden()
        {
            if (Auth::check()) 
            {
                if (Auth::user()->usergroup->name === 'Administrator')
                {
                    $news = $this->newsRepo->getAllHidden();
                    $sidebar = $this->sidebarRepo->getByPage('2');

                    return view('news.hidden', compact('news', 'sidebar'));
                }

                return view('errors.403');
            } 

            return view('errors.401');
        }   

        /**
         * Store a comment with the provided news article id.
         *
         * @return Response
         */
        public function postComment()
        {
            if(Auth::check())
            {
                $comment = filter_var($_POST['comment'], FILTER_SANITIZE_STRING);
                $newsId = filter_var($_POST['newsId'], FILTER_VALIDATE_INT);

                $attributes['newsId'] = $newsId;
                $attributes['userId'] = Auth::user()->userId;
                $attributes['message'] = $comment;

                $this->newsCommentRepo->create($attributes);

                return Redirect::route('news.show', [$newsId]);
            }

            return view('errors.401');
        }

        /**
         * Get all the articles by title name.
         *
         * @param  String $term
         *
         * @return Json
         */
		public function getArticlesByTitle($term) 
        {
			$data = $this->newsRepo->getByTitle($term);
			echo json_encode($data);
		}

        /**
         * Hides an article depending on the id provided.
         *
         * @param int $id
         *
         * @return Response
         */
		public function hide($id)
        {
			if (Auth::check())
            {
                if (Auth::user()->usergroup->name === 'Administrator')
                {
                    $news = $this->newsRepo->get($id);

                    if(count($news) > 0)
                    {
                        $news->hidden = true;
                        $this->newsRepo->update($news);

                        return Redirect::route('news.manage');
                    } 

                    return view('errors.404');
                }

				return view('errors.403');
			}

			return view('errors.401');
		}

        /**
         * Unhides an article depending on the id provided.
         *
         * @param int $id
         *
         * @return Response
         */
		public function unhide($id)
        {
			if (Auth::check()) 
            {
                if (Auth::user()->usergroup->name === 'Administrator')
                {
                    $news = $this->newsRepo->get($id);

                    if(count($news) > 0)
                    {
                        $news->hidden = false;
                        $this->newsRepo->update($news);
                    } 
                    else 
                    {
                        return view('errors.404');
                    }

                    return Redirect::route('news.manage');
                }

                return view('errors.403');
			}

		  return view('errors.401');
		}

        private function saveFiles($requestFiles, $newsId) 
        {
			$target = public_path() . '/uploads/file/news/';
			$allowed = ['png', 'jpg', 'gif', 'jpeg', 
						'pdf', 'xps',
						'doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx', 
						'txt', 'rtf', 'xml',
						'odt', 'dotx', 'odp', 'ods', 'odi'];
			
			for($i = 0; $i < count($requestFiles); $i++) {
				$rfile = $requestFiles[$i];
				if (isset($rfile)) {
					$filename = $rfile->getClientOriginalName();
					$ext = pathinfo($filename, PATHINFO_EXTENSION);
					
					if (!empty($filename) && in_array($ext, $allowed)) {
						$file = $this->fileRepo->create(['newsId' => $newsId]);
						$rfile->move($target, $file->fileId . '_' . $filename);
						
						$file->newsId = $newsId;
						$file->path = $file->fileId . '_' . $filename;
						$file->save();
					}
				}
			}
        }
    }