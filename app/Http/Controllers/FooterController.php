<?php
	namespace App\Http\Controllers;

	use App\Repositories\RepositoryInterfaces\IFooterRepository;
	use App\Repositories\RepositoryInterfaces\IMenuRepository;
	use App\Repositories\RepositoryInterfaces\INewOnSiteRepository;
	use Auth;
	use Illuminate\Support\Facades\Redirect;
	use Input;

	class FooterController extends Controller
	{
		/**
		 * The static color id for footer.
		 * 
		 * @var int
		 */
		private $colorId;

		/**
		 * The IFooterRepository implementation.
		 * 
		 * @var IFooterRepository
		 */
		private $footerRepository;

		/**
		 * The IMenuRepository implementation.
		 * 
		 * @var IMenuRepository
		 */
		private $menuRepository;

		/**
		 * The INewOnSiteRepository implementation.
		 * 
		 * @var INewOnSiteRepository
		 */
		private $newOnSiteRepository;

		/**
		 * Creates a new FooterController instance.
		 *
		 * @param ICarouselRepository $carouselRepo
		 *
		 * @return void
		 */
		public function __construct(IFooterRepository $footerRepository, IMenuRepository $menuRepository, INewOnSiteRepository $newOnSiteRepository)
		{
			$this->colorId = 4;

			$this->footerRepository = $footerRepository;
			$this->menuRepository = $menuRepository;
			$this->newOnSiteRepository = $newOnSiteRepository;
		}

		/**
		 * Show the footer edit page.
		 * 
		 * @return Response
		 */
		public function edit()
		{
			if (Auth::user()->hasPermission(PermissionsController::PERMISSION_FOOTER))
			{
				$footer = $this->footerRepository->getAll();

				return view('footer.edit', compact('footer'));
			}

			return view('errors.403');
		}

		/**
		 * Post the footer and handle the input.
		 * 
		 * @return Response
		 */
		public function update()
		{
			if (Auth::user()->hasPermission(PermissionsController::PERMISSION_FOOTER))
			{
				if(isset($_POST['column']))
				{
					$counter = 1;

					foreach($_POST['column'] as $col)
					{
						filter_var($col, FILTER_SANITIZE_STRING);

						$footerCol = $this->footerRepository->get($counter);

						$footerCol->text = $col;

						$this->footerRepository->update($footerCol);

						$counter++;
					}

					if(isset($_POST['footerColor']) && $_POST['footerColor'] != null)
					{
						$footerColor = $this->footerRepository->get($this->colorId);

						$footerColor->text = filter_var($_POST['footerColor'], FILTER_SANITIZE_STRING);

						$this->footerRepository->update($footerColor);
					}
				}
				$newOnSite = filter_var($_POST['newOnSite'], FILTER_VALIDATE_BOOLEAN);

				if($newOnSite === true)
				{
					$attributes['message'] = filter_var($_POST['newOnSiteMessage'], FILTER_SANITIZE_STRING);
					$attributes['created_at'] = new \DateTime('now');
					$this->newOnSiteRepository->create($attributes);
				}

				return Redirect::route('footer.edit');
			}

			return view('errors.403');
		}
	}