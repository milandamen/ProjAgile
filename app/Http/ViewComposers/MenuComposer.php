<?php 
    namespace App\Http\ViewComposers;

    use Illuminate\Contracts\View\View;
    use App\Http\Controllers\Controller;
    use App\Repositories\RepositoryInterfaces\IMenuRepository;

    class MenuComposer 
    {
        public function __construct(IMenuRepository $menurepo)
        {	
        	$this->menurepo = $menurepo;
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
        	$menu = $this->menurepo->getAll();
    		$view->with('menu', $menu); 
        }
    }