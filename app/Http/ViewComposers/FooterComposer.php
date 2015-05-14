<?php namespace App\Http\ViewComposers;

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

        $view->with('footer', $footerItems);
    }
}