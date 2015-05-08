<?php
namespace App\Http\ViewComposers;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use App\Repositories\RepositoryInterfaces\IMenuRepository;

class MenuComposer
{
    private $menuRepo;

    public function __construct(IMenuRepository $menuRepo)
    {
        $this->menuRepo = $menuRepo;
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
        $view->with('menu', $menu);
    }
}