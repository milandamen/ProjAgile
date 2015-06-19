<?php 
	namespace App\Http\Controllers;

	use App\Http\Requests\News\NewsRequest;
	use App\Models\File;
	use App\Models\News;
	use App\Repositories\RepositoryInterfaces\IDistrictSectionRepository;
	use App\Repositories\RepositoryInterfaces\IFileRepository;
	use App\Repositories\RepositoryInterfaces\INewsCommentRepository;
	use App\Repositories\RepositoryInterfaces\INewsRepository;
	use App\Repositories\RepositoryInterfaces\ISidebarRepository;
	use App\Repositories\RepositoryInterfaces\IUserRepository;
	use Auth;
	use Flash;
	use Redirect;
	use Request;
	use View;

	class NewsController extends Controller
	{
		/**
		 * The IDistrictSectionRepository implementation.
		 * 
		 * @var IDistrictSectionRepository
		 */
		private $districtSectionRepo;

		/**
		 * The IFileRepository implementation.
		 * 
		 * @var IFileRepository
		 */
		private $fileRepo;

		/**
		 * The INewsCommentRepository implementation.
		 * 
		 * @var INewsCommentRepository
		 */
		private $newsCommentRepo;

		/**
		 * The INewsRepository implementation.
		 * 
		 * @var INewsRepository
		 */
		private $newsRepo;

		/**
		 * The IUserRepository implementation.
		 * 
		 * @var INewOnSiteRepository
		 */
		private $userRepo;

		/**
		 * The ISidebarRepository implementation.
		 * 
		 * @var ISidebarRepository
		 */
		private $sidebarRepo;

		/**
		 * Creates a new NewsController instance.
		 *
		 * @param IDistrictSectionRepository	$districtSectionRepo
		 * @param IFileRepository				$fileRepo
		 * @param INewsCommentRepository		$newsCommentRepo
		 * @param INewsRepository				$newsRepo
		 * @param IUserRepository				$userRepo
		 * @param ISidebarRepository			$sidebarRepo	
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

			if (Auth::user() != null && (Auth::user()->hasDistrictSectionViewPermissions($news->districtSections) || Auth::user()->userGroup->hasDistrictSectionViewPermissions($news->districtSections)) || $news->hasDistrictSection(DistrictSectionController::HOME_DISTRICT))
			{
				if ($news != null) {
					htmlspecialchars($news->content);

					return view('news.show', compact('news'));
				}
			}

			return view('errors.403');
		}

		/**
		 * Show the create news page.
		 *
		 * @return Response
		 */
		public function create()
		{
			if (Auth::user()->hasPermission(PermissionsController::PERMISSION_NEWS) || Auth::user()->userGroup->hasPermission(PermissionsController::PERMISSION_NEWS))
			{
				$newsItem = new News();
				$districtSections = $this->districtSectionRepo->getAllToList();

				return view('news.create', compact('newsItem', 'districtSections'));
			}

			return view('errors.403');
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
			if (Auth::user()->hasPermission(PermissionsController::PERMISSION_NEWS) || Auth::user()->userGroup->hasPermission(PermissionsController::PERMISSION_NEWS))
			{
				$news = $this->newsRepo->create($request->all());
				$this->saveFiles($request->file, $news->newsId);

				return Redirect::route('news.show', [$news->newsId]);
			}

			return view('errors.403');
		}

		/**
		 * Show the edit news page.
		 *
		 * @return Response
		 */
		public function edit($id)
		{
			$newsItem = $this->newsRepo->get($id);

			if (Auth::user()->hasDistrictSectionPermissions($newsItem->districtSections) || Auth::user()->userGroup->hasDistrictSectionPermissions($newsItem->districtSections))
			{
				$files = $this->fileRepo->getAllByNewsId($id);
				$districtSections = $this->districtSectionRepo->getAllToList();

				return view('news.edit', compact('newsItem', 'districtSections', 'files'));
			}
			else
			{
				Flash::error('U bent niet geautoriseerd om dit nieuws items te wijzigen.');

				return Redirect::route('news.manage');
			}

			return view('errors.403');
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
			$newsItem = $this->newsRepo->get($id);

			if (Auth::user()->hasDistrictSectionPermissions($newsItem->districtSections) || Auth::user()->userGroup->hasDistrictSectionPermissions($newsItem->districtSections))
			{
				$newsItem = $this->newsRepo->get($id);
				$newsItem->title = $request->title;
				$newsItem->content = $request->content;
				$newsItem->hidden = $request->hidden;
				$newsItem->commentable = $request->commentable;
				$newsItem->publishStartDate = $request->publishStartDate;
				$newsItem->publishEndDate = $request->publishEndDate;
				$newsItem->top = $request->top;
				$news = $this->newsRepo->update($newsItem);

				$districtSections = $request->districtSection;

				$oldDistrictSections = $news->districtSections;

				foreach($oldDistrictSections as $oldDistrict)
				{
					$news->districtSections()->detach($oldDistrict);
				}

				foreach($districtSections as $district)
				{
					$news->districtSections()->attach($district);
				}

				// Remove selected files.
				if ($request->removefile)
				{
					foreach ($request->removefile as $key => $value)
					{
						$this->fileRepo->deleteByFileId($key);
					}
				}

				// Save files that were sent with this request.
				$this->saveFiles($request->file, $id);

				return Redirect::route('news.show', [$id]);
			}
			Flash::error('U bent niet geautoriseerd om dit nieuws items te wijzigen.');

			return Redirect::route('news.manage');
		}

		/**
		 * Show all news articles including the hidden ones. 
		 * This is intented for management only.
		 *
		 * @return Response
		 */
		public function manage()
		{
			$news = $this->newsRepo->getAllHidden();
			$sidebar = $this->sidebarRepo->getByPage(2);

			return view('news.manage', compact('news', 'sidebar'));
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
		 * @return JSON
		 */
		public function getArticlesByTitle($term) 
		{
			$data = $this->newsRepo->getByTitle($term);
			echo json_encode($data);
		}

		/**
		 * Toggle the hide status of an article depending on the id provided.
		 *
		 * @param int $id
		 *
		 * @return Response
		 */
		public function toggleHide($id)
		{
			$newsItem = $this->newsRepo->get($id);

			if (Auth::user()->hasDistrictSectionPermissions($newsItem->districtSections)  || Auth::user()->userGroup->hasDistrictSectionPermissions($newsItem->districtSections))
			{
				$news = $this->newsRepo->get($id);

				if(count($news) > 0)
				{
					$news->hidden ? $news->hidden = false : $news->hidden = true;
					$this->newsRepo->update($news);

					return Redirect::route('news.manage');
				}

				return view('errors.404');
			}
			Flash::error('U bent niet geautoriseerd om de zichtbaarheid van dit nieuws items aan te passen.');

			return Redirect::route('news.manage');
		}

		/**
		 * Handles saving the files for the specified news item.
		 * 
		 * @param  Mixed	$requestFiles
		 * @param  int		$newsId
		 * 
		 * @return void
		 */
		private function saveFiles($requestFiles, $newsId) 
		{
			$target = public_path() . '/uploads/file/news/';

			$allowed = 
			[
				'doc',
				'pdf',
				'xls',
				'ppt',
				'xps',
				'odi',
				'odp',
				'ods',
				'odt',
				'pptx',
				'xlsx',
				'docx',
				'dotx',
				'xml',
				'gif',
				'jpeg',
				'jpg',
				'png',
				'plain',
				'rtf',
			];
			
			for($i = 0; $i < count($requestFiles); $i++) 
			{
				$rfile = $requestFiles[$i];

				if (isset($rfile)) 
				{
					$filename = $rfile->getClientOriginalName();
					$ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
					
					if (!empty($filename) && in_array($ext, $allowed)) 
					{
						$file = $this->fileRepo->create
						([
							'newsId' => $newsId
						]);
						$rfile->move($target, $file->fileId . '_' . $filename);
						
						$file->newsId = $newsId;
						$file->path = $file->fileId . '_' . $filename;
						$this->fileRepo->update($file);
					}
				}
			}
		}
	}