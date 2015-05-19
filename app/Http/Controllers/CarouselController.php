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
			if (Auth::check())
			{
				if (Auth::user()->usergroup->name === 'Administrator' || Auth::user()->usergroup->name === 'Content Beheerder') 
				{
					$carousel = $this->carouselRepo->getAll();

					return view('carousel.edit', compact('carousel'));
				} 
					
				return view('errors.403');
			}
				
			return view('errors.401');
		}

		public function update()
		{
			if (Auth::check())
			{
				if (Auth::check() && (Auth::user()->usergroup->name === 'Administrator' || Auth::user()->usergroup->name === 'Content Beheerder')) 
				{
					$oldItems = $this->carouselRepo->getAll();
					
					if (isset($_POST['artikel']) && isset($_POST['beschrijving'])) 
					{
						for ($i = 0; $i < count($_POST['artikel']); $i++) 
						{
							$newsId = $_POST['artikel'][$i];
							$description = 'Nog geen beschrijving';
							$item = $this->carouselRepo->create(compact('newsId', 'description'));
							
							$description = $_POST['beschrijving'][$i];

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
			
			return view('errors.401');
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