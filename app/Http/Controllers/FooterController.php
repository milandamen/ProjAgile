<?php namespace App\Http\Controllers;

use App\Models\Footer;
use App\Repositories\RepositoryInterfaces\IMenuRepository;
use App\Repositories\RepositoryInterfaces\INewOnSiteRepository;
use Illuminate\Support\Facades\Redirect;
use App\Repositories\RepositoryInterfaces\IFooterRepository;
use Input;
use Auth;

class FooterController extends Controller
{

    private $colorId = 4;

    public function __construct(IFooterRepository $footerRepository, IMenuRepository $menuRepository, INewOnSiteRepository $newOnSiteRepository)
    {
        $this->footerRepository = $footerRepository;
        $this->menuRepository = $menuRepository;
        $this->newOnSiteRepository = $newOnSiteRepository;
    }

    public function edit()
    {
        if(Auth::check())
        {
            if(Auth::user()->usergroup->name === 'Administrator')
            {
                return view('footer/edit', array('footer' => $this->footerRepository->getAll()));
            }
            else
            {
                return view('errors.403');
            }
        }
        else
        {
            return view('errors.401');
        }
    }

    public function postEdit()
    {
        if(Auth::check())
        {
            if(Auth::user()->usergroup->name === 'Administrator')
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

                return Redirect::action('FooterController@edit');
            }
            else
            {
                return view('errors.403');
            }
        }
        else
        {
            return view('errors.401');
        }
    }
}