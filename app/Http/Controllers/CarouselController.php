<?php
	namespace App\Http\Controllers;

	use Auth;
	use App\Models\Carousel;
	use App\Repositories\RepositoryInterfaces\ICarouselRepository;
	use App\Repositories\RepositoryInterfaces\IPageRepository;
	use Illuminate\Support\Facades\Redirect;
	
	class CarouselController extends Controller
	{
		private $carouselRepo;
		
		/**
		 * Creates a new CarouselController instance.
		 *
		 * @param ICarouselRepository $carouselRepo
		 *
		 * @return void
		 */
		public function __construct(ICarouselRepository $carouselRepo, IPageRepository $pageRepo)
		{
			$this->carouselRepo = $carouselRepo;
			$this->pageRepo= $pageRepo;
		}
		
		/**
		 * Show the carousel edit page.
		 * 
		 * @return Response
		 */
		public function edit()
		{
			if (Auth::user()->hasPermission(PermissionsController::PERMISSION_CAROUSEL))
			{
				$carousel = $this->carouselRepo->getAll();

				return view('carousel.edit', compact('carousel'));
			}

			return view('errors.403');
		}

		/**
		 * Post the carousel and handle the input.
		 * 
		 * @return Response
		 */
		public function update()
		{
			if (Auth::user()->hasPermission(PermissionsController::PERMISSION_CAROUSEL))
			{
				$oldItems = $this->carouselRepo->getAll();

				if (isset($_POST['artikel']) && isset($_POST['beschrijving']))
				{
					// Last carousel index.
					$lci = 0;

					for ($i = 0; $i < count($_POST['artikel']); $i++)
					{
						if($_POST['sort'][$i] === 'news')
						{
							$newsId = $_POST['artikel'][$i];
							$description = 'Nog geen beschrijving';

							$start = filter_var($_POST['articleStartDate'][$i], FILTER_SANITIZE_STRING);
							$end = filter_var($_POST['articleEndDate'][$i], FILTER_SANITIZE_STRING);

							$publishStartDate = new \DateTime($start);
							$publishStartDate->format('Y-m-d');
							$publishEndDate = new \DateTime($end);
							$publishEndDate->format('Y-m-d');

							$item = $this->carouselRepo->create(compact('newsId', 'publishStartDate', 'publishEndDate', 'description'));

							$description = filter_var($_POST['beschrijving'][$i], FILTER_SANITIZE_STRING);

							if (!isset($description) || empty($description))
							{
								$description = 'Nog geen beschrijving';
							}
							$item->description = $description;
							$this->carouselRepo->update($item);
							$oldItem = null;

							foreach ($oldItems as $oI)
							{
								if ($oI->newsId == $newsId)
								{
									$oldItem = $oI;
									break;
								}
							}
						}
						else if($_POST['sort'][$i] === 'carousel')
						{
							$carouselId = $_POST['artikel'][$i];
							$description = filter_var($_POST['beschrijving'][$i], FILTER_SANITIZE_STRING);

							if(!isset($description) || empty($description))
							{
								$description = 'Nog geen beschrijving';
							}

							$newsId = null;
							$pageId = null;
							
							$title = filter_var($_POST['carouselTitle'][$lci], FILTER_SANITIZE_STRING);
							$start = filter_var($_POST['carouselStartDate'][$lci], FILTER_SANITIZE_STRING);
							$end = filter_var($_POST['carouselEndDate'][$lci], FILTER_SANITIZE_STRING);

							$publishStartDate = new \DateTime($start);
							$publishStartDate->format('Y-m-d');
							$publishEndDate = new \DateTime($end);
							$publishEndDate->format('Y-m-d');

							$item = $this->carouselRepo->create(compact('newsId', 'pageId', 'title', 'publishStartDate', 'publishEndDate', 'description' ));

							$oldItem = null;

							foreach ($oldItems as $oI)
							{
								if ($oI->carouselId == $carouselId)
								{
									$oldItem = $oI;
									break;
								}
							}
							$lci++;
						}
						else if($_POST['sort'][$i] === 'page')
						{
							$pageId = $_POST['artikel'][$i];
							$newsId = null;
							$description = filter_var($_POST['beschrijving'][$i], FILTER_SANITIZE_STRING);

							if(!isset($description) || empty($description))
							{
								$description = 'Nog geen beschrijving';
							}

							$page = $this->pageRepo->get($pageId);

							//title via page -> relatie
							$title = $page->introduction->title;

							$start = filter_var($_POST['articleStartDate'][$i], FILTER_SANITIZE_STRING);
							$end = filter_var($_POST['articleEndDate'][$i], FILTER_SANITIZE_STRING);

							$publishStartDate = new \DateTime($start);
							$publishStartDate->format('Y-m-d');
							$publishEndDate = new \DateTime($end);
							$publishEndDate->format('Y-m-d');

							$item = $this->carouselRepo->create(compact('newsId', 'pageId', 'title', 'publishStartDate', 'publishEndDate', 'description' ));


							$oldItem = null;

							foreach ($oldItems as $oI)
							{
								if ($oI->pageId == $pageId)
								{
									$oldItem = $oI;
									break;
								}
							}
						}

						if (isset($_POST['deletefile'][$i]) && $_POST['deletefile'][$i] === 'true')
						{
							$item->imagePath = 'blank.jpg';
							$oldItem->imagePath = 'blank.jpg';
						}
						$this->saveImage($item, $i, $oldItem);
						$this->carouselRepo->update($item);
					}
				}

				foreach ($oldItems as $oldItem)
				{
					$oldItem->delete();
				}

				return Redirect::route('home.index');
			}

			return view('errors.403');
		}
		
		/**
		 * Handle saving an image for the carousel.
		 * 
		 * @param  Carousel	$item
		 * @param  int 		$count
		 * @param  Carousel	$oldItem
		 * 
		 * @return void
		 */
		private function saveImage($item, $count, $oldItem) 
		{
			if (isset($_FILES) && isset($_FILES['file'])) 
			{
				$target = public_path() . '/uploads/img/carousel/';

				// Specify only lowercase.
				$allowed = 
				[
					'png' , 
					'jpg', 
					'jpeg', 
					'gif'
				];			

				$filename = $_FILES['file']['name'][$count];
				$ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
				
				// If there are no files selected you will get an empty '' string therefore the !empty check.
				if (!empty($filename) && in_array($ext, $allowed)) 
				{
					$tmp = $_FILES['file']['tmp_name'][$count];
					
					$newFileName = $item->carouselId . '.' . $ext;
					$target = $target . $newFileName;
					
					move_uploaded_file($tmp, $target);
					
					$item->imagePath = $newFileName;
				} 
				elseif ($oldItem != null) 
				{
					$item->imagePath = $oldItem->imagePath;
				} 
				else 
				{
					$item->imagepath = 'blank.jpg';
				}
			} 
			elseif ($oldItem != null) 
			{
				$item->imagePath = $oldItem->imagePath;
			} 
			else 
			{
				$item->imagepath = 'blank.jpg';
			}
		}
	}