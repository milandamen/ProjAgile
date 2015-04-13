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
			if (Auth::check() && Auth::user()->usergroup->name === 'Administrator') {
				$carousel = $this->carouselRepo->getAll();
				return View('carousel.edit', compact('carousel', 'publicpathh'));
			} else {
				echo 'U heeft geen rechten om op deze pagina te komen.';
			}
		}

		public function update()
		{
			if (Auth::check() && Auth::user()->usergroup->name === 'Administrator') {
				$this->carouselRepo->deleteAll();
				
				for ($i = 0; $i < count($_POST['artikel']); $i++) {
					$newsId = $_POST['artikel'][$i];
					$item = $this->carouselRepo->create(compact('newsId'));
					$item->save();
					
					$this->saveImage($item, $i);
				}
				
				return Redirect::route('home.index');
			} else {
				echo 'U heeft geen rechten om op deze pagina te komen.';
			}
		}
		
		private function saveImage($item, $count) {
			$target = public_path() . '/uploads/img/carousel/';
			
			$allowed = ['png' , 'jpg'];
			
			$filename = $_FILES['file']['name'][$count];
			$ext = pathinfo($filename, PATHINFO_EXTENSION);
			
			// If there are no files selected you will get an empty '' string therefore the !empty check.
			if (!empty($filename) && in_array($ext, $allowed)) {
				$tmp = $_FILES['file']['tmp_name'][$count];
				
				$newFileName = $item->carouselId . '.' . $ext;
				$target = $target . $newFileName;
				
				move_uploaded_file($tmp, $target);
				
				$item->imagePath = $newFileName;
				$item->save();
			}
		}
		
	}