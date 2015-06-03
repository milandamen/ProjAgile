<?php
	namespace App\Http\ViewComposers;
	
	use Illuminate\Contracts\View\View;
	use App\Http\Controllers\Controller;
	use App\Repositories\RepositoryInterfaces\IMenuRepository;
	use App\Repositories\RepositoryInterfaces\IStyleSettingRepository;

	class MenuComposer
	{
		private $menuRepo;

		public function __construct(IMenuRepository $menuRepo, IStyleSettingRepository $styleRepo)
		{
			$this->menuRepo = $menuRepo;
			$this->styleRepo = $styleRepo;
		}

		/**
		 * Bind data to the view.
		 *
		 * @param  View  $view
		 * @return void
		 */
		public function compose(View $view)
		{
			$menu = $this->menuRepo->getMenu();
			$menuColor = $this->styleRepo->get('defaultMenuColor');

			$view->with(['menu' => $menu, 'menuColor' => $menuColor]);
		}
	}