<?php 
	namespace App\Http\ViewComposers;

	use Illuminate\Contracts\View\View;
	use App\Http\Controllers\Controller;
	use App\Repositories\RepositoryInterfaces\ISidebarRepository;

	class SidebarComposer
	{
		private $homePageNumber = 1;
		private $sidebarRepo;

		public function __construct(ISidebarRepository $sidebarRepo)
		{	
			$this->sidebarRepo = $sidebarRepo;
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

			$sidebar = $this->sidebarRepo->getByPage($this->homePageNumber);
			$view->with('sidebar', $sidebar); 
		}
	}