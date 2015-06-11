<?php
	namespace App\Http\Controllers;
	
	use App\Models\Carousel;
	use App\Repositories\RepositoryInterfaces\ICarouselRepository;
	use Illuminate\Support\Facades\Redirect;
	use Auth;
	
	class CarouselController extends Controller
	{
		private $carouselRepo;
		
		/**
		 * Create a new CarouselController instance.
		 *
		 * @parm ICarouselRepository $carouselRepo
		 *
		 * @return void
		 */
		public function __construct(ICarouselRepository $carouselRepo)
		{
			$this->carouselRepo = $carouselRepo;
		}
		
		public function edit()
		{
			if (Auth::user()->hasPermission(PermissionsController::PERMISSION_CAROUSEL))
			{
				$carousel = $this->carouselRepo->getAll();
				return view('carousel.edit', compact('carousel'));
			}

			return view('errors.403');
		}

		public function update()
		{
			if (Auth::user()->hasPermission(PermissionsController::PERMISSION_CAROUSEL))
			{
				$oldItems = $this->carouselRepo->getAll();

				if (isset($_POST['artikel']) && isset($_POST['beschrijving']))
				{
					//last carousel index
					$lci = 0;

					for ($i = 0; $i < count($_POST['artikel']); $i++)
					{

						if($_POST['sort'][$i] === 'news')
						{
							$newsId = $_POST['artikel'][$i];
							$description = 'Nog geen beschrijving';
							$item = $this->carouselRepo->create(compact('newsId', 'description'));

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

							//title via page -> relatie
							$title = null;

							$start = null;
							$end = null;

							$publishStartDate = new \DateTime($start);
							$publishStartDate->format('Y-m-d');
							$publishEndDate = new \DateTime($end);
							$publishEndDate->format('Y-m-d');

							$item = $this->carouselRepo->create(compact('newsId', 'pageId', 'title', 'publishStartDate', 'publishEndDate', 'description' ));

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
		
		private function saveImage($item, $count, $oldItem) 
		{
			if (isset($_FILES) && isset($_FILES['file'])) 
			{
				$target = public_path() . '/uploads/img/carousel/';
				
				$allowed = ['png' , 'jpg', 'jpeg', 'gif'];			// Specify only lowercase.
				
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