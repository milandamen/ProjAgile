<?php namespace App\Http\ViewComposers;

use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use App\Repository\SidebarRepository;

class SidebarComposer extends Controller{

    public function __construct(SidebarRepository $sidebarrepo)
    {	
    	$this->sidebarrepo = $sidebarrepo;
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */

    public function compose(View $view)
    {
		// 	$view->with('variablename', $variablearray); 
    }

}