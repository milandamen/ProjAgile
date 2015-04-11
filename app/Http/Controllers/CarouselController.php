<?php
    namespace App\Http\Controllers;

    use App\Models\Carousel;
    use App\Repositories\RepositoryInterfaces\ICarouselRepository;
    use Illuminate\Support\Facades\Redirect;

    class CarouselController extends Controller
    {
        private $carouselRepo;
		
		// minimum and maximum number that is prepended to image file
		private $minRand = 100000;
		private $maxRand = 999999;

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
			// if has permission then
				$carousel = $this->carouselRepo->getAll();
				return View('carousel.edit', compact('carousel'));
			// else
				// // Totdat er een error page is.
				// return Redirect::route('home.index');
			// end if
        }

        public function update()
        {
			$this->carouselRepo->deleteAll();
			
			for ($i = 0; $i < count($_POST['artikel']); $i++) {
				$newsId = $_POST['artikel'][$i];
				$item = $this->carouselRepo->create(compact('newsId'));
				$item->save();		// TODO Maybe not needed..
				
				$this->saveImage($item);
			}
			
            return Redirect::route('home.index');
        }
		
		private function saveImage($item) {
			
		}
		
    }