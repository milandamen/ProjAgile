<?php 
	namespace App\Http\ViewComposers;

	use Illuminate\Contracts\View\View;
	use App\Repositories\RepositoryInterfaces\IFooterRepository;

	class FooterComposer
	{
		private $footerRepo;

		public function __construct(IFooterRepository $footerRepo)
		{
			$this->footerRepo = $footerRepo;
		}

		/**
		 * Bind data to the view.
		 *
		 * @param  View  $view
		 *
		 * @return void
		 */
		public function compose(View $view)
		{
			$footerItems = $this->footerRepo->getAll();

			$numberOfColumns = 0;

			foreach($footerItems as $item)
			{
				if($item->col >= $numberOfColumns)
				{
					$numberOfColumns = $item->col + 1;
				}
			}
			$footerColumns = [];

			for($i = 0; $i < $numberOfColumns; $i++)
			{
				$footerColumns[] = [];
			}

			foreach($footerItems as $item)
			{
				$footerColumns[$item->col][$item->row] = $item;
			}

			$view->with('footer', $footerColumns);
		}
	}