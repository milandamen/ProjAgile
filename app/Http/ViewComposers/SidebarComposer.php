<?php 
    namespace App\Http\ViewComposers;

    use Illuminate\Contracts\View\View;
    use App\Http\Controllers\Controller;
    use App\Repositories\RepositoryInterfaces\ISidebarRepository;

    class SidebarComposer
    {
        public function __construct(ISidebarRepository $sidebarrepo)
        {	
        	$this->sidebarrepo = $sidebarrepo;
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
        	$sidebar = $this->sidebarrepo->getByPage(1);
    		$view->with('sidebar', $sidebar); 
        }
    }