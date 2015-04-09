<?php 
    namespace App\Http\ViewComposers;

    use Illuminate\Contracts\View\View;
    use App\Http\Controllers\Controller;
    use App\Repositories\RepositoryInterfaces\IFooterRepository;

    class FooterComposer 
    {
        public function __construct(IFooterRepository $footerrepo)
        {	
        	$this->footerrepo = $footerrepo;
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
        	$footer = $this->footerrepo->getAll();
    		$view->with('footer', $footer); 
        }
    }